<?php

class Complaint {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=skillswipe;charset=utf8', 'root', '');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connexion échouée : " . $e->getMessage());
        }
    }

    public function add($user_id, $title, $description, $image_path = null) {
        $sql = "INSERT INTO complain (userID, title, description, image_path, created_at)
                VALUES (:user_id, :title, :description, :image_path, NOW())";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':user_id'    => $user_id,
            ':title'      => $title,
            ':description'=> $description,
            ':image_path' => $image_path
        ]);
    }

    public function all() {
        $stmt = $this->db->query("SELECT c.*, u.name 
                                  FROM complain c 
                                  JOIN user u ON c.userID = u.id 
                                  ORDER BY c.created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id) {
    $stmt = $this->db->prepare("DELETE FROM complain WHERE id = :id");
    return $stmt->execute([':id' => $id]);
}

}

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/event_model/event.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

class EventEditController {

    public function editForm($id) {
        $db = getDbConnection();
        $eventModel = new EventModel($db);
        $event = $eventModel->getEventById($id);

        $cities = $db->query("SELECT ID, Name FROM City")->fetchAll(PDO::FETCH_ASSOC);
        $companies = $db->query("SELECT ID, Name FROM Company")->fetchAll(PDO::FETCH_ASSOC);

        display("event_modify_form", "Modifier un Evenement", "eventmodif", ['event' => $event, 'cities' => $cities, 'companies' => $companies]);
    }

    public function update($id) {
        $imageName = $_POST['existing_image'] ?? null;

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "./public/uploads/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $imageTmpName = $_FILES['image']['tmp_name'];
            $extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
                $imageName = uniqid() . "." . $extension;
                move_uploaded_file($imageTmpName, $uploadDir . $imageName);
            }
        }
        $db = getDbConnection();
        $stmt = $db->prepare("
            UPDATE Event
            SET Title = ?, Description = ?, Start_date = ?, End_date = ?, City_ID = ?, Company_ID = ?, Event_Type = ?, Image = ?
            WHERE ID = ?
        ");

        $stmt->execute([
            $_POST['title'],
            $_POST['description'],
            $_POST['start_date'],
            $_POST['end_date'],
            $_POST['city_id'],
            $_POST['company_id'],
            $_POST['event_type'],
            $imageName,
            $id
        ]);

        echo "Événement mis à jour avec succès.";
        echo '<a href="/event/index">← Retour</a>';
    }
}

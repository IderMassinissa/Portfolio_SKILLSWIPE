<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/event_model/event.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

class EventAddController {
    public function addForm(){
        $db = getDbConnection();
        $cities = $db->query("SELECT ID, Name FROM City")->fetchAll(PDO::FETCH_ASSOC);
        $companies = $db->query("SELECT ID, Name FROM Company")->fetchAll(PDO::FETCH_ASSOC);

        display("event_add_form", "Ajouter Un Evenement", "event", ['cities' => $cities, 'companies' => $companies]);
    }
    public function store() {
        $imageName = null;

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/public/uploads/";
            if (!is_dir($uploadDir)){
                mkdir($uploadDir, 0755, true);
            }
            $imageTmpName = $_FILES['image']['tmp_name'];
            $extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
                $imageName = uniqid() . "." . $extension;
                move_uploaded_file($imageTmpName, $uploadDir . $imageName);
            }
        }

        $data = [
            'UserID' => $_SESSION['userID'] ?? null,
            'Title'=> $_POST['title'] ?? '',
            'Description' => $_POST['description'] ?? '',
            'Start_date' => $_POST['start_date'] ?? '',
            'End_date'=> $_POST['end_date'] ?? '',
            'City_ID' => $_POST['city_id'] ?? null,
            'Company_ID' => $_POST['company_id'] ?? null,
            'Event_Type' => $_POST['event_type'] ?? '',
            'Image' => $imageName
        ];

        $create = new EventModel();
        $create->createEvent($data);
        echo"Événement créé avec succès.";
        header("Location: /event/index");
    }
}

<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/admin_model/complaint.php";

class ComplaintSendController {
    public function send() {
        if ($_SERVER['REQUEST_METHOD']==='POST'&&isset($_SESSION['userID'])){
            $text = $_POST['message'] ?? '';
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $user_id = $_SESSION['userID'];
            $imag = '';

            if (!empty($_FILES['image']['tmp_name'])){
                $folder= '/public/uploads/';
                $filename= uniqid() . '_' . basename($_FILES['image']['name']);
                $target= $folder . $filename;

                if (!file_exists($folder)) mkdir($folder, 0777, true);
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
                $image = $target;
            }

            $model = new Complaint();
            $model->add($user_id, $title, $description, $image);


            header('Location:/complaint_admin');

            exit;
        }

        display("complaint_form", "Complaint", "complain_form");
    }
}

$controller = new ComplaintSendController();
$controller->send();
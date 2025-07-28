<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/admin_model/complaint.php";

class ComplaintAdminController {
    public function list() {

        if (!isset($_SESSION['userID'])) {
            die("Accès refusé : se connecter.");
        }
        if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
            die("Accès refusé : pas admin.");
        }

        $model = new Complaint();
        $complaints = $model->all();

        display("complaint_list_admin", "Complaint List", "", ['complaints' => $complaints]);
    }
}

$controller = new ComplaintAdminController();
$controller->list();

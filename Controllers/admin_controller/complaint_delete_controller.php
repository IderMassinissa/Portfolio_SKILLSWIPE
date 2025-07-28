<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/admin_model/complaint.php";

function deletebyid() {
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $complaintModel = new Complaint();
        $complaintModel->delete($id);
    }
    header('Location: /complaint_admin');
    exit;
}

deletebyid();

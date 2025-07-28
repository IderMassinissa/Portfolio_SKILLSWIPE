<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/offres_model/offres_model.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $contract_id = $_POST['contract_id'];
    $work_mode_id = $_POST['work_mode_id'];
    $company_id = $_POST['company_id'];
    $recruiter_id = $_SESSION['userID'] ?? null;

    if ($title && $description && $contract_id && $work_mode_id && $company_id && $recruiter_id) {

        addOffer($title, $description, $contract_id, $work_mode_id, $company_id, $recruiter_id);

        header("Location: /offer_list_recruiter");
        exit;
    } else {
        $error = "Tous les champs sont obligatoires.";
    }
}

$recruiter_id = $_SESSION["userID"];

$entreprise = getRecruiterEntreprise($recruiter_id);

display("offer_add_form", "Ajout d'une Offre", "offeradd");
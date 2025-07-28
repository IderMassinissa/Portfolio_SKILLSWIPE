<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/offres_model/offres_model.php";

$offerId = $_GET['OfferID'] ? $_GET['OfferID'] : $_POST['OfferID'];

if (!$offerId) {
    header("Location: /offer_list_recruiter");
    echo ("Offre introuvable.");
}

$offre = getModifyOfferInfo($offerId);

if (!$offre) {
    header("Location: /offer_list_recruiter");
    echo ("Offre non trouvée.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $contract_id = $_POST['contract_id'];
    $work_mode_id = $_POST['work_mode_id'];
    $description_id = $offre["Job_Description_ID"];

    if ($title && $description && $contract_id && $work_mode_id && $description_id) {
        
        modifyOffer($offerId, $title, $description, $contract_id, $work_mode_id, $description_id);

        header("Location: /offer_details?OfferID=" . $offerId);
        exit;
    } else {
        $error = "Tous les champs sont obligatoires.";
    }
}

display("offer_modify_form", "Modifier Une Offre", "offermodify");
<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/offres_model/offres_model.php";

$offerId = $_GET['OfferID'] ?? null;

if (!$offerId) {
    header("Location: /offer_list_recruiter");
    echo ("Offre introuvable.");
}

deleteOffer($offerId);

header("Location: /offer_list_recruiter");
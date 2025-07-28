<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/offres_model/offres_model.php";

$id = $_GET["OfferID"];

$offre = readOfferById($id);

display("offer_details_page", "Détails De l'Offre", "offerdetails");
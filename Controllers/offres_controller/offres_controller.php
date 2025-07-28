<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/offres_model/offres_model.php";

$offres = readAllOffers();

display("offers_page", "Offres", "offres");
<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/offres_model/offres_model.php";

$userID = $_SESSION["userID"];

$offres = readAllOffersById($userID);

display("offers_page_recruiter", "Offres Recruteur", "offres_recruiter");
<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/offres_model/offres_model.php";

$poste = isset($_POST['poste']) ? trim($_POST['poste']) : '';
$contrat = isset($_POST['contrat']) ? trim($_POST['contrat']) : '';
$localisation = isset($_POST['localisation']) ? trim($_POST['localisation']) : '';
$mots_cles = isset($_POST['mots_cles']) ? trim($_POST['mots_cles']) : '';

$offres = searchOffers($poste, $contrat, $localisation, $mots_cles);

if (empty($offres)) {
    echo "<p>Aucune offre ne correspond à votre recherche. Voici des offres recommandées :</p>";
    $offres = readAllOffers();
    display("offers_page", "Offres", "messagerie");
}
else {
    display("offers_page", "Offres", "messagerie");
}

<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/offres_model/offres_model.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/media_model/media_model.php";

$nom = $_POST["nom"] ?? null;
$recherche = $_POST["addresse"] ?? null;
$addressType = $_POST["addressType"] ?? null;

if (!$nom || !$recherche || !$addressType) {
    render(['error' => "Champs manquants."]);
    exit;
}

$uploadResult = uploadImage();

if ($uploadResult['success']) {
    $logoNom = $uploadResult['name'];
    $logoPath = $uploadResult['url'];

    addAddress($nom, $recherche, $addressType, $logoNom, $logoPath);

} else {

    echo 'error =>' .$uploadResult['message'];
}

require_once $_SERVER['DOCUMENT_ROOT'] . "/Views/main/page_test_form.php";
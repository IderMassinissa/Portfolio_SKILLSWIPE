<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/offres_model/offres_model.php";

$lieux = readAllAddressesWithLogo();

foreach ($lieux as $id => $lieu) {

    if (!isset($lieu["Latitude"], $lieu["Longitude"])) {
        continue; 
    }

    $lieux_formatted[$lieu["Name"]] = [
        "id" => $lieu["UserID"],
        "Address_Name" => $lieu["Address_Name"],
        "lat" => $lieu["Latitude"],
        "lon" => $lieu["Longitude"],
        "type" => $lieu["Address_Type"],
        "logo" => $lieu["logo"]
    ];
}

header('Content-Type: application/json');
echo json_encode($lieux_formatted, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
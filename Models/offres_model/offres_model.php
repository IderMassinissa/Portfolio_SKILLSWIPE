<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

$db = getDbConnection();

/* OFFRES */

function readAllOffers() {

    global $db;
    $sql = "SELECT Job_Offer.ID as offer_id,
    Job_Offer.Title as Title, 
    Job_Description.description as description, 
    Contract.Name as contract_name,
    Work_Mode.Name as work_mode, 
    Contract.ID as contract_id,
    Company.Name as company_name,
    Localisation.Address_Name as company_address
    FROM Job_Offer 
    INNER JOIN Job_Description ON Job_Offer.Job_Description_ID = Job_Description.ID
    INNER JOIN Contract ON Job_Offer.Contract_ID = Contract.ID
    INNER JOIN Work_Mode ON Job_Offer.Work_Mode_ID = Work_Mode.ID
    INNER JOIN Company ON Job_Offer.Company_ID = Company.ID
    INNER JOIN Localisation ON Company.Address_ID = Localisation.ID;";

    $requete = $db -> prepare($sql);
    $requete->execute();
    
    return $requete->fetchAll();
}

function readAllOffersById($userID) {

    global $db;

    $sql = "SELECT Job_Offer.ID as ID,
    Job_Offer.Title as Title, 
    Job_Description.description as description, 
    Company.Name as company_name,
    Localisation.Address_Name as company_address
    FROM Job_Offer 
    INNER JOIN Job_Description ON Job_Offer.Job_Description_ID = Job_Description.ID
    INNER JOIN Contract ON Job_Offer.Contract_ID = Contract.ID
    INNER JOIN Work_Mode ON Job_Offer.Work_Mode_ID = Work_Mode.ID
    INNER JOIN Company ON Job_Offer.Company_ID = Company.ID
    INNER JOIN Localisation ON Company.Address_ID = Localisation.ID
    WHERE Recruiter_ID = :id;";

    $requete = $db -> prepare($sql);
    $requete->execute(array(":id" => $userID));
    
    return $requete->fetchAll();
}

function readOfferById($id){

    global $db;
    $sql = "SELECT Job_Offer.ID as offer_id,
    Job_Offer.Title as Title, 
    Job_Description.description as description, 
    Contract.Name as contract_name,
    Work_Mode.Name as work_mode, 
    Contract.ID as contract_id,
    Company.Name as company_name,
    Localisation.Address_Name as company_address,
    User.Name as recruiter_name,
    Media.Path as recruiter_pic,
    Job_Offer.Recruiter_ID as recruiter_id
    FROM Job_Offer 
    INNER JOIN Job_Description ON Job_Offer.Job_Description_ID = Job_Description.ID
    INNER JOIN Contract ON Job_Offer.Contract_ID = Contract.ID
    INNER JOIN Work_Mode ON Job_Offer.Work_Mode_ID = Work_Mode.ID
    INNER JOIN Company ON Job_Offer.Company_ID = Company.ID
    INNER JOIN Localisation ON Company.Address_ID = Localisation.ID
    INNER JOIN User ON Job_Offer.Recruiter_ID = User.ID
    LEFT JOIN (
                    SELECT m1.*
                    FROM Media m1
                    INNER JOIN (
                        SELECT User_ID, MAX(ID) AS MaxMediaID
                        FROM Media
                        WHERE Name = 'profile_picture'
                        GROUP BY User_ID
                    ) latest ON m1.ID = latest.MaxMediaID
                ) Media ON User.ID = Media.User_ID
    WHERE Job_Offer.ID = :id;";

    $requete = $db -> prepare($sql);
    $requete->execute(array(":id" => $id));
    
    return $requete->fetch();
}

/* LOCALISATION */

function readAllAddressesWithLogo() {

    global $db;
    $sql = "SELECT 
                User.ID AS UserID,
                User.Name AS Name,
                Localisation.Address_Name AS Address_Name,
                Localisation.Latitude,
                Localisation.Longitude,
                Localisation.AddressType AS Address_Type,
                COALESCE(Media.Path, '/public/images/Default_pfp.jpg') AS logo
            FROM Localisation 
                INNER JOIN User ON Localisation.ID = User.Address_ID 
                LEFT JOIN (
                    SELECT m1.*
                    FROM Media m1
                    INNER JOIN (
                        SELECT User_ID, MAX(ID) AS MaxMediaID
                        FROM Media
                        WHERE Name = 'profile_picture'
                        GROUP BY User_ID
                    ) latest ON m1.ID = latest.MaxMediaID
                ) Media ON User.ID = Media.User_ID;";

    $requete = $db -> prepare($sql);
    $requete->execute();
    
    return $requete->fetchAll();
}

function addAddress($nom, $recherche, $addressType, $logoNom, $logoPath) {
    global $db;

    $sql = "BEGIN;
        INSERT INTO Localisation (Address_Name, Latitude, Longitude, AddressType) 
            VALUES (:addressName, :latitude, :longitude, :addressType); 
        INSERT INTO User (Name, Address_ID) 
            VALUES (:nom, LAST_INSERT_ID(Localisation)); 
        INSERT INTO Media (Name, Path, User_ID)
            VALUES (:logoNom, :logoPath,LAST_INSERT_ID(User));
        COMMIT;
    ";

    $requete = $db->prepare($sql);
    $resultat = conversionAddresse($recherche);

    if ($resultat && count($resultat) > 0) {
        $latitude = $resultat[0]['lat'];
        $longitude = $resultat[0]['lon'];

        $requete->execute(array(
            ":addressName" => $recherche,
            ":latitude" => $latitude,
            ":longitude" => $longitude,
            ":addressType" => $addressType,
            ":nom" => $nom,
            ":logoNom" => $logoNom,
            ":logoPath" => $logoPath
        ));
    }

    return false;
}

function conversionAddresse($recherche) {
    $url = "https://nominatim.openstreetmap.org/search?" . http_build_query([
        'q' => $recherche,
        'format' => 'json',
        'limit' => 1,
        'addressdetails' => 1
    ]);

    $options = [
        "http" => [
            "header" => "User-Agent: SkillswipeBot/1.0\r\n"
        ]
    ];

    $context = stream_context_create($options);

    $json = file_get_contents($url, false, $context);

    if ($json === FALSE) {
        return null;
    }

    return json_decode($json, true);
}

function searchOffers($poste, $contrat, $localisation, $mots_cles) {

    global $db;

    $sql = "SELECT 
                Job_Offer.ID as offer_id,
                Job_Offer.Title as Title, 
                Job_Description.description as description, 
                Contract.Name as contract_name,
                Work_Mode.Name as work_mode, 
                Contract.ID as contract_id,
                Company.Name as company_name,
                Localisation.Address_Name as company_address
            FROM Job_Offer 
                INNER JOIN Job_Description ON Job_Offer.Job_Description_ID = Job_Description.ID
                INNER JOIN Contract ON Job_Offer.Contract_ID = Contract.ID
                INNER JOIN Work_Mode ON Job_Offer.Work_Mode_ID = Work_Mode.ID
                INNER JOIN Company ON Job_Offer.Company_ID = Company.ID
                INNER JOIN Localisation ON Company.Address_ID = Localisation.ID
            WHERE 1=1 ";

    $params = [];

    if ($poste !== '') {
        $sql .= " AND Job_Offer.Title LIKE :poste ";
        $params[':poste'] = "%$poste%";
    }

    if ($contrat !== '') {
        $sql .= " AND Contract.Name = :contrat ";
        $params[':contrat'] = $contrat;
    }

    if ($localisation !== '') {
        $sql .= " AND Localisation.Address_Name LIKE :localisation ";
        $params[':localisation'] = "%$localisation%";
    }

    if ($mots_cles !== '') {
        $mots = explode(' ', $mots_cles);
        foreach ($mots as $index => $mot) {
            $key = ":mot$index";
            $sql .= " AND Job_Description.description LIKE $key ";
            $params[$key] = "%$mot%";
        }
    }

    $requete = $db->prepare($sql);
    $requete->execute($params);

    return $requete->fetchAll(PDO::FETCH_ASSOC);
}


function addOffer($title, $description, $contract_id, $work_mode_id, $company_id, $recruiter_id) {
        
    global $db;

    $db->beginTransaction();

    $requete = $db->prepare("INSERT INTO Job_Description (Description) VALUES (:description)");
    $requete->execute([':description' => $description]);

    $description_id = $db->lastInsertId();

    $requete = $db->prepare("INSERT INTO Job_Offer 
        (Title, Job_Description_ID, Contract_ID, Work_Mode_ID, Company_ID, Recruiter_ID)
        VALUES (:title, :description_id, :contract_id, :work_mode_id, :company_id, :recruiter_id)");

    $requete->execute([
        ':title' => $title,
        ':description_id' => $description_id,
        ':contract_id' => $contract_id,
        ':work_mode_id' => $work_mode_id,
        ':company_id' => $company_id,
        ':recruiter_id' => $recruiter_id,
    ]);

    $db->commit();
}

function deleteOffer($offerId) {
    global $db;

    $db->beginTransaction();

    $stmt = $db->prepare("SELECT Job_Description_ID FROM Job_Offer WHERE ID = :id");
    $stmt->execute([':id' => $offerId]);
    $description = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$description) {
        throw new Exception("Offre introuvable.");
    }

    $descriptionId = $description['Job_Description_ID'];

    $stmt = $db->prepare("DELETE FROM Job_Offer WHERE ID = :id");
    $stmt->execute([':id' => $offerId]);

    $stmt = $db->prepare("SELECT COUNT(*) FROM Job_Offer WHERE Job_Description_ID = :desc_id");
    $stmt->execute([':desc_id' => $descriptionId]);
    $count = $stmt->fetchColumn();

    if ($count == 0) {
        $stmt = $db->prepare("DELETE FROM Job_Description WHERE ID = :desc_id");
        $stmt->execute([':desc_id' => $descriptionId]);
    }

    $db->commit();
}

function modifyOffer($offerId, $title, $description, $contract_id, $work_mode_id, $description_id) {

    global $db;

    $db->beginTransaction();

    $requete = $db->prepare("UPDATE Job_Description SET description = :desc WHERE ID = :id");
    $requete->execute([
        ':desc' => $description,
        ':id' => $description_id
    ]);

    $requete = $db->prepare("UPDATE Job_Offer SET 
        Title = :title, 
        Contract_ID = :contract_id, 
        Work_Mode_ID = :work_mode_id
        WHERE ID = :id");
    $requete->execute([
        ':title' => $title,
        ':contract_id' => $contract_id,
        ':work_mode_id' => $work_mode_id,
        ':id' => $offerId
    ]);

    $db->commit();
}

function getModifyOfferInfo($offerId){
    global $db;

    $sql = "SELECT * FROM Job_Offer 
    INNER JOIN Job_Description ON Job_Offer.Job_Description_ID = Job_Description.ID
    WHERE Job_Offer.ID = :id";

    $requete = $db->prepare($sql);

    $requete->execute([':id' => $offerId]);

    return $requete->fetch(PDO::FETCH_ASSOC);
}

function getRecruiterEntreprise($recruiter_id) {
    global $db;

    $sql = "SELECT ID, Name FROM Company WHERE User_ID = :recruiter_id";

    $requete = $db->prepare($sql);

    $requete->execute([":recruiter_id" => $recruiter_id]);

    return $requete->fetch();
}
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/user_model/user_model.php";

if (!isset($_GET['id'])) {
    echo "Profil non spécifié.";
    exit();
}


$userID = $_GET['id']; 

$profileDetails = showUserProfile($userID);
$userImage = getUserImage($userID);
$getUserEducation = getUserEducation($userID);
$getUserExperience = getUserExperience($userID);
$getUserDocuments = getUserDocuments($userID);
$getUserSkills = getUserSkills($userID);

if (!$profileDetails || empty($profileDetails[0])) {
    echo "Utilisateur non trouvé.";
    exit();
}

// Load view
display("user_profile_page", "Profile Utilisateur", "profile");

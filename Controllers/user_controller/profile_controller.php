<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/user_model/user_model.php";

$userID = $_SESSION['userID'];
$profileDetails = showUserProfile($userID);
$userImage = getUserImage($userID); // fetch from Media table
$_SESSION['user_pic'] = (string) $userImage;
$getUserEducation = getUserEducation($userID);
$getUserExperience = getUserExperience($userID);
$getUserDocuments = getUserDocuments($userID);
$getUserSkills = getUserSkills($userID);

display("profile_page", "Profil Utilisateur", "profile");



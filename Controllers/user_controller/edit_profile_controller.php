<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$userID = $_SESSION['userID'];

require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/user_model/user_model.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/library/vector_tools.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/config/database.php"; // pour connectToDatabases()

[$pdoMain, $pdoVec] = connectToDatabases();

$operation = $_POST['info'];
$phonePattern = "/^(?:(?:\+|00)33[\s.-]{0,3}(?:\(0\)[\s.-]{0,3})?|0)[1-9](?:(?:[\s.-]?\d{2}){4}|\d{2}(?:[\s.-]?\d{3}){2})$/";
$currentData = showUserProfile($userID);
switch ($operation) {
    case 'basic':

  if ($_POST['info'] === 'basic') {
    $name        = trim($_POST['Name']);
    $number      = trim($_POST['Phone_number']);
    $address     = trim($_POST['Address']);
    $description = trim($_POST['description']);

    $currentData = showUserProfile($userID);

    $name        = $name !== ''        ? $name        : $currentData[0]['Name'];
    $number      = $number !== ''      ? $number      : $currentData[0]['Phone_number'];
    $address     = $address !== ''     ? $address     : $currentData[0]['Address'];
    $description = $description !== '' ? $description : $currentData[0]['user_description'];

    if (!empty($number) && !preg_match('/^[0-9\s\+\-\(\)]*$/', $number)) {
        echo "<script>alert('Numéro de téléphone invalide.');</script>";
    } else {
        updateBasicInfo($userID, $name, $number, $address, $description);
    }
}
    break;

    case 'skills':
        $skill = strtoupper($_POST['skill']);
        if (isset($skill)) {
            $exist = verifySkill($skill);
            if ($exist == 0) {
                $newSkill = addNewSkill($skill);
                addUserSkill($userID, $newSkill);
            } else {
                addUserSkill($userID, $exist);
            }
            updateUserVector($pdoVec, $pdoMain, $userID); // met à jour après ajout compétence
        }
        break;

    case 'education':
        if (
            $_SERVER["REQUEST_METHOD"] === "POST" &&
            isset($_POST["school"], $_POST["certificate"], $_POST["level"], $_POST["field"], $_POST["start"], $_POST["end"])
        ) {
            $school = $_POST["school"];
            $certificate = $_POST["certificate"];
            $level = $_POST["level"];
            $field = $_POST["field"];
            $start_date = $_POST["start"];
            $end_date = $_POST["end"];

            if ($start_date > $end_date) {
                echo "La date de début est postérieure à la date de fin.";
            } else {
                addEducation($userID, $school, $certificate, $level, $field, $start_date, $end_date);
            }
        }
        break;

    case 'experience':
        if (
            $_SERVER["REQUEST_METHOD"] === "POST" &&
            isset($_POST["Company"], $_POST["Position"], $_POST["Address"], $_POST["Start"], $_POST["End"])
        ) {
            $company = $_POST["Company"];
            $position = $_POST["Position"];
            $address = $_POST["Address"];
            $start = $_POST["Start"];
            $end = $_POST["End"];

            if ($start > $end) {
                echo "La date de début est postérieure à la date de fin.";
            } else {
                addExperience($userID, $company, $position, $address, $start, $end);
            }
        }
        break;

    case 'documents':
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES['cv'])) {
            $file = $_FILES['cv'];
            $fileName = $file['name'];
            $tmpName = $file['tmp_name'];
            $fileSize = $file['size'];

            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if ($fileExt !== 'pdf') {
                echo "Seuls les fichiers PDF sont autorisés.";
                exit();
            }

            if ($fileSize > 5 * 1024 * 1024) {
                echo "Le fichier est trop volumineux.";
                exit();
            }

            $uniqueName = 'CV_' . $userID . '_' . time() . '.pdf';
            $destination = './public/uploads/' . $uniqueName;

            if (!move_uploaded_file($tmpName, $destination)) {
                echo "Erreur lors du téléchargement.";
                exit();
            }

            saveDocument($userID, $fileName, $destination);
        }
        break;

    case 'profilepic':
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES['image'])) {
            $file = $_FILES['image'];
            $fileName = $file['name'];
            $tmpName = $file['tmp_name'];
            $fileSize = $file['size'];

            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowedExtensions = ['jpg', 'jpeg', 'png'];

            if (!in_array($fileExt, $allowedExtensions)) {
                echo "Seuls les fichiers JPG, JPEG et PNG sont autorisés.";
                exit();
            }

            if ($fileSize > 5 * 1024 * 1024) {
                echo "Le fichier est trop volumineux.";
                exit();
            }

            $uniqueName = 'profile_picture';
            $path = '/public/uploads/' . $fileName . '.' . $fileExt;
            $destination = '.' . $path;

            if (!move_uploaded_file($tmpName, $destination)) {
                echo "Erreur lors du téléchargement.";
                exit();
            }

            save_profile_picture($userID, $uniqueName, $path);
        }
        break;

    case 'delete_skill':
        deleteSkill($userID, $_POST['skill_id']);
        updateUserVector($pdoVec, $pdoMain, $userID); // maj vectorisation après suppression
        break;

    case 'delete_education':
        deleteEducation($_POST['edu_id']);
        break;

    case 'delete_experience':
        deleteExperience($_POST['exp_id']);
        break;

    case 'delete_document':
        deleteDocument($_POST['doc_id']);
        break;

    default:
        break;
}

echo "<script>alert('Informations mises à jour.');</script>";
header("Location: /profile");
<?php
// Enable error reporting for debugging (disable in production)
ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);


require_once $_SERVER['DOCUMENT_ROOT'] . "/library/display.php"; 
display("sign_up_form", "Créer un compte", "forms");

if (!isset($_POST['userType'], $_POST['email'], $_POST['pass'])) {
    error_log("Missing required POST fields.");
    exit;
}

//var_dump($_POST['userType']);
$userType = $_POST['userType'];
$email = $_POST['email'];
$pass = $_POST['pass'];

// Validation patterns
$emailPattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
$namePattern = "/^[a-zA-ZÀ-ÿ\s'-]{2,20}$/";
$passPattern = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[#?!@$%^&*-]).{8,}$/";

// Validate email
if (!preg_match($emailPattern, $email)) {
    error_log("Invalid email: $email");
    echo "Invalid email address.";
    exit;
}

// Validate password
if (!preg_match($passPattern, $pass)) {
    echo "Password must be at least 8 characters with uppercase, lowercase, number, and symbol.";
    exit;
} else {
    $pass = password_hash($pass, PASSWORD_ARGON2ID);
}

$fullName = '';

// Determine user type and validate related input
switch ($userType) {
    case "etudiant":
        $fName = $_POST['fName'] ?? '';
        $lName = $_POST['lName'] ?? '';
        if (!preg_match($namePattern, $fName) || !preg_match($namePattern, $lName)) {
            echo "Invalid first or last name.";
            exit;
        }
        $fullName = $fName . " " . $lName;
        break;

    case "recruteur":
        $enterprise = $_POST['enterprise'] ?? '';
        if (!preg_match($namePattern, $enterprise)) {
            echo "Invalid company name.";
            exit;
        }
        $fullName = $enterprise;
        break;

    default:
        echo "Unknown user type.";
        exit;
}

require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/user_model/user_model.php";

// Check if email already exists
if (!verifyEmail($email)) {
    error_log("Registering user: $fullName, $email, $userType");
    signup($fullName, $email, $pass, $userType);

    // Redirect safely (no output before this!)
    header("Location: /login");
    exit;
} else {
    echo "Email already exists.";
    exit;
}




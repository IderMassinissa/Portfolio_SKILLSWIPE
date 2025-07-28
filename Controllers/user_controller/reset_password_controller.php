<?php

$token = $_GET['token'];
$token_hash = hash('sha256',$token);

require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/user_model/user_model.php";


resetPassword($token_hash);



// $token = $_POST['token'];
$token_hash = hash('sha256',$token);

$validityCheck = resetPassword($token_hash);

if ($validityCheck != null) {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Views/user_view/reset_password_view.php";
    $pass1 = $POST['pass1'];
    $pass2 = $POST['pass2'];
    echo $pass1 . "  - ".$pass2;
   if ($_POST['pass1'] !== $_POST['pass2']) {
        echo 'Passwords do not match';
   }else{
    $newPass= $_POST['pass2'];
    $passPattern = '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/';

    if (preg_match($passPattern,$newPass)== false) {
        echo  "Make sure your password has at least 8 characters, including one uppercase letter, one lowercase letter, one number, and one special character.";
    }else {
        changePassword($newPass,$token_hash);
        echo "Password successfully changed";
        //redirect to login by requiring the controller
    }

   }
}



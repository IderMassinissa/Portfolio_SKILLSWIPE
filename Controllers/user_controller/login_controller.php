<?php
    error_reporting(0);
    $email = isset($_POST['email']) ? $_POST['email'] : ''; // Get email from POST
    $password = isset($_POST['pass']) ? $_POST['pass'] : ''; 

    if (empty($email) || empty($password)) {
        // echo "<br><p>Please fill in all fields.</p>";
    } else {
        require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/user_model/user_model.php";

        $mailCheck = verifyEmail($email);
        
        if ($mailCheck == true) {
            $result = login($email, $password); 

            if ($result["ID"] == null) {
                echo "Incorrect password";
                session_unset();
                session_destroy();
            }else {
                 $_SESSION['userID'] = $result["ID"];
                 $_SESSION['user_type'] = $result["Type"];
                 $_SESSION['user_pic'] = $result["userPic"];
        header("Location: /profile");
           
            }

        } else {
            header('Location: /sign_up');

        }

    }

    display("login_form", "Connexion", "forms");

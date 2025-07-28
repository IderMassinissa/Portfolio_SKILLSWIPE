<?php

display("forgot_password_form", "Mot de passe Oublié", "forms");


    $email = $_POST['email'];

    $token = bin2hex(random_bytes(16));

    $tokenHash = hash("sha256", $token);

    $expiry = date("Y-m-d H:i:s" , time() + 60 * 30);


require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/user_model/user_model.php";


forgotPassword($email,$tokenHash,$expiry);
echo $email;
echo $tokenHash;
echo $expiry;


 
$mail = require_once("../../../vendor/mailer.php");
        $mail->addAddress($_POST['email']);
        $mail->Subject = "Reset your password";
        $mail->Body = <<<END
            Click <a href= "/reset_password?token=$token">here</a> to reset your password.
        END;
        try {
    
            $mail->send();
            $mail->SMTPDebug = 1;
            $mail->Debugoutput = 'html';

            
        } catch (Exception $e) {
            echo "Message could not be sent. Error : {$mail->ErrorInfo}";
        }
    
        echo "Message sent, plaese check your inbox!";
 
   
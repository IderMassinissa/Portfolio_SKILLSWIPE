<?php
// $pageTitle = 'Connexion';
// require_once $_SERVER['DOCUMENT_ROOT'] . "/SkillSwipe/Views/Layout/header.php";
error_reporting(0);
?>

<!-- <link rel="stylesheet" href="../public/user-auth.css"> -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=visibility" />

<body>
    <a href="/" class="back"> ← Retour à l'accueil</a>
    <form action="/login" method = "POST">
        <h1>Connexion </h1>
        <div class="form-container">

            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
    
            <label for="pass">Mot de passe</label>
                <div class="pass">
                    <input type="password" name="pass" id="password" required >
                    <img src="/public/images/eye-close.png" alt="" id="eye">
                </div>
            </div>
            <a href="/forgot_password">Mot de passe oublié?</a>
        
        <input type="submit" value = "Log in"></input>
    </form>
</body>

<script>
   let showPass = document.getElementById("eye");
   let password = document.getElementById("password");

 eye.onclick = function () {
        if (password.type==="password"){
            password.type="text";
            showPass.src = "/public/images/eye-open.png";
        }else{
            password.type="password";
            showPass.src = "/public/images/eye-close.png";

        }
 }

</script>


</html>

<?php //require_once $_SERVER['DOCUMENT_ROOT'] . "/Views/Layout/footer.php"; ?>

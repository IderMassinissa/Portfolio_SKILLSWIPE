<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./public/images/Logo_SkillSwipe.png">
    <link rel="stylesheet" href="../public/css/index.css">
    <title>Skillswipe</title>
    <?php
    require_once "./public/fonts/font.php";
    ?>
</head>

<body>

    <div class="content-container">
        <!-- <header> -->

        <div class="header">
            <nav>
                <ul>
                    <li><a href="#">À propos de nous</a></li>
                    <li><a href="#">Contactez-nous</a></li>
                </ul>
            </nav>
            <div class="logo-wrapper">
                <img src="./public/images/skillswipe_logo_rework.png" alt="Logo de Skillswipe" class="logo">
            </div>
            <div class="login">
                <form action="/login">
                    <button id="login-button" type="submit" onclick="login()">Se connecter</button>
                </form>
            </div>
        </div>
        <!-- </header> -->

        <main>
            <h1 id="main-header">Trouvez votre emploi avec Skillswipe</h1>
            <p id="main-paragraph">
                Rejoignez-nous dès aujourd’hui – créez un compte personnel, professionnel ou scolaire !
            </p>
            <button type="submit" id="sign-up" onclick="signup()"><span>Créez un compte gratuitement </span></button>

            <div class="user-type" id="user-type">
                <form id="signUpForm" method="post" action="/sign_up">
                    <input type="hidden" name="userType" id="hiddenUserType">
                    <button type="button" data-userType="etudiant" class="user-type-btn">Candidat</button>
                    <button type="button" data-userType="etudiant" class="user-type-btn">Étudiant</button>
                    <button type="button" data-userType="recruteur" class="user-type-btn">Entreprise</button>
                </form>
            </div>
        </main>
    </div>

    <section class="match-section">
        <div class="content-container">
            <div class="match-info">
                <div class="match-info-left">
                    <h2>Découvrez le <br> Swipe & Match</h2>
                    <p>Trouver un job n'a jamais été aussi simple!</p>
                </div>
                <div class="match-info-right">
                    <img src="./public/images/swipe-image.png" alt="swipe-match" id="swipe-match">
                </div>
            </div>
        </div>
    </section>


</body>
<script>
    let type = document.getElementById("user-type");

    type.style.visibility = "hidden";

    function signup() {
        if (type.style.visibility == "hidden") {
            type.style.visibility = "visible";
        } else {
            type.style.visibility = "hidden";
        }
    }

    document.querySelectorAll('.user-type-btn').forEach(button => {
        button.addEventListener('click', function () {
            const userType = this.getAttribute('data-userType');
            document.getElementById('hiddenUserType').value = userType;
            document.getElementById('signUpForm').submit();

        });
    });

</script>

</html>

<?php //require_once "./Views/Layout/footer.php"; ?>
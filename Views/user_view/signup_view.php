<?php //error_reporting(0);
// 
// var_dump($userType); ?>

<body>
    <a href="/" class="back"> ← Retour à l'accueil</a>
    <form action="/sign_up" method="post">
        
        <h1>Inscription</h1>
        <input id ="userTypeField" type="hidden" name="userType">
        <label id="fName-label" class="optional-field">Prénom</label>
        <input type="text" id="fName" name="fName" class="optional-field" required>

        <label id="lName-label" class="optional-field">Nom</label>
        <input type="text" id="lName" name="lName" class="optional-field" required>

        <label id="enterprise-label" class="optional-field">Nom de l'entreprise</label>
        <input type="text" id="enterprise" name="enterprise" class="optional-field" required>
       
        <label for="email">Email</label>
        <input type="email" name="email" id="email" >

         <label for="pass">Mot de passe</label>
            <div class="pass">
                    <input type="password" name="pass" id="password" required >
                    <img src="./public/images/eye-close.png" alt="" id="eye">
                </div>
            </div>
       
        </div>
        

        <input type="submit" value="Sign Up">

    </form>
</body>

<script>
   const userType = "<?php echo  $_POST['userType']; ?>";
    console.log(userType); //get usertype from post method

  
    document.querySelectorAll('.optional-field').forEach(element => {
        element.style.display = 'none';
        if (element.hasAttribute('required')) element.required = false;
    });

    const fields = {
        user: ['fName', 'lName'],
         etudiant: ['fName', 'lName'],
        recruteur: ['enterprise']
    };

    if (fields[userType]) {
        fields[userType].forEach(id => {
        const input = document.getElementById(id);
        const label = document.getElementById(id + '-label');

        if (input) {
            input.style.display = 'block';
            input.required = true;
        }
        if (label) {
            label.style.display = 'block';
        }
        });
    }
    
       let showPass = document.getElementById("eye");
   let password = document.getElementById("password");

 eye.onclick = function () {
        if (password.type==="password"){
            password.type="text";
            showPass.src = "./public/images/eye-open.png";
        }else{
            password.type="password";
            showPass.src = "./public/images/eye-close.png";

        }
 }


 document.getElementById("userTypeField").value = userType;
</script>

</html>
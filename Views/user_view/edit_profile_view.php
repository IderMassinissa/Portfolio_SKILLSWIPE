<body>
    <h2>Ajouter une experience pro</h2><br>
     <form action="/edit_profile" method = "get">
        <label for="Poste">Poste</label>
        <input type="text" id = "poste"><br><br>
        <label for="entreprise">Entreprise</label>
        <input type="text" id = "entreprise"><br><br>
        <label for="debut">Date de Debut</label>
        <input type="date" id = "debut"><br><br>
        <label for="fin">Date de Fin</label>
        <input type="date" id = "fin">
     </form>
</body>
</html>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/Views/Layout/footer.php"; ?>

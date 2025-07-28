
<!-- Bouton d’aide -->
<button id="help-btn" class="btn-help" title="Aide Au Swipe">?</button>

<!-- Popup d’aide -->
<div id="help-popup" class="help-popup hidden">
    <div class="help-content">
        <h2>Besoin d’aide ?</h2>
        <p>➡️ Glissez à droite pour "liker" un profil</p>
        <p>⬅️ Glissez à gauche pour "passer"</p>
        <p>❤️ Un match se crée si deux parties se likent !</p>
        <button id="close-help" class="btn btn-submit btn-close">Fermer</button>
    </div>
</div>

<!-- Conteneur principal -->
<div class="page-wrapper">

    <h1>Matcher avec des profils</h1>

    <!-- Formulaire de recherche multi-compétences -->
    <form id="explore-form" class="filters">
        <input type="text" name="localisation" placeholder="Ville ou adresse">
        <input type="text" name="skills" placeholder="Compétences (ex : JavaScript, HTML, PHP)">
        <button class="btn btn-submit" type="submit">Rechercher</button>
    </form>

    <!-- Résultats de la recherche -->
    <div id="card-container" class="swipe-cards">
        <p>Utilisez les filtres ci-dessus pour découvrir des profils.</p>
    </div>
</div>

<script>
    const recruiterId = <?= isset($_SESSION['userID']) ? intval($_SESSION['userID']) : 'null' ?>;
</script>
<script type="module" src="/public/Js/swipe_user.js"></script>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/Views/Layout/footer.php"; ?>
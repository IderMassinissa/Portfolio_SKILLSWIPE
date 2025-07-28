
<!-- Bouton d’aide -->
<button id="help-btn" class="btn-help" title="Aide Au Swipe">?</button>

<!-- Popup d’aide -->
<div id="help-popup" class="help-popup hidden">
    <div class="help-content">
        <h2>Besoin d’aide ?</h2>
        <p>➡️ Glissez à droite pour "liker" un utilisateur</p>
        <p>⬅️ Glissez à gauche pour "passer"</p>
        <p>👀 Vous ne voyez que les utilisateurs qui ont liké vos offres</p>
        <button id="close-help" class="btn btn-submit btn-close">Fermer</button>
    </div>
</div>

<!-- Conteneur principal -->
<div class="page-wrapper">
    <section class="swipe-zone">
        <div class="intro-swipe">
            <h1>Découvrez les talents qui ont liké vos offres</h1>
            <a href="/profile" class="btn btn-profil">
                Modifier mon Profil
            </a>
        </div>

        <div id="card-container" class="swipe-cards">
            <p>Chargement des profils...</p>
        </div>
    </section>
</div>

<script>
    const recruiterId = <?= isset($_SESSION['userID']) ? intval($_SESSION['userID']) : 'null' ?>;
</script>
<script type="module" src="/public/Js/explore_user.js"></script>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/Views/Layout/footer.php"; ?>
<!-- Bouton d’aide -->
<button id="help-btn" class="btn-help" title="Aide Au Swipe">?</button>

<!-- Popup d’aide -->
<div id="help-popup" class="help-popup hidden">
    <div class="help-content">
        <h2>Besoin d’aide ?</h2>
        <p>➡️ Glissez à droite pour "liker" une offre</p>
        <p>⬅️ Glissez à gauche pour "passer"</p>
        <p>❤️ Un match se crée si vous vous likez mutuellement !</p>
        <button id="close-help" class="btn btn-submit btn-close">Fermer</button>
    </div>
</div>

<!-- Conteneur principal -->
<div class="page-wrapper">

    <!-- Zone swipe avec filtres, cartes et boutons -->
    <section class="swipe-zone">

        <!-- Titre et bouton de profil -->
        <div class="intro-swipe">
            <h1>Trouvez votre entreprise en un swipe !</h1>
            <a href="/profile" class="btn btn-profil">
                Modifier mon Profil
            </a>
        </div>

        <!-- Formulaire de filtres -->
        <form id="filter-form" class="filters" method="POST">
            <input type="text" name="poste" placeholder="Intitulé du poste (Développeur, Designer...)">

            <select name="contrat">
                <option value="">Type de contrat</option>
                <option value="cdi">CDI</option>
                <option value="cdd">CDD</option>
                <option value="alternance">Alternance</option>
                <option value="stage">Stage</option>
                <option value="freelance">Freelance</option>
            </select>

            <input type="text" name="secteur" placeholder="Domaine / secteur (Informatique, Marketing...)">
            <input type="text" name="localisation" placeholder="Localisation (ville, département, région)">

            <select name="distance" class="select-distance">
                <option value="">Distance max</option>
                <option value="0">0 km</option>
                <option value="3">3 km</option>
                <option value="5">5 km</option>
                <option value="7">7 km</option>
                <option value="10">10 km</option>
                <option value="15">15 km</option>
                <option value="20">20 km</option>
                <option value="30">30 km</option>
                <option value="40">40 km</option>
                <option value="50">50 km</option>
            </select>

            <div class="filter-submit">
                <button class="btn btn-submit" type="submit">Lancer une recherche</button>
            </div>
        </form>

        <!-- Conteneur des cartes -->
        <div id="card-container" class="swipe-cards"></div>
        <!-- Popup Détails Offre -->
        <div id="popup" class="offer-popup hidden">
            <button id="close-popup">&times;</button>
            <h2 id="popup-title"></h2>
            <p><strong>Entreprise :</strong> <span id="popup-company"></span></p>
            <p id="popup-description"></p>
        </div>
    </section>
</div>

<!-- Scripts -->
<script>
    const userId = <?= isset($_SESSION['userID']) ? intval($_SESSION['userID']) : 'null' ?>;
</script>
<script type="module" src="/public/Js/swipe.js"></script>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/Views/Layout/footer.php"; ?>


<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Offres</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.Default.css" />
  <link rel="stylesheet" href="./public/api/leaflet-geocoder-ban.min.css" />
  <link rel="stylesheet" href="/public/css/offres.css" />
</head>

<body>

  <form id="filter-form" class="filters" method="POST" action="/search_offer">
    <div class="form-group">
      <label for="poste">Intitulé du poste</label>
      <input type="text" id="poste" name="poste" placeholder="Développeur, Designer...">
    </div>

    <div class="form-group">
      <label for="contrat">Type de contrat</label>
      <select id="contrat" name="contrat">
        <option value="">-- Choisissez un type --</option>
        <option value="cdi">CDI</option>
        <option value="cdd">CDD</option>
        <option value="alternance">Alternance</option>
        <option value="stage">Stage</option>
        <option value="freelance">Freelance</option>
      </select>
    </div>

    <div class="form-group">
      <label for="secteur">Domaine / secteur</label>
      <input type="text" id="secteur" name="secteur" placeholder="Informatique, Marketing...">
    </div>

    <div class="form-group">
      <label for="localisation">Localisation</label>
      <input type="text" id="localisation" name="localisation" placeholder="Ville, département, région">
    </div>

    <div class="form-group">
      <label for="distance">Distance max</label>
      <select id="distance" name="distance" class="select-distance">
        <option value="">-- Sélectionnez une distance --</option>
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
    </div>

    <div class="form-group">
      <label for="mots_cles">Mots clés</label>
      <input type="text" id="mots_cles" name="mots_cles" placeholder="Compétences, technologies, autres...">
    </div>

    <div class="filter-submit">
      <button class="btn btn-submit" type="submit">Lancer une recherche</button>
    </div>
  </form>

  <div class="carte">
    <div id="map"></div>
  </div>

  <main style="display: flex; gap: 20px; margin-top: 20px;">
    <div style="flex: 2;">
        <div id="offreList">
            <?php foreach ($offres as $id => $offre): ?>
                <div class="offre-card" data-titre="<?= strtolower($offre['Title']) ?>" style="display: <?= $id < 4 ? 'block' : 'none' ?>;">
                    <h3><?= htmlspecialchars($offre['Title']) ?></h3>
                    <h4><?= htmlspecialchars($offre['company_name']) ?></h4>
                    <p><?= htmlspecialchars($offre['description']) ?></p>
                    <p><strong>Lieu :</strong> <?= htmlspecialchars($offre['company_address']) ?></p>
                    <a href="/offer_details?OfferID=<?= $offre['offer_id'] ?>" style="color:blue;">Détails</a>
                </div>
            <?php endforeach; ?>
        </div>
        
        <button id="loadMoreBtn" class="btn-load-more">Voir plus d'offres &nbsp;
          <i class="icon-long-arrow-down"></i>
        </button>
    </div>
  </main>

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script src='https://unpkg.com/leaflet.markercluster@1.3.0/dist/leaflet.markercluster.js'></script>
  <script src="./public/Js/localisation.js"></script>
  <script src="./public/api/leaflet-geocoder-ban.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const offreCards = document.querySelectorAll(".offre-card");
      const loadMoreBtn = document.getElementById("loadMoreBtn");

      let visibleCount = 4;
      const increment = 10;

      loadMoreBtn.addEventListener("click", function () {
        const total = offreCards.length;
        const nextVisible = Math.min(visibleCount + increment, total);

        for (let i = visibleCount; i < nextVisible; i++) {
          offreCards[i].style.display = "block";
        }

        visibleCount = nextVisible;

        if (visibleCount >= total) {
          loadMoreBtn.style.display = "none";
        }
      });
    });
  </script>

  <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/Views/Layout/footer.php"; ?>
</body>

</html>
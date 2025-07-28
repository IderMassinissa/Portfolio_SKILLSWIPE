<body>

    <h1>Vos offres d'emploi</h1>

    <p><a href="/add_offer" class="add-button"><button>Ajouter une offre</button></a></p>

    <?php foreach ($offres as $id => $offre): ?>
        <div class="offre">
            <h2><?= htmlspecialchars($offre['Title']) ?></h2>
            <p><strong>Entreprise :</strong> <?= htmlspecialchars($offre['company_name']) ?></p>
            <p><strong>Description :</strong> <?= nl2br(htmlspecialchars($offre['description'])) ?></p>
            <p><strong>Lieu :</strong> <?= htmlspecialchars($offre['company_address']) ?></p>

            <div class="actions">
                <a href="/offer_details?OfferID=<?= $offre['ID'] ?>"><button>Détails</button></a>
                <a href="/offer_modify?OfferID=<?= $offre['ID'] ?>"><button>Modifier</button></a>
                <a href="/delete_offer?OfferID=<?= $offre['ID'] ?>" onclick="return confirm('Confirmer la suppression ?');">
                    <button>Supprimer</button>
                </a>
            </div>
        </div>
    <?php endforeach; ?>

</body>
</html>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/Views/Layout/footer.php"; ?>
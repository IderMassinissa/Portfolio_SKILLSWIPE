<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'offre : <?= $offre["company_name"] ?></title>
    <link rel="stylesheet" href="/public/css/offerdetails.css">
</head>
<body>
    <div class="bodyoffer">
        <?php if(!$isRecruiter): ?>
            <a href="/offer_list" class="retour">← Retour</a><br>
        <?php else: ?>
            <a href="/offer_list_recruiter" class="retour">← Retour</a><br>
        <?php endif; ?>

        <div class="flipWrapper">
            <div class="offerCard">
                <div class="offer-face offerFront">
                    <span>Titre :</span>
                    <h1><?= $offre["Title"] ?></h1>

                    <p class="info">Type de contrat : <?= $offre["contract_name"] ?></p>
                    <p class="info">Mode de travail : <?= $offre["work_mode"] ?></p>
                    <p class="info">Nom de l'entreprise : <?= $offre["company_name"] ?></p>
                    <p class="info">Adresse de l'offre : <?= $offre["company_address"] ?></p>
                </div>

                <div class="offer-face offerBack">
                    <span>Description :</span>
                    <h2><?= $offre["description"] ?></h2>

                    <span>Recruteur :</span>
                    <a href="/user_profile?id=<?= $offre['recruiter_id'] ?? null ?>" class="userPic">
                        <img src="<?= $offre["recruiter_pic"] ?? "/public/images/Default_pfp.jpg" ?>" class="userPic" alt="Photo de profil recruteur">
                    </a>
                    <span><?= $offre["recruiter_name"] ?? "Recruteur RH" ?></span>

                    <?php if($isRecruiter): ?>
                        <span>Actions :</span>
                        <a href="/offer_modify?OfferID=<?= $offre['offer_id'] ?>" class="actions"><button>Modifier</button></a>
                        <a href="/delete_offer?OfferID=<?= $offre['offer_id'] ?>" class="actions" onclick="return confirm('Confirmer la suppression ?');">
                            <button>Supprimer</button>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/Views/Layout/footer.php"; ?>

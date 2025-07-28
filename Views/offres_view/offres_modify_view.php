<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'offre</title>
    <link rel="stylesheet" href="/public/css/offermodify.css">
</head>

<body>

    <main class="container">
        <div class="bodyoffer">
            <a href="/offer_list_recruiter" class="retour">← Retour</a>
            <h1>Modifier l'offre</h1>

            <?php if (!empty($error)): ?>
                <p class="error"><?= $error ?></p>
            <?php endif; ?>

            <form method="POST" action="/offer_modify">
                <input type="hidden" name="OfferID" value="<?= $offre["ID"] ?>">

                <div class="form-group">
                    <label for="title">Titre du poste :</label>
                    <input type="text" id="title" name="title" value="<?= htmlspecialchars($offre['Title']) ?>"
                        required>
                </div>

                <div class="form-group">
                    <label for="description">Description :</label>
                    <textarea id="description" name="description"
                        required><?= htmlspecialchars($offre['Description']) ?></textarea>
                </div>

                <div class="form-group">
                    <label for="contract">Type de contrat :</label>
                    <select id="contract" name="contract_id" required>
                        <option value="3" <?= $offre['Contract_ID'] == 3 ? 'selected' : '' ?>>CDI</option>
                        <option value="5" <?= $offre['Contract_ID'] == 5 ? 'selected' : '' ?>>CDD</option>
                        <option value="1" <?= $offre['Contract_ID'] == 1 ? 'selected' : '' ?>>Alternance</option>
                        <option value="2" <?= $offre['Contract_ID'] == 2 ? 'selected' : '' ?>>Stage</option>
                        <option value="4" <?= $offre['Contract_ID'] == 4 ? 'selected' : '' ?>>Freelance</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="work_mode">Mode de travail :</label>
                    <select id="work_mode" name="work_mode_id" required>
                        <option value="1" <?= $offre['Work_Mode_ID'] == 1 ? 'selected' : '' ?>>Présentiel</option>
                        <option value="2" <?= $offre['Work_Mode_ID'] == 2 ? 'selected' : '' ?>>Télétravail</option>
                        <option value="3" <?= $offre['Work_Mode_ID'] == 3 ? 'selected' : '' ?>>Hybride</option>
                    </select>
                </div>

                <div class="form-group text-center">
                    <button type="submit">Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </main>

</body>

</html>
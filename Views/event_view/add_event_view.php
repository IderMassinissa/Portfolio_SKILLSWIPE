<html lang="en">

<div class="container-event">
    <a href="/event/index" class="retour">← Retour</a>
    <h1>Ajout d'un événement</h1>
    <br>
    <br>

    <body>
        <form action="/event/store" method="POST" enctype="multipart/form-data">

            <label>Titre :</label>
            <input type="text" name="title" required><br><br>

            <label>Description :</label>
            <textarea name="description"></textarea><br><br>

            <label>Date début :</label>
            <input type="datetime-local" name="start_date" required><br><br>

            <label>Date fin :</label>
            <input type="datetime-local" name="end_date" required><br><br>

            <label>Ville :</label>
            <select name="city_id" required>
                <option value="">-- Choisissez une ville --</option>
                <?php foreach ($cities as $city): ?>
                    <option value="<?= htmlspecialchars($city['ID']) ?>">
                        <?= htmlspecialchars($city['Name']) ?>
                    </option>
                <?php endforeach; ?>
            </select><br><br>

            <label>Entreprise :</label>
            <select name="company_id" required>
                <option value="">Choisissez une entreprise</option>
                <?php foreach ($companies as $company): ?>
                    <option value="<?= htmlspecialchars($company['ID']) ?>">
                        <?= htmlspecialchars($company['Name']) ?>
                    </option>
                <?php endforeach; ?>
            </select><br><br>

            <label>Type d'événement :</label>
            <input type="text" name="event_type"><br><br>

            <label>Image (PNG/JPEG) :</label>
            <input type="file" name="image" accept="image/png, image/jpeg"><br><br>

            <button type="submit">Créer l'événement</button>

        </form>
</div>
</body>

</html>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/Views/Layout/footer.php"; ?>
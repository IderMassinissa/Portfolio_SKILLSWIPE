<a href="/event/details?id=<?= $event['ID'] ?>">← Retour</a>

<h1>Modifier l'événement</h1>

<form action="/event/update?id=<?= $event['ID'] ?>" method="POST" enctype="multipart/form-data">
    <label>Titre :</label>
    <input type="text" name="title" value="<?= htmlspecialchars($event['Title']) ?>" required><br>

    <label>Description :</label>
    <textarea name="description" required><?= htmlspecialchars($event['Description']) ?></textarea><br>

    <label>Date de début :</label>
    <input type="datetime-local" name="start_date" value="<?= date('Y-m-d\TH:i', strtotime($event['Start_date'])) ?>" required><br>

    <label>Date de fin :</label>
    <input type="datetime-local" name="end_date" value="<?= date('Y-m-d\TH:i', strtotime($event['End_date'])) ?>" required><br>

    <label>Ville :</label>
    <select name="city_id" required>
        <?php foreach ($cities as $city): ?>
            <option value="<?= $city['ID'] ?>" <?= $event['City_ID'] == $city['ID'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($city['Name']) ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <label>Entreprise :</label>
    <select name="company_id" required>
        <?php foreach ($companies as $company): ?>
            <option value="<?= $company['ID'] ?>" <?= $event['Company_ID'] == $company['ID'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($company['Name']) ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <label>Type d'événement :</label>
    <input type="text" name="event_type" value="<?= htmlspecialchars($event['Event_Type']) ?>"><br>

    <label>Image actuelle :</label><br>
    <?php if (!empty($event['Image'])): ?>
        <img src="/public/uploads/<?= htmlspecialchars($event['Image']) ?>" width="150"><br>
        <input type="hidden" name="existing_image" value="<?= htmlspecialchars($event['Image']) ?>">
    <?php endif; ?>

    <label>Nouvelle image (optionnelle) :</label>
    <input type="file" name="image"><br><br>

    <button type="submit">Enregistrer les modifications</button>
</form>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/Views/Layout/footer.php"; ?>

<div class="retour-wrapper">
    <a href="/event/index" class="retour">← Retour à la liste</a>
</div>

<main>
    <div class="event-detail">
        <h1>Détails</h1>

        <?php if (!empty($event['Image'])): ?>
            <img src="/public/uploads/<?= htmlspecialchars($event['Image']) ?>" alt="Image de l'événement">
        <?php else: ?>
            <p>Aucune image</p>
        <?php endif; ?>

        <h2><?= htmlspecialchars($event['Title']) ?></h2>

        <p><strong>Description :</strong> <?= nl2br(htmlspecialchars($event['Description'])) ?></p>
        <p><strong>Date de début :</strong> <?= date('d/m/Y H:i', strtotime($event['Start_date'])) ?></p>
        <p><strong>Date de fin :</strong> <?= date('d/m/Y H:i', strtotime($event['End_date'])) ?></p>
        <p><strong>Ville :</strong> <?= htmlspecialchars($event['City_Name']) ?></p>
        <p><strong>Entreprise :</strong> <?= htmlspecialchars($event['Company_Name']) ?></p>
        <p><strong>Type d'événement :</strong> <?= htmlspecialchars($event['Event_Type']) ?></p>

        <?php if($event['UserID'] == $_SESSION['userID']): ?>
            <form method="GET" action="/event/edit">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="id" value="<?= $event['ID'] ?>">
                <button type="submit" class="cta-button">Modifier l'événement</button>
            </form>
        <?php endif; ?>

        <?php if (!empty($_SESSION['userID'])): ?>
            <?php if (empty($isParticipating)): ?>
                <form method="POST" action="/event/participate?id=<?= htmlspecialchars($event['ID']) ?>">
                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($_SESSION['userID']) ?>">
                    <button type="submit" class="cta-button">Je participe</button>
                </form>
            <?php else: ?>
                <p>Déjà inscrit</p>
            <?php endif; ?>
        <?php else: ?>
            <p>Veuillez vous connecter pour participer</p>
        <?php endif; ?>
    </div>
</main>


<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/Views/Layout/footer.php"; ?>
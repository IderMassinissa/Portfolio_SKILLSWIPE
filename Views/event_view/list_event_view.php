<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/event_model/event.php";

$userId = $_SESSION['userID'] ?? null;
$model = new EventModel();
?>

<h1>Liste des événements</h1>

<div class="action-buttons">
    <a href="/event/add" class="create-btn">+ Créer un événement</a>
    <a href="/event/calendar" class="cta-button">Voir le calendrier</a>
    <!-- <a href="/complaint_send" class="cta-button">se plaindre (comme tout les francais)</a>
    <a href="/complaint_admin" class="cta-button">Voir les plainte</a> -->



</div>

<?php if (!empty($events)): ?>
    <div class="events-grid">
        <?php foreach ($events as $event): ?>
            <div class="event-card">
                <div class="event-image">
                    <?php if (!empty($event['Image'])): ?>
                        <img src="/public/uploads/<?= htmlspecialchars($event['Image']) ?>" alt="Event Image" style="max-width: 100%; height: auto;">
                    <?php else: ?>
                        <p>Pas d'image</p>
                    <?php endif; ?>
                </div>

                <div class="event-header">
                    <div class="event-tags">
                        <span class="tag"><?= htmlspecialchars($event['Event_Type']) ?></span>
                    </div>
                    <div class="event-title"><?= htmlspecialchars($event['Title']) ?></div>
                    <div class="event-desc"><?= htmlspecialchars($event['Description']) ?></div>

                    <?php
                        $startTime = new DateTime($event['Start_date']);
                        $endTime = new DateTime($event['End_date']);
                        $start = $startTime->format('d/m/Y H:i');
                        $end = $endTime->format('d/m/Y H:i');
                        $diff = $startTime->diff($endTime);
                        $timeEvent = $diff->format('%y ans, %m mois, %d jours, %h h %i min');
                    ?>

                    <div class="event-dates">
                        <strong>Début :</strong> <?= $start ?><br>
                        <strong>Fin :</strong> <?= $end ?><br>
                        <strong>Durée :</strong> <?= $timeEvent ?><br>
                        <strong>Ville :</strong> <?= htmlspecialchars($event['City_Name']) ?><br>
                        <strong>Entreprise :</strong> <?= htmlspecialchars($event['Company_Name']) ?>
                    </div>

                    <a href="/event/details?id=<?= htmlspecialchars($event['ID']) ?>" class="cta-button">
                        Accéder à l'événement
                    </a>
                    <!-- <?php if($event['UserID'] == $_SESSION['userID']): ?>
                        <a href="/event/delete?id=<?= htmlspecialchars($event['ID']) ?>" onclick="return confirm('Supprimer cet événement ?')" class="cta-button"> 
                            SUPPRIMER
                        </a>
                    <?php endif; ?> -->

                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p style="text-align:center;">Aucun événement trouvé.</p>
<?php endif; ?>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/Views/Layout/footer.php"; ?>
</body>
</html>

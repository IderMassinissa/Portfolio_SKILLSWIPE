<div class="calendar-container">

    <a href="/event/index" class="retour">← Retour</a>

    <h1>Calendrier</h1>

    <div class="months">
        <a href="?month=<?= $prevMonth ?>&year=<?= $prevYear ?>">← Mois précédent</a>
        <span><?= ucfirst(date('F', mktime(0, 0, 0, $month, 10))) . ' ' . $year ?></span>
        <a href="?month=<?= $nextMonth ?>&year=<?= $nextYear ?>">Mois suivant →</a>
    </div>

    <div class="calendar">
        <?php for ($day = 1; $day <= $daysInMonth; $day++): 
            $currentDate = date('Y-m-d', strtotime("$year-$month-$day")); ?>
            <div class="day">
                <div class="day-number"><?= $day ?></div>

                <?php if (!empty($eventsByDay[$currentDate])): ?>
                    <?php foreach ($eventsByDay[$currentDate] as $event): ?>
                        <div class="event">
                            <strong><?= htmlspecialchars($event['Title']) ?></strong>
                            <?= date('H:i', strtotime($event['Start_date'])) ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        <?php endfor; ?>
    </div>

</div>
</main

</html>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/Views/Layout/footer.php"; ?>

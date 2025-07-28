<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/event_model/event.php";

    class EventParticipationController {
    public function participate() {
        $userId = $_POST['user_id'] ?? null;
        $eventId = $_GET['id'] ?? null;

        if (!$userId) {
            echo "Utilisateur ou événement manquant";
            header("Location: /login");
            return;
        }

        $participationModel = new ParticipationModel();
        if ($participationModel->isUserParticipating($userId, $eventId)) {
            header("Location: /event/index");
        } else {
            $participationModel->participate($userId, $eventId);
            header("Location: /event/index");
        }
    }
}


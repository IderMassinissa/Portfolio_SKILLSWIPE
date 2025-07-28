<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/event_model/event.php";


class EventDetailController {
    public function show() {
        if (session_status() === PHP_SESSION_NONE) {
    session_start(); //a regler
}

        $userId = $_SESSION['userID'] ?? null;
        $eventId= $_GET['id'] ?? null;

        if (!$eventId) {
            echo "ID manquant";
            return;
        }

        $eventModel = new EventModel();
        $event = $eventModel->getEventById($eventId);

        if (!$event) {
            echo "Événement introuvable";
            return;
        }

        $isParticipating = false;
        if ($userId) {
            $participationModel = new ParticipationModel();
            $isParticipating = $participationModel->isUserParticipating($userId, $eventId);
        }

        display("event_detail_page", "Détails d'un Evenement", "eventdetails", ['event' => $event]);
    }
}

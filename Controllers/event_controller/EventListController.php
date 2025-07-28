<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/event_model/event.php";

class EventListController {
    public function index() {

        $eventModel = new EventModel();
        $events = $eventModel->getAllEvents();
        display("event_list_page", "Evenements", "eventlist", ['events' => $events]);
    }
}

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/event_model/event.php";

class EventDeleteController{
    public function deleteevent(){
        $eventId= $_GET['id']?? null;
        if (!$eventId) {
            echo "test fo";
            return;
        }
        $model = new EventModel();
        $result = $model->deleteEvent($eventId);

        header('Location: /event/index');
    }
}


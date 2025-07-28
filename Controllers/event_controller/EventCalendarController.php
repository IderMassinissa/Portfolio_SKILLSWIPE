<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/event_model/event.php";

class EventCalendarController {
    public function calendar() {

        if (!isset($_SESSION['userID'])) {
            header("Location: /login");
            exit();
        }

        $userId = $_SESSION['userID'];
        $month = $_GET['month'] ?? date('n');
        $year = $_GET['year'] ?? date('Y');

        $participationModel = new ParticipationModel();
        $events = $participationModel->getUserParticipationsByMonth($userId, $year, $month);

        $eventsByDay = [];
        foreach ($events as $event) {
            $day = date('Y-m-d', strtotime($event['Start_date']));
            $eventsByDay[$day][] = $event;
        }

        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $prevMonth = $month - 1;
        $nextMonth = $month + 1;
        $prevYear = $year;
        $nextYear = $year;

        if ($prevMonth < 1) {
            $prevMonth = 12;
            $prevYear--;
        }
        if ($nextMonth > 12) {
            $nextMonth = 1;
            $nextYear++;
        }

        display("event_calendar_page", "Calendrier", "calendar", [
                                                                    'eventsByDay' => $eventsByDay,
                                                                    'month' => $month,
                                                                    'year' => $year,
                                                                    'daysInMonth' => $daysInMonth,
                                                                    'prevMonth' => $prevMonth,
                                                                    'nextMonth' => $nextMonth,
                                                                    'prevYear' => $prevYear,
                                                                    'nextYear' => $nextYear
                                                                 ]);
    }
}


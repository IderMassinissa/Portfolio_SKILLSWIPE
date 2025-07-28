<?php
// regler les this ???

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

class EventModel {
    private PDO $db;

    public function __construct() {
        $this->db = getDbConnection();
    }

    public function deleteEvent($id) {
        $stmt1 = $this->db->prepare("DELETE FROM Participation WHERE Event_ID = ?");
        $stmt1->execute([$id]);

        return $stmt1->fetch(PDO::FETCH_ASSOC);
    }


    public function getAllEvents() {
        $stmt = $this->db->query("
            SELECT
                Event.ID AS ID,
                Event.UserID AS UserID,
                Event.Title AS Title,
                Event.Description,
                Event.Start_date AS Start_date,
                Event.End_date AS End_date,
                Event.Image,
                City.Name AS City_Name,
                Company.Name AS Company_Name,
                Event.Event_Type
            FROM Event
            INNER JOIN Company ON Event.Company_ID = Company.ID
            INNER JOIN City ON Event.City_ID = City.ID
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function createEvent($data) {
        $stmt = $this->db->prepare("
            INSERT INTO Event
            (UserID, Title, Description, Start_date, End_date, City_ID, Company_ID, Event_Type, Image)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $data['UserID'],
            $data['Title'],
            $data['Description'],
            $data['Start_date'],
            $data['End_date'],
            $data['City_ID'],
            $data['Company_ID'],
            $data['Event_Type'],
            $data['Image']
        ]);
    }


    public function getEventsByMonth($year, $month) {
        $start = "$year-$month-01";
        $end = date("Y-m-t", strtotime($start));

        $stmt = $this->db->prepare("
            SELECT * FROM Event
            WHERE Start_date BETWEEN :start AND :end
        ");
        $stmt->execute([
            'start' => $start,
            'end' => $end
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getEventById($id) {
        $stmt = $this->db->prepare("
            SELECT Event.*, City.Name AS City_Name, Company.Name AS Company_Name
            FROM Event
            INNER JOIN City ON Event.City_ID = City.ID
            INNER JOIN Company ON Event.Company_ID = Company.ID
            WHERE Event.ID = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


}

class ParticipationModel {
    private PDO $db;

    public function __construct() {
        $this->db = getDbConnection();
    }

    public function getUserParticipationsByMonth($userId, $year, $month) {
    $start = "$year-$month-01";
    $end = date("Y-m-t", strtotime($start));

    $stmt = $this->db->prepare("
        SELECT Event.*
        FROM Participation
        INNER JOIN Event ON Participation.Event_ID = Event.ID
        WHERE Participation.User_ID = ?
        AND Event.Start_date BETWEEN ? AND ?
    ");
    $stmt->execute([$userId, $start, $end]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function isUserParticipating($userId, $eventId) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM Participation WHERE User_ID = ? AND Event_ID = ?");
        $stmt->execute([$userId, $eventId]);
        return $stmt->fetchColumn() > 0;
    }

    public function participate($userId, $eventId) {
        $stmt = $this->db->prepare("INSERT INTO Participation (User_ID, Event_ID) VALUES (?, ?)");
        $stmt->execute([$userId, $eventId]);
    }
}




<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

$db = getDbConnection();

function readConversations($id) {

    global $db;

    $sql = "SELECT 
        m.ID AS MatchID,
        other_user.ID AS OtherUserID,
        other_user.Name AS OtherUserName,
        COALESCE(med.Path, '/public/images/Default_pfp.jpg') AS OtherUserImage,
        m.Status,
        m.Matched_At,
        msg.Content AS LastMessage,
        msg.Sent_At AS LastMessageDate,
        sender.ID AS LastMessageSenderID,
        sender.Name AS LastMessageSenderName
    FROM Matching m
        JOIN User other_user
            ON other_user.ID = CASE 
                WHEN m.Recruiter_ID = :user_id THEN m.User_ID
                ELSE m.Recruiter_ID 
            END
        LEFT JOIN Media med
            ON other_user.ID = med.User_ID
            AND med.Name = 'profile_picture'
        LEFT JOIN Message msg
            ON msg.ID = (
                SELECT ID FROM Message 
                WHERE Match_ID = m.ID 
                ORDER BY Sent_At DESC 
                LIMIT 1
            )
        LEFT JOIN User sender
            ON sender.ID = msg.Sender_ID
    WHERE m.Recruiter_ID = :user_id OR m.User_ID = :user_id;";


    $requete = $db -> prepare($sql);
    $requete->execute(array(":user_id" => $id));
    
    return $requete->fetchAll();
}

function readLastConv($id) {

    global $db;

    $sql = "SELECT 
                m.ID AS MatchID, 
                IF(m.Recruiter_ID = :user_id, m.User_ID, m.Recruiter_ID) AS OtherUserID,
                other_user.Name AS OtherUserName 
            FROM Matching m 
            JOIN User other_user
                ON other_user.ID = IF(m.Recruiter_ID = :user_id, m.User_ID, m.Recruiter_ID)
            WHERE m.Recruiter_ID = :user_id OR m.User_ID = :user_id
            ORDER BY MatchID ASC 
            LIMIT 1;
            ";

    $requete = $db -> prepare($sql);
    $requete->execute(array(":user_id" => $id));
    
    return $requete->fetch();
}

function readConversationByMatch($MatchID) {

    global $db;

    $sql = "SELECT 
                msg.ID AS MessageID,
                msg.Sender_ID,
                msg.Receiver_ID,
                sender.Name AS SenderName,
                COALESCE(sender_m.Path, '/public/images/Default_pfp.jpg') AS SenderImage,
                msg.Content,
                msg.Sent_At
            FROM Message msg
                JOIN User sender 
                    ON msg.Sender_ID = sender.ID
                LEFT JOIN Media sender_m
                    ON sender.ID = sender_m.User_ID
                    AND sender_m.Name = 'profile_picture'
            WHERE msg.Match_ID = :MatchID
            ORDER BY msg.Sent_At ASC;";
    
    $requete = $db -> prepare($sql);
    $requete->execute(array(":MatchID" => $MatchID));
    
    $messages = $requete->fetchAll();

    $uniqueMessages = [];
    $seen = [];

    foreach ($messages as $msg) {
        if (!in_array($msg['MessageID'], $seen)) {
            $seen[] = $msg['MessageID'];
            $uniqueMessages[] = $msg;
        }
    }

    return $uniqueMessages;
}

function sendMessage($MatchID, $SenderID, $ReceiverID, $MsgContent, $DocumentID) {
    global $db;
    $sql = "INSERT INTO Message (Match_ID, Sender_ID, Receiver_ID, Content, Document_ID) VALUES (:MatchID, :SenderID, :ReceiverID, :MsgContent, :DocumentID);";
    
    $requete = $db -> prepare($sql);
    $requete->execute(array(":MatchID" => $MatchID, ":SenderID" => $SenderID, ":ReceiverID" => $ReceiverID, ":MsgContent" => $MsgContent, ":DocumentID" => $DocumentID));
    
    return $requete->fetch();
}

function modifyMessage($MsgID, $MsgContent) {
    global $db;
    $sql = "UPDATE Message SET Content = :MsgContent WHERE ID = :MsgID";
    
    $requete = $db -> prepare($sql);
    $requete->execute(array(":MsgID" => $MsgID, ":MsgContent" => $MsgContent));
    
    return $requete->fetch();
}

function deleteMessage($MsgID) {
    global $db;
    $sql = "DELETE FROM Message WHERE ID = :MsgID";
    
    $requete = $db -> prepare($sql);
    $requete->execute(array(":MsgID" => $MsgID));
    
    return $requete->fetch();
}

function getLastMessage($MatchID) {
    global $db;
    $requete = $db->prepare("SELECT ID, Sent_At FROM Message WHERE Match_ID = ? ORDER BY Sent_At DESC LIMIT 1");
    $requete->execute([$MatchID]);
    return $requete->fetch(PDO::FETCH_ASSOC);
}

function deleteConversation($MatchID) {
    global $db;
    $sql = "DELETE FROM Matching WHERE ID = :MatchID";
    
    $requete = $db -> prepare($sql);
    $requete->execute(array(":MatchID" => $MatchID));

    return $requete->fetch();
}

<?php
//model
require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/messagerie_model/messages_model.php";

$id = $_SESSION['userID'];

$conversations = readConversations($id);
$lastconv = readLastConv($id); 


if(!isset($_GET["MatchID"])) {

    $match = isset($lastconv["MatchID"]) ? $lastconv["MatchID"] : null;
    $OtherID = isset($lastconv["OtherUserID"]) ? $lastconv["OtherUserID"] : null;

} else {

    $match = $_GET["MatchID"];
    $OtherID = isset($_GET["OtherUserID"]) ? $_GET["OtherUserID"] : null;

}

$messages = readConversationByMatch($match);
//view
display("messages_page", "Messagerie", "messagerie");

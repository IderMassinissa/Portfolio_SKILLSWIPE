<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/messagerie_model/messages_model.php";

$MatchID = $_GET['MatchID'];

deleteConversation($MatchID);

header("Location: /message_list");
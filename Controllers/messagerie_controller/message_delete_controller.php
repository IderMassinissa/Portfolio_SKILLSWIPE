<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/messagerie_model/messages_model.php";

$MsgID = $_GET['id'];

deleteMessage($MsgID);

header("Location: /message_list");

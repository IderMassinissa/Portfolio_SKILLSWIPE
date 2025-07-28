<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/messagerie_model/messages_model.php";

$MsgID = (int)$_POST["message_id"];
$MsgContent = htmlspecialchars(strip_tags($_POST["content"]), ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401);

modifyMessage($MsgID, $MsgContent);

header("Location: /message_list");

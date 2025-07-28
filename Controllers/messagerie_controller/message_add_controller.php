<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/messagerie_model/messages_model.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/media_model/media_model.php";

if (
    !isset($_POST["MatchID"], $_POST["SenderID"], $_POST["ReceiverID"], $_POST["inputMsg"])
) {
    http_response_code(400);
    echo "Champs POST manquants.";
    exit;
}

$MatchID = $_POST["MatchID"];
$SenderID = $_POST["SenderID"];
$ReceiverID = $_POST["ReceiverID"];
$MsgContent = htmlspecialchars(strip_tags($_POST["inputMsg"]), ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401);

$MsgContentFinal = embedMediaInText($MsgContent);

$DocumentID = null;
if (
    isset($_FILES["fileToUpload"]) &&
    $_FILES["fileToUpload"]["error"] === UPLOAD_ERR_OK &&
    is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])
) {
    $uploadResult = uploadImage();

    if (!empty($uploadResult['name']) && !empty($uploadResult['url'])) {
        $DocumentNom = $uploadResult['name'];
        $DocumentPath = $uploadResult['url'];

        $DocumentID = addMedia($SenderID, $DocumentNom, $DocumentPath);

        $Content = ' <img src="' .htmlspecialchars($DocumentPath). '" style="width: 150px; height: 150px;"><a class="dwn" href="' . htmlspecialchars($DocumentPath) . '" download>' . htmlspecialchars($DocumentNom) . '</a><br><br>'. $MsgContentFinal; 
    }
} else {
    $Content = $MsgContentFinal;
}

sendMessage($MatchID, $SenderID, $ReceiverID, $Content, $DocumentID);

header("Location: /message_list");

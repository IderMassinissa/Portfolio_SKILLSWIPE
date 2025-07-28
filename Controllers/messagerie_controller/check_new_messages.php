<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/messagerie_model/messages_model.php';

$MatchID = $_GET['MatchID'] ?? null;
$LastSent = $_GET['LastSentAt'] ?? null;

if (!$MatchID || !$LastSent) {
    echo json_encode(['error' => 'Match ID ou date manquante']);
    exit;
}

$lastMessage = getLastMessage($MatchID); 

if ($LastSent !== (string)$lastMessage['Sent_At']) {
    echo json_encode([
        'refresh' => true,
        'new_Sent_At' => $lastMessage['Sent_At']
    ]);
} else {
    echo json_encode(['refresh' => false]);
}
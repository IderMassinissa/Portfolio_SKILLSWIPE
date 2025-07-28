<main>
    <h2>Messagerie</h2>
    <div class="Titres">
        <h3>Conversations</h3>
        <h4><?php if (isset($lastconv["OtherUserName"])): ?>
                Messages avec <?= $lastconv["OtherUserName"] ?>
            <?php else: ?>
                Aucune Conversation en cours.
            <?php endif; ?>
        </h4>
    </div>
    <div class="spaceMessages">
        <div class="bloc conversationLists">
            <?php foreach ($conversations as $id => $conversation): ?>
                <?php if (!empty($conversation["LastMessage"])): ?>
                    <div class="conversationWrapper">
                            <div class="conversation">
                                <img src="<?= $conversation["OtherUserImage"] ?>" class="userPic">
                                <div class="messageContent">
                                    <div class="messageHeader">
                                        <h1><?= $conversation["OtherUserName"] ?></h1>
                                        <span class="timestamp"><?= $conversation["LastMessageDate"] ?></span>
                                        <a href="/conversation_delete?MatchID=<?= $conversation["MatchID"] ?>" onclick="return confirm('Supprimer cette conversation ?')" class="delete-conv">x</a>
                                    </div>
                                    <a href="/message_list?MatchID=<?= $conversation["MatchID"] . "&OtherUserID=" . $conversation["OtherUserID"]?>" class="conv-btn">
                                        <p class="content">
                                        <?php 
                                        
                                        $conversation["LastMessage"] = preg_replace_callback(
                                            '#<iframe[^>]*src="([^"]+)"[^>]*>.*?</iframe>#is',
                                            function ($matches) {
                                                return '[Vidéo: ' . $matches[1] . ']';
                                            },
                                            $conversation["LastMessage"]
                                        );

                                        if($conversation["LastMessageSenderName"] == $conversation["OtherUserName"]) {
                                            echo ($conversation["OtherUserName"]. ": ...");
                                        } else {
                                            echo ("<strong>Toi: ...</strong>");
                                        }

                                        ?>
                                        </p>
                                    </a>
                                </div>
                            </div>
                    </div>
                <?php else: ?>
                    <div class="conversationWrapper">
                        <div class="conversation">
                            <img src="<?= $conversation["OtherUserImage"] ?>" class="userPic">
                            <div class="messageContent">
                                <div class="messageHeader">
                                    <h1><?= $conversation["OtherUserName"] ?></h1>
                                </div>
                                <a href="/message_list?MatchID=<?= $conversation["MatchID"] . "&OtherUserID=" . $conversation["OtherUserID"]?>" class="conv-btn">
                                    <p>Aucun message pour cette conversation.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <div class="bloc messagerie" id="messages">
            <?php foreach($messages as $id => $message): ?>
                <div class="message" data-id="<?= $message["MessageID"] ?>">
                    <a href="/user_profile?id=<?= $message["Sender_ID"] ?>" class="userPic">
                        <img src="<?= $message["SenderImage"] ?>" class="userPic">
                    </a>
                    <div class="messageContent">
                        <div class="messageHeader">
                            <h1><?= $message["SenderName"] ?></h1>
                            <span class="timestamp"><?= $message["Sent_At"] ?></span>
                            <?php if($message["Sender_ID"] == $_SESSION["userID"]): ?>
                                <div class="dropdown">
                                    <button class="dropdown-btn">...</button>
                                    <div class="dropdown-content">
                                        <a id="edit" class="edit-btn">Modifier</a>
                                        <a id="delete" class="delete-msg-btn" href="/message_delete?id=<?= $message["MessageID"] ?>">Supprimer</a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <p id="msg-content" class="msg-content" contenteditable="false"><?= $message["Content"] ?></p>
                        <button id="save-btn" class="save-btn" style="display: none;">Envoyer</button>
                    </div>
                </div>
            <?php $lastSentAt = $message["Sent_At"]; ?>
            <?php endforeach; ?>
            <?php if (empty($messages)): ?>
                <div class="no-messages">
                    <p>Aucun message pour cette conversation.</p>
                    <p>Envoyez en un pour être le premier !</p>
                </div>
            <?php endif; ?>

            <div class="formMsg">
                <?php if ($OtherID): ?>
                <form action ="/message_add" onsubmit="disableSubmitButton()" method="POST" enctype="multipart/form-data">
                    <span id="fileNameDisplay"></span>
                    <input type="hidden" name="MatchID" value=<?= $match ?>>
                    <input type="hidden" name="SenderID" value=<?= $_SESSION['userID'] ?>>
                    <input type="hidden" name="ReceiverID" value=<?= $OtherID ?>>
                    <textarea id="inputMsg" class="inputMsg" name="inputMsg" autocomplete="off" placeholder="Entrez votre Message" required></textarea>
                    <label for ="fileToUpload" class="fileImg" id="fileImg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                            <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z"/>
                        </svg>
                    </label>
                    <input type="file" name="fileToUpload" id="fileToUpload" style="display:none;">
                    <input class="envoyer" type="submit" value="Envoyer">
                </form>
                <?php else: ?>
                <p>Vous ne pouvez envoyer de message tant que vous n'avez pas de conversation active.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>
<script src="./public/Js/messagerie.js"></script>
<script>
    let lastSentAt = <?= json_encode($lastSentAt) ?>;

    function checkForNewMessages() {
        const MatchID = <?= (int)$match ?>;

        fetch(`/Controllers/messagerie_controller/check_new_messages.php?MatchID=${MatchID}&LastSentAt=${encodeURIComponent(lastSentAt)}`)
            .then(res => res.json())
            .then(data => {
                if (data.refresh) {
                    lastSentAt = data.new_Sent_At;
                    location.reload(); 
                }
            })
            .catch(console.error);
    }

    setInterval(checkForNewMessages, 5000);
</script>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/Views/Layout/footer.php"; ?>

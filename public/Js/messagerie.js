"use strict";

window.addEventListener('load', function () {
    const container = document.getElementById('messages');
    if (container) {
        container.scrollTop = container.scrollHeight;
    }
});

function disableSubmitButton() {
    const btn = document.querySelector('#messageForm button[type="submit"]');
    if (btn) {
        btn.disabled = true;
        btn.innerText = 'Envoi...';
    }
}

const fileToUpload = document.getElementById('fileToUpload');
const fileNameDisplay = document.getElementById('fileNameDisplay');
if (fileToUpload && fileNameDisplay) {
    fileToUpload.addEventListener('change', function () {
        if (fileToUpload.files.length > 0) {
            fileNameDisplay.textContent = fileToUpload.files[0].name;
        } else {
            fileNameDisplay.textContent = ' ';
        }
    });
}

document.querySelectorAll('.dropdown-btn').forEach(button => {
    button.addEventListener('click', function () {
        const dropdown = this.nextElementSibling;

        document.querySelectorAll('.dropdown-content').forEach(menu => {
            if (menu !== dropdown) {
                menu.style.display = 'none';
            }
        });

        dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
    });
});

window.addEventListener('click', function (e) {
    if (!e.target.matches('.dropdown-btn')) {
        document.querySelectorAll('.dropdown-content').forEach(menu => {
            menu.style.display = 'none';
        });
    }
});

document.querySelectorAll('.message').forEach(messageEl => {
    const messageDiv = messageEl.querySelector('.msg-content');
    const editBtn = messageEl.querySelector('.edit-btn');
    const saveBtn = messageEl.querySelector('.save-btn');
    let wasModified = false;

    if (!messageDiv || !editBtn || !saveBtn) return;

    editBtn.addEventListener('click', () => {
        messageDiv.contentEditable = "true";
        messageDiv.focus();
        saveBtn.style.display = "inline-block";
    });

    saveBtn.addEventListener('click', () => {
        messageDiv.contentEditable = "false";
        saveBtn.style.display = "none";

        messageDiv.innerHTML = messageDiv.innerHTML.replace(/<span class="modified-tag">\((modifié)\)<\/span>/, '').trim();

        if (!wasModified) {
            messageDiv.innerHTML += ' <span class="modified-tag">(modifié)</span>';
            wasModified = true;
        }

        const messageID = messageEl.getAttribute('data-id');
        const msgContent = messageDiv.innerHTML;

        fetch('/Controllers/messagerie_controller/message_modify_controller.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                message_id: messageID,
                content: msgContent
            })
        })
            .then(response => response.text())
    });
});


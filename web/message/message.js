$(document).ready(function () {
    // Sélectionne les éléments de l'interface.
    const messageInput = $("#messageInput");
    const sendButton = $("#sendButton");
    const chat = $(".chat");

    // Fonction pour vérifier la limite de messages.
    function checkMessageLimit() {
        $.post('check_message_limit.php', function (response) {
            if (response.canSend) {
                messageInput.prop('disabled', false);
                sendButton.prop('disabled', false);
            } else {
                messageInput.prop('disabled', true);
                sendButton.prop('disabled', true);
                window.location.href = "../dash/dashboard.php";
            }
        }, 'json');
    }

    // Gestionnaire d'événement pour le bouton d'envoi de message.
    sendButton.on("click", function () {
        sendMessage(username);
    });

    // Gestionnaire d'événement pour l'appui sur la touche "Enter" dans le champ de message.
    messageInput.on("keypress", function (event) {
        if (event.key === "Enter") {
            sendMessage(username);
        }
    });

    // Gestionnaire d'événement pour les clics sur les éléments de la barre latérale (utilisateurs).
    $(".sidebar ul li").on("click", function () {
        username = $(this).attr("id");
        loadConversation(username);
        if (!admin) {
            showChat();
        }
    });

    // Affiche le champ de message et le bouton d'envoi.
    function showChat() {
        messageInput.show();
        sendButton.show();
    }

    // Fonction pour envoyer un message.
    function sendMessage(username) {
        const messageContent = messageInput.val().trim();
        if (messageContent !== "") {
            $.post('check_message_limit.php', function (response) {
                if (response.canSend) {
                    const recipient = $(".chat-area .sidebar ul li.active").attr("id");
                    $.post(window.location.href, { message: messageContent, recipient: username }, function () {
                        showMessage(messageContent, 'sent');
                        messageInput.val("");
                        loadConversation(username);
                        checkMessageLimit();
                    });
                } else {
                    messageInput.prop('disabled', true);
                    sendButton.prop('disabled', true);
                    document.getElementById('errorMessage').style.display = "block";
                    document.getElementById('errorMessage').innerText = "❌You reached your limit of messages per day❌";
                }
            }, 'json');
        }
    }

    // Fonction pour afficher un message dans la fenêtre de chat.
    function showMessage(messageContent, messageType, messageID, sender, recipient) {
        const messageElement = $("<div></div>").addClass("message").addClass(messageType).text(messageContent);
        const deleteIcon = $('<span class="delete-icon"><i class="bx bx-trash"></i></span>');
        const reportIcon = $('<span class="report-icon"><i class="bx bxs-error"></i></i></span>');
        messageElement.data("messageID", messageID);
        messageElement.data("sender", sender);
        messageElement.data("recipient", recipient);
        messageElement.append(deleteIcon);
        messageElement.append(reportIcon);
        chat.append(messageElement);
        chat.append("<br>");
        chat.scrollTop(chat.prop("scrollHeight"));
    }

    // Fonction pour charger une conversation avec un utilisateur spécifique.
    function loadConversation(username) {
        chat.empty();
        $.get("../../data/message.csv", function (data) {
            const lines = data.split("\n");
            lines.forEach(function (line) {
                const rowData = line.split(",");
                const sender = rowData[0];
                const recipient = rowData[1];
                const message = rowData[2];
                const messageID = rowData[3];
                if (currentUser === sender) {
                    if (username === recipient) {
                        showMessage(message, 'sent', messageID, sender, recipient);
                    }
                }
                else if (currentUser === recipient) {
                    if (username === sender) {
                        showMessage(message, 'received', messageID, sender, recipient);
                    }
                }
            });
        });
    }

    // Affiche l'icône de suppression lors du survol des messages envoyés.
    $(".chat").on("mouseenter", ".sent", function () {
        $(this).find(".delete-icon").css("display", "inline-block");
    });

    // Cache l'icône de suppression lorsque le curseur quitte un message envoyé.
    $(".chat").on("mouseleave", ".sent", function () {
        $(this).find(".delete-icon").css("display", "none");
    });

    // Affiche l'icône de rapport lors du survol des messages reçus.
    $(".chat").on("mouseenter", ".received", function () {
        $(this).find(".report-icon").css("display", "inline-block");
    });

    // Cache l'icône de rapport lorsque le curseur quitte un message reçu.
    $(".chat").on("mouseleave", ".received", function () {
        $(this).find(".report-icon").css("display", "none");
    });

    // Gestionnaire d'événement pour la suppression d'un message.
    $(".chat").on("click", ".delete-icon", function () {
        const messageID = $(this).closest('.message').data("messageID");
        $.ajax({
            url: '../../admin/removeMsg.php',
            type: 'post',
            data: {
                'ID': messageID
            },
            success: function (response) {
                loadConversation(username);
            }
        });
    });

    // Gestionnaire d'événement pour le rapport d'un message.
    $(".chat").on("click", ".report-icon", function () {
        const reportedMessage = $(this).closest('.message');
        const sender = reportedMessage.data("sender");
        const recipient = reportedMessage.data("recipient");
        const messageContent = reportedMessage.text().trim();

        $.ajax({
            url: '../../admin/report.php',
            type: 'post',
            data: {
                'reporter': recipient,
                'reported': sender,
                'reason': 'said :' + messageContent
            },
            success: function (response) {
                // Possibilité d'ajouter une action en cas de succès, actuellement vide.
            }
        });
    });

    // Vérifie la limite de messages au chargement de la page.
    checkMessageLimit();
});


$(document).ready(function () {
    const messageInput = $("#messageInput");
    const sendButton = $("#sendButton");
    const chat = $(".chat");

    sendButton.on("click", function () {
        sendMessage(username);
    });

    messageInput.on("keypress", function (event) {
        if (event.key === "Enter") {
            sendMessage(username);
        }
    });

    $(".sidebar ul li").on("click", function () {
        username = $(this).attr("id");
        loadConversation(username);
        if (!admin) {
            showChat();
        }
    });

    function showChat() {
        messageInput.show();
        sendButton.show();
    }

    function sendMessage(username) {
        const messageContent = messageInput.val().trim();
        if (messageContent !== "") {
            const recipient = $(".chat-area .sidebar ul li.active").attr("id");
            $.post(window.location.href, { message: messageContent, recipient: username }, function () {
                showMessage(messageContent, 'sent');
                messageInput.val("");
                loadConversation(username);
            });
        }
    }

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


    $(".chat").on("mouseenter", ".sent", function () {
        $(this).find(".delete-icon").css("display", "inline-block");
    });

    $(".chat").on("mouseleave", ".sent", function () {
        $(this).find(".delete-icon").css("display", "none");
    });

    $(".chat").on("mouseenter", ".received", function () {
        $(this).find(".report-icon").css("display", "inline-block");
    });

    $(".chat").on("mouseleave", ".received", function () {
        $(this).find(".report-icon").css("display", "none");
    });

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

            }
        });
    });


});

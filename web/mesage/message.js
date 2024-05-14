$(document).ready(function(){
    const messageInput = $("#messageInput");
    const sendButton = $("#sendButton");
    const chat = $(".chat");

    sendButton.on("click", function(){
        sendMessage(username);
    });

    messageInput.on("keypress", function(event){
        if (event.key === "Enter"){
            sendMessage(username);
        }
    });

    $(".sidebar ul li").on("click", function(){
        username = $(this).attr("id");
        loadConversation(username);
        showChat();
    });

    function showChat(){
        messageInput.show();
        sendButton.show();
    }

    function sendMessage(username){
        const messageContent = messageInput.val().trim();
        if (messageContent !== "") {
            const recipient = $(".chat-area .sidebar ul li.active").attr("id");
            $.post(window.location.href, { message: messageContent, recipient: username }, function(){
                showMessage(messageContent, 'sent');
                messageInput.val("");
            });
        }
    }

    function showMessage(messageContent, messageType){
        const messageElement = $("<div></div>").addClass(messageType).text(messageContent);
        const deleteIcon = $('<span class="delete-icon">&#x1F5D1;</span>');
        messageElement.append(deleteIcon);
        chat.append(messageElement);
        chat.append("<br>");
        chat.scrollTop(chat.prop("scrollHeight"));
    }

    function loadConversation(username){
        chat.empty();
        $.get("../../data/message.csv", function(data){
            const lines = data.split("\n");
            lines.forEach(function(line) {
                const rowData = line.split(";");
                const sender = rowData[0];
                const recipient = rowData[1];
                const message = rowData[2];
                if(currentUser === sender){
                    if (username === recipient){
                        showMessage(message, 'sent');
                    }
                }
                else if(currentUser === recipient){
                    if(username === sender){
                        showMessage(message, 'received');
                    }
                }
            });
        });
    }

    $(".chat").on("click", ".delete-icon", function(){
        const messageID = $(this).parent().data("id");
        deleteMessage(messageID, username);
        $(this).parent('.sent').remove();
    });

    function deleteMessage(messageID, username){
        $.post(window.location.href, {deleteID: messageID});
        loadConversation(username);
    }
    
});

<!-- resources/views/chat.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
</head>
<body>
    <div class="chat-container">
        <div class="messages-container" id="messagesContainer">
            <!-- Messages will be displayed here -->
        </div>
        <form id="sendMessageForm">
            @csrf <!-- Add CSRF token -->
            <input type="text" id="messageInput" placeholder="Type your message...">
            <button type="submit">Send</button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/chat.js') }}"></script>
</body>
</html>

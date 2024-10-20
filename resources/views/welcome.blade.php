<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook Messages</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            background: #e9ecef;
            margin: 10px 0;
            padding: 15px;
            border-radius: 5px;
            transition: background 0.3s;
        }
        li:hover {
            background: #d3d3d3;
        }
        .message-info {
            margin: 5px 0;
            color: #555;
        }
        .message-info span {
            font-weight: bold;
            color: #333;
        }
        .no-messages {
            text-align: center;
            color: #888;
        }
    </style>
</head>
<body>
@extends('layouts.app')

@section('content')
    <h1>Conversations</h1>

    @if(isset($conversations) && count($conversations) > 0)
        <ul>
            @foreach($conversations as $conversation)
                <li>
                    <strong>Conversation ID:</strong> {{ $conversation['id'] }} <br>
                    <strong>From:</strong> {{ $conversation['from']['name'] }} <br>
                    <a href="#" class="view-messages" data-id="{{ $conversation['id'] }}">View Messages</a>
                </li>
            @endforeach
        </ul>
    @else
        <p>No conversations found.</p>
    @endif

    <!-- Reply form (for demonstration purposes)
    <div id="reply-form" style="display:none;">
        <h2>Reply to Message</h2>
        <form id="replyForm">
            <textarea name="message" required></textarea>
            <button type="submit">Send Reply</button>
        </form>
    </div>

    <script>
        document.querySelectorAll('.view-messages').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const conversationId = this.dataset.id;
                // Fetch messages using AJAX and display them
                fetch(`/conversations/${conversationId}/messages`)
                    .then(response => response.json())
                    .then(data => {
                        // Process and display messages
                        console.log(data);
                        // Show the reply form
                        document.getElementById('reply-form').style.display = 'block';
                    });
            });
        });

        document.getElementById('replyForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const messageId = 'YOUR_MESSAGE_ID'; // Replace with the message ID you want to reply to
            const message = this.message.value;

            fetch(`/messages/${messageId}/reply`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ message })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.success || data.error);
            });
        });
    </script> -->
@endsection

</body>
</html>

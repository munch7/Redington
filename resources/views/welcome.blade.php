<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook Messages</title>
</head>
<body>
    <h1>Facebook Messages</h1>

    @if(isset($messages) && count($messages) > 0)
    <ul>
        @foreach ($messages as $message)
            <li>
                ID: {{ $message['id'] ?? 'No ID' }} <br>
                From: {{ $message['from']['name'] ?? 'Unknown sender' }} <br>
                Message: {{ $message['message']['text'] ?? 'No message content' }} <br>
                Sent At: {{ \Carbon\Carbon::parse($message['created_time'])->format('d M Y, h:i A') ?? 'No time available' }} <br>
            </li>
        @endforeach
    </ul>
    @else
        <p>No messages found.</p>
    @endif
</body>


</html>

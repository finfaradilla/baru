<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent Cancellation</title>
</head>
<body>
    <p>Hello {{ $rent->user->name }},</p>
    <p>Your reservation for the room <strong>{{ $rent->room->name }}</strong> has been cancelled.</p>
    <p><strong>Reason for Cancellation:</strong> {{ $rejection_reason }}</p>
    <p>We apologize for any inconvenience this may cause.</p>
    <p>Best regards,</p>
    <p>Scorpa Pranedya</p>
</body>
</html>

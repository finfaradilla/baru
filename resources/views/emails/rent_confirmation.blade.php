<!DOCTYPE html>
<html>
<head>
    <title>Room Rent Confirmation</title>
</head>
<body>
    <h1>Room Rent Confirmation</h1>
    <p>Dear {{ $rent->user->name }},</p>
    <p>Thank you for renting the room {{ $rent->room->name }}.</p>
    <p>Details of your reservation:</p>
    <ul>
        <li>Start Time: {{ $rent->time_start_use }}</li>
        <li>End Time: {{ $rent->time_end_use }}</li>
        <li>Purpose: {{ $rent->purpose }}</li>
        <li>Number of Pax: {{ $rent->number_of_pax }}</li>
        @if ($rent->additional_request)
            <li>Additional Request: {{ $rent->additional_request }}</li>
        @endif
    </ul>
    <p>Best Regards,</p>
    <p>Scorpa Pranedya</p>
</body>
</html>

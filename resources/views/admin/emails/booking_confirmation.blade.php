<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
</head>
<body>
    <h2>Thank you for your booking, {{ $booking->user?->name }}!</h2>
    <p>Your service <strong>{{ $booking->service?->name }}</strong> with provider 
       <strong>{{ $booking->provider?->name }}</strong> has been successfully booked.</p>

    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($booking->date)->format('d M Y') }}</p>
    <p><strong>Time:</strong> {{ $booking->slot?->start_time }} - {{ $booking->slot?->end_time }}</p>

    <p>We look forward to serving you!</p>
</body>
</html>

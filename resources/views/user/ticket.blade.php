<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>
</head>

<body>
    <h1>Ticket</h1>
    <p>Réservation pour : {{ $reservation->event->titre }}</p>
    <p>Date : {{ $reservation->event->date }}</p>
    <p>Lieu : {{ $reservation->event->lieu }}</p>

    <p>Code QR :</p>
    <div class="mb-3">
        {!! QrCode::generate('Date : ' . $reservation->event->date . "\n" . 'Lieu :' . $reservation->event->lieu) !!}
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Reservation Confirmed!</h1>
            <p class="text-gray-600">Thank you for your reservation.</p>
        </div>

        <div class="border border-gray-200 p-4 rounded-lg mb-6">
            <h2 class="text-xl font-bold text-gray-800 text-center">{{ $reservation->eventPrice->event->title }}</h2>
            <p class="text-gray-600 mb-4 text-center">{{ $reservation->eventPrice->event->description }}</p>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <h3 class="font-bold text-gray-800">Location</h3>
                    <p class="text-gray-600">{{ $reservation->eventPrice->event->location }}</p>
                    <a href="{{ $reservation->eventPrice->event->google_map_url }}" target="_blank" class="text-blue-500 underline">View on Google Maps</a>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800">Date & Time</h3>
                    <p class="text-gray-600">{{ \Carbon\Carbon::parse($reservation->eventPrice->event->start_date)->format('F j, Y') }} - {{ \Carbon\Carbon::parse($reservation->eventPrice->event->end_date)->format('F j, Y') }}</p>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="font-bold text-gray-800">Ticket Grade</h3>
            <p class="text-gray-600">{{ $reservation->eventPrice->title }}</p>
        </div>

        <div class="mb-6">
            <h3 class="font-bold text-gray-800">Privileges</h3>
            @php
                $privileges = json_decode($reservation->eventPrice->privileges, true);
            @endphp
            <ul class="text-gray-600 list-disc pl-5">
                @foreach($privileges as $privilege)
                    <li>{{ $privilege }}</li>
                @endforeach
            </ul>
        </div>

        <div class="text-center mt-6">
            <p class="text-gray-600 text-sm">Your reservation code is:</p>
            <p class="text-gray-800 text-2xl font-bold">{{ $reservation->code }}</p>
        </div>

        <div class="text-center mt-6">
            <p class="text-gray-600 text-sm">We look forward to seeing you at the event!</p>
        </div>

        <div class="text-center mt-6">
            <p class="text-gray-600 text-sm">If you have any questions, feel free to contact us.</p>
            <a href="mailto:{{ env('MAIL_FROM_ADDRESS') }}" class="text-blue-500 underline">{{ env('MAIL_FROM_ADDRESS') }}</a>
        </div>
    </div>
</body>
</html>

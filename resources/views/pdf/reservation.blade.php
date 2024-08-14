<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Ticket</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .border-custom {
            border: 2px solid #e2e8f0; /* Light gray border */
            border-radius: 0.5rem; /* Rounded corners */
            padding: 1.5rem; /* Padding inside the border */
            background-color: #f9fafb; /* Slightly off-white background */
        }
    </style>
</head>
<body class="bg-gray-50 p-6">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center space-x-4">
                <img src="{{ public_path($reservation->user->avatar) }}" alt="User Avatar" class="w-16 h-16 rounded-full object-cover">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">{{ $reservation->user->name }}</h1>
                    <p class="text-gray-600">{{ $reservation->user->email }}</p>
                    <p class="text-gray-600">{{ $reservation->user->phone }}</p>
                </div>
            </div>
            <div>
                <img src="{{ public_path($reservation->eventPrice->event->banner) }}" alt="Event Banner" class="w-48 h-24 object-cover rounded-lg">
            </div>
        </div>

        <div class="text-center mb-6 border-custom">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $reservation->eventPrice->event->title }}</h2>
            <p class="text-gray-600">{{ $reservation->eventPrice->event->description }}</p>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
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

        <div class="mb-6">
            <h3 class="font-bold text-gray-800">Ticket Grade</h3>
            <p class="text-gray-600">{{ $reservation->eventPrice->title }}</p>
        </div>

        <div class="bg-gray-100 p-4 rounded-lg text-center">
            <p class="text-gray-600 text-2xl">{{ $reservation->code }}</p>
        </div>
    </div>
</body>
</html>

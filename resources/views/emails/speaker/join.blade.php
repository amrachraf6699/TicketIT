<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speaker Account Created</title>
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
            <h1 class="text-2xl font-bold text-gray-800">Speaker Account Created!</h1>
            <p class="text-gray-600">Congratulations! You have been joined to our platform as a speaker of <strong>{{ $event_planner->name }}</strong>.</p>
        </div>

        <div class="border border-gray-200 p-4 rounded-lg mb-6">
            <h2 class="text-xl font-bold text-gray-800 text-center">Welcome, {{ $speaker->username }}!</h2>
            <p class="text-gray-600 mb-4 text-center">We are excited to have you as a speaker. Below are your account details:</p>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <h3 class="font-bold text-gray-800">Username</h3>
                    <p class="text-gray-600">{{ $speaker->username }}</p>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800">Email</h3>
                    <p class="text-gray-600">{{ $speaker->email }}</p>
                </div>
            </div>
        </div>

        <div class="text-center mb-6">
            <img src="{{ $event_planner->avatar }}" alt="{{ $event_planner->name }}" class="w-24 h-24 rounded-full mx-auto">
            <p class="text-gray-600 mt-4"><strong>{{ $event_planner->name }}</strong> has added you as a speaker.</p>
        </div>

        <div class="text-center mt-6">
            <p class="text-gray-600 text-sm">Please log in to your account to complete your profile and start managing your events.</p>
            <p class="text-gray-600 text-sm p-2 border border-danger">Your temporary password is <strong>Password</strong></p>
        </div>

        <div class="text-center mt-6">
            <a href="{{ url('/') }}" class="text-blue-500 underline">Visit Website to Download App</a>
        </div>

        <div class="text-center mt-6">
            <p class="text-gray-600 text-sm">If you have any questions, feel free to contact us.</p>
            <a href="mailto:{{ env('MAIL_FROM_ADDRESS') }}" class="text-blue-500 underline">{{ env('MAIL_FROM_ADDRESS') }}</a>
        </div>
    </div>
</body>
</html>

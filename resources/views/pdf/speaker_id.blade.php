<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speaker ID</title>
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
                <img src="{{ url($user->avatar) }}" alt="Speaker Avatar" class="w-16 h-16 rounded-full object-cover">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">{{ $user->name }} <span class="text-gray-400 text-xs">({{ $user->speaker->job_title }})</span></h1>
                    <p class="text-gray-600">{{ $user->email }}</p>
                    <p class="text-gray-600">{{ $user->phone }}</p>
                </div>
            </div>
            <div>
                <img src="{{ url($user->speaker->company->user->avatar) }}" alt="Company Logo" class="w-32 h-32 object-cover rounded-lg">
            </div>
        </div>
        <div class="text-center mb-2 text-sm text-gray-500">
            {{ $user->speaker->bio }}
        </div>
        <div class="text-center mb-6 border-custom">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $user->speaker->company->user->name }}</h2>
            <p class="text-gray-600">{{ $user->speaker->company->user->phone }} | {{ $user->speaker->company->user->email }}</p>
        </div>

        <div  class="text-center text-xs mt-3 border border-2">
            <p class="text-gray-600">{{ $user->uuid }} | {{ $user->speaker->company->user->uuid }}</p>
        </div>
    </div>
</body>
</html>

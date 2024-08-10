<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Join Request</title>
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-gray-900 p-4 shadow-lg">
        <div class="container mx-auto flex items-center justify-between">
            <div class="text-white font-bold text-2xl">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('logo.png') }}" alt="logo" class="w-16 h-16">
                </a>
            </div>

            <div>
                <button class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white rounded-full px-4 py-2 hover:bg-blue-700">
                    Download App
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto my-8 p-8 bg-white shadow-lg rounded-lg">
        <div class="relative flex flex-col mt-6 text-gray-700 bg-white shadow-md bg-clip-border rounded-xl">
            <div
                class="relative h-56 overflow-hidden text-white shadow-lg bg-clip-border rounded-xl bg-blue-gray-500 shadow-blue-gray-500/40">
                <img
                    src="{{ $data->avatar }}"
                    alt="request-image" class="w-full h-full object-cover" />
                <!-- Icon based on request status -->
                <p class="text-center text-2xl"> Your request has been received. </p>
            </div>
            <div class="p-6">
                <h5 class="block mb-2 font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                    Request Details
                </h5>
                <p class="block font-sans text-base antialiased font-light leading-relaxed text-inherit">
                    <strong>Name:</strong> {{ $data->name }}<br>
                    <strong>Email:</strong> {{ $data->email }}<br>
                    <strong>Phone:</strong> {{ $data->phone }}<br>
                    <strong>Username:</strong> {{ $data->username }}<br>
                </p>
            </div>
            <!-- Last Updated Section -->
            <div class="p-6 pt-0 border-t text-center border-gray-200">
                <p class="text-gray-600 text-sm mt-4">Requested on: {{ $data->created_at->format('F j, Y, g:i a') }}</p>
                <p class="text-gray-600 text-sm mt-4">Last updated on: {{ $data->updated_at->format('F j, Y, g:i a') }}</p>
            </div>
        </div>
    </div>
</body>
</html>

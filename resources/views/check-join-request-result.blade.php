<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Join Request</title>
    <script src="https://cdn.tailwindcss.com/"></script>
    <script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>
    <style>
        .dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-gray-900 p-4 shadow-lg">
        <div class="container mx-auto flex items-center justify-between">
            <div class="text-white font-bold text-2xl">
                <a href="#">
                    <img src="{{ asset('logo.png') }}" alt="logo" class="w-16 h-16">
                </a>
            </div>

            <div class="relative dropdown">
                <button class="text-white focus:outline-none">
                    Join Request
                    <svg class="w-4 h-4 ml-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <div class="dropdown-menu absolute right-0 mt-2 py-2 w-48 bg-white rounded-lg shadow-xl hidden">
                    <a href="{{ route('join-request') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Request Join</a>
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Check Join Request</a>
                </div>
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
                    src="{{ $join_request->avatar }}"
                    alt="request-image" class="w-full h-full object-cover" />
                <!-- Icon based on request status -->
                <div class="absolute top-4 right-4 text-white">
                    @if ($join_request->status === 'pending')
                        <box-icon name='time-five' color='#f59e0b'></box-icon>
                    @elseif ($join_request->status === 'approved')
                        <box-icon name='check-circle' type='solid' color='#10b981'></box-icon>
                    @elseif ($join_request->status === 'rejected')
                        <box-icon name='x-circle' type='solid' color='#ef4444'></box-icon>
                    @endif
                </div>
            </div>
            <div class="p-6">
                <h5 class="block mb-2 font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                    Request Details
                </h5>
                <p class="block font-sans text-base antialiased font-light leading-relaxed text-inherit">
                    <strong>Name:</strong> {{ $join_request->name }}<br>
                    <strong>Email:</strong> {{ $join_request->email }}<br>
                    <strong>Phone:</strong> {{ $join_request->phone }}<br>
                    <strong>Username:</strong> {{ $join_request->username }}<br>
                    <strong>Status:</strong> <span class="
                    @switch($join_request->status)
                        @case('pending')
                            text-yellow-800
                        @break
                        @case('approved')
                            text-green-800
                        @break
                        @case('rejected')
                            text-red-800
                        @break
                    @endswitch
                    ">{{ ucfirst($join_request->status) }}</span>
                </p>
            </div>
            <div class="p-6 pt-0">
                <h2 class="text-xl font-semibold text-gray-900">Notes</h2>
                @forelse($join_request->notes as $note)
                    <div class="bg-gray-100 p-4 my-4 rounded-lg">
                        <p>{{ $note->note }}</p>
                        <span class="text-sm text-gray-600">{{ $note->created_at->format('F j, Y, g:i a') }}</span>
                    </div>
                @empty
                    <p class="text-gray-600 text-center text-2xl">No notes available.</p>
                @endforelse
            </div>
            <!-- Last Updated Section -->
            <div class="p-6 pt-0 border-t text-center border-gray-200">
                <p class="text-gray-600 text-sm mt-4">Requested on: {{ $join_request->created_at->format('F j, Y, g:i a') }}</p>
                <p class="text-gray-600 text-sm mt-4">Last updated on: {{ $join_request->updated_at->format('F j, Y, g:i a') }}</p>
            </div>
        </div>
    </div>

    <script>
        function toggleDropdown() {
            const dropdownMenu = document.querySelector('.dropdown-menu');
            dropdownMenu.classList.toggle('hidden');
        }
    </script>
</body>
</html>

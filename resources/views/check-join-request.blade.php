<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Form</title>
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
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Request Join</a>
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
                <!-- Placeholder for the card image -->
                <img src="https://images.unsplash.com/photo-1540553016722-983e48a2cd10?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=800&amp;q=80" alt="request-image" class="w-full h-full object-cover" />
                <!-- Icon based on request status -->
                <div class="absolute top-4 right-4 text-white">
                    <box-icon name='edit' color='#ffffff'></box-icon>
                </div>
            </div>
            <div class="p-6">
                <h5 class="block mb-2 font-sans text-xl text-center antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                    Check Join Request
                </h5>
                <form action="" method="GET" class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">ID</label>
                        <input type="text" id="name" name="id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" value="{{ old('id') }}" >
                        @error('id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-center">
                        <button type="submit" class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white rounded-full px-8 py-3 text-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            Check
                        </button>
                    </div>
                </form>

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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Reservation & Management</title>
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

    <!-- Hero Section -->
    <section class="bg-white">
        <div class="container mx-auto flex flex-col items-center justify-center px-6 py-12 md:flex-row">
            <div class="md:w-1/2">
                <h1 class="text-4xl font-bold text-gray-800">Event Reservation & Management</h1>
                <p class="mt-4 text-gray-600">Simplify your event planning process. Reserve venues, manage attendees,
                    and track everything in one place.</p>
                <button
                    class="mt-6 bg-gradient-to-r from-cyan-500 to-blue-500 text-white rounded-full px-8 py-3 text-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Reserve Now
                </button>
            </div>
            <div class="mt-8 md:mt-0 md:w-1/2">
                <img src="https://images.unsplash.com/photo-1597262975002-c5c3b14bbd62?auto=format&fit=crop&w=800&q=80"
                    alt="Event Image" class="w-full h-full object-cover rounded-lg shadow-lg">
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-gray-100 py-12">
        <div class="container mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800">Our Features</h2>
                <p class="mt-4 text-gray-600">Explore the powerful tools we offer to streamline your event planning.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                    <box-icon name="calendar-check" size="lg" color="#0d6efd"></box-icon>
                    <h3 class="mt-4 text-xl font-semibold text-gray-800">Easy Reservations</h3>
                    <p class="mt-2 text-gray-600">Quickly reserve venues and manage bookings with our intuitive
                        platform.</p>
                </div>

                <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                    <box-icon name="user-check" size="lg" color="#0d6efd"></box-icon>
                    <h3 class="mt-4 text-xl font-semibold text-gray-800">Attendee Management</h3>
                    <p class="mt-2 text-gray-600">Keep track of attendees and manage RSVPs effortlessly.</p>
                </div>

                <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                    <box-icon name="bar-chart-alt-2" size="lg" color="#0d6efd"></box-icon>
                    <h3 class="mt-4 text-xl font-semibold text-gray-800">Analytics & Reports</h3>
                    <p class="mt-2 text-gray-600">Gain insights with detailed reports on your events.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="bg-gradient-to-r from-cyan-500 to-blue-500 py-12">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-white">Ready to get started?</h2>
            <p class="mt-4 text-white">Join us today and make your next event a success.</p>
            <button
                class="mt-6 bg-white text-cyan-500 rounded-full px-8 py-3 text-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
                Get Started
            </button>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 py-6">
        <div class="container mx-auto text-center text-white">
            <p>&copy; 2024 {{ env('APP_NAME') }}. All rights reserved.</p>
        </div>
    </footer>

    <script>
        function toggleDropdown() {
            const dropdownMenu = document.querySelector('.dropdown-menu');
            dropdownMenu.classList.toggle('hidden');
        }
    </script>
</body>

</html>

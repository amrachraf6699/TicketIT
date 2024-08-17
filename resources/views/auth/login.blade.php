<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com/"></script>
    <script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>
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

            <div>
                <a href="/" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 rounded-full px-4 py-2 hover:bg-blue-700">
                    Home
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto my-8 p-8 bg-white shadow-lg rounded-lg max-w-md">
        <h2 class="text-2xl font-bold text-center text-gray-800">Login</h2>

        <form action="" method="POST" class="mt-8">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="text" id="email" name="email" class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>


            <button type="submit" class="w-full bg-gradient-to-r from-cyan-500 to-blue-500 text-white rounded-full px-4 py-2 hover:bg-blue-700">
                Login
            </button>
        </form>
    </div>

</body>
</html>

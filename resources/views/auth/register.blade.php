<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white flex items-center justify-center h-screen">
<div class="w-full max-w-md p-8 space-y-6 bg-gray-800 rounded-lg shadow-lg">
    <h2 class="text-3xl font-bold text-center">Register</h2>
    <form action="{{ route('register') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="name" class="block mb-2 text-sm font-medium">Name</label>
            <input type="text" id="name" name="name" autofocus autocomplete="name" value="{{old('name')}}"
                   class="w-full p-3 rounded bg-gray-700 text-gray-100 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('name')
            <span class="text-red-500 text-sm mt-1"> {{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="email" class="block mb-2 text-sm font-medium">Email</label>
            <input type="email" id="email" name="email" autocomplete="email" value="{{old('email')}}"
                   class="w-full p-3 rounded bg-gray-700 text-gray-100 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('email')
            <span class="text-red-500 text-sm mt-1"> {{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="password" class="block mb-2 text-sm font-medium">Password</label>
            <input type="password" id="password" name="password" autocomplete="new-password"
                   class="w-full p-3 rounded bg-gray-700 text-gray-100 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('password')
            <span class="text-red-500 text-sm mt-1"> {{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="password_confirmation" class="block mb-2 text-sm font-medium">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password"
                   class="w-full p-3 rounded bg-gray-700 text-gray-100 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('password_confirmation')
            <span class="text-red-500 text-sm mt-1"> {{ $message }}</span>
            @enderror
        </div>
        <button type="submit"
                class="w-full py-3 mt-4 bg-blue-600 rounded-lg font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Register
        </button>
        <p class="mt-4 text-sm text-center">Already have an account? <a href="{{route("show-login-form")}}" class="text-blue-400 hover:underline">Login</a></p>
    </form>
</div>
</body>
</html>
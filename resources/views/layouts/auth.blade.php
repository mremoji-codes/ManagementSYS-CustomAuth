<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth Page | ManagementSYS</title>

    <!-- Tailwind CSS CDN -->
    @vite('resources/css/app.css')


    <style>
        body {
            background: url('{{ asset('images/background.png') }}') no-repeat center center fixed;
            background-size: cover;
        }
        .glass {
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body class="min-h-screen flex justify-center items-start pt-24 px-4 sm:px-6 lg:px-8 text-white">

    <div class="glass rounded-2xl p-8 sm:p-10 w-full max-w-md sm:max-w-lg transition-all duration-300">
        @yield('content')
    </div>

</body>
</html>

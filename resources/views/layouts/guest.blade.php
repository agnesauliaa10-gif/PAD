<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="flex min-h-screen bg-gray-100">
        <!-- Left Side: Image/Branding -->
        <div class="hidden lg:flex lg:w-1/2 bg-gray-900 justify-center items-center relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-900 to-gray-900 opacity-90 z-10"></div>
            <!-- Abstract rectangles decoration -->
            <div
                class="absolute -top-24 -left-24 w-96 h-96 bg-indigo-700 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob">
            </div>
            <div
                class="absolute -bottom-24 -right-24 w-96 h-96 bg-purple-700 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000">
            </div>

            <div class="relative z-20 text-white p-12 text-center">
                <h1 class="text-5xl font-bold mb-6 tracking-tight">WMS <span class="text-indigo-400">Pro</span></h1>
                <p class="text-xl text-gray-300 max-w-lg mx-auto leading-relaxed">
                    Streamline your inventory, optimize your workflow, and take control of your warehouse operations
                    with our premium management system.
                </p>
            </div>
        </div>

        <!-- Right Side: Form -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-8 bg-white">
            <div class="w-full max-w-md">
                <div class="text-center mb-10 lg:hidden">
                    <h2 class="text-3xl font-bold text-gray-900">WMS <span class="text-indigo-600">Pro</span></h2>
                </div>

                {{ $slot }}
            </div>
        </div>
    </div>

    <style>
        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }
    </style>
</body>

</html>
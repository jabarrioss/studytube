<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'StudyTube') }} - Learn with Timestamped Notes</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 dark:text-gray-100 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-indigo-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
            <div class="mb-8">
                <a href="/" class="flex items-center space-x-2">
                    <span class="text-3xl">📚</span>
                    <div class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">
                        StudyTube
                    </div>
                </a>
                <p class="text-center text-sm text-gray-600 dark:text-gray-400 mt-2">Take timestamped notes on YouTube videos</p>
            </div>

            <div class="w-full sm:max-w-md px-6 py-8 bg-white dark:bg-gray-800 shadow-xl overflow-hidden sm:rounded-xl border border-gray-200 dark:border-gray-700">
                {{ $slot }}
            </div>

            <div class="mt-8 text-center text-sm text-gray-500 dark:text-gray-400">
                <p>&copy; {{ date('Y') }} StudyTube. Made with ❤️ for learners.</p>
            </div>
        </div>
    </body>
</html>

<!DOCTYPE html>
<html lang="bn" x-data="darkMode()" :class="{ 'dark': isDark }" x-init="init()">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'MediAssist BD') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 transition-colors duration-300">

    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
        @include('layouts.navigation')

        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-100 dark:border-gray-700">
                <div class="max-w-7xl mx-auto py-4 px-4">
                    {{ $header }}
                </div>
            </header>
        @endif

        <main>
            {{ $slot }}
        </main>
    </div>

    <script>
        function darkMode() {
            return {
                isDark: false,
                init() {
                    this.isDark = localStorage.getItem('darkMode') === 'true' ||
                        (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches);
                },
                toggle() {
                    this.isDark = !this.isDark;
                    localStorage.setItem('darkMode', this.isDark);
                }
            }
        }
    </script>
</body>
</html>

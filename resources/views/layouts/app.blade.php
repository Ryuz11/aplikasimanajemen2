<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gradient-to-br from-indigo-200 via-white to-cyan-200 min-h-screen">
        <div class="min-h-screen flex flex-col">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="w-full bg-gradient-to-r from-indigo-600 via-blue-500 to-cyan-400 shadow-lg rounded-b-xl mb-6 sticky top-0 z-30 backdrop-blur border-b border-indigo-200 dark:border-blue-300">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex items-center justify-between">
                        <h1 class="text-2xl font-bold text-white drop-shadow">{{ $header }}</h1>
                        <!-- Optional: Add user avatar or quick actions here -->
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">
                <div class="bg-white/90 dark:bg-blue-100/80 rounded-xl shadow-2xl p-8 min-h-[60vh] border border-indigo-100 dark:border-blue-200 animate-fade-in">
                    {{ $slot }}
                </div>
            </main>

            <footer class="w-full bg-gradient-to-r from-indigo-600 via-blue-500 to-cyan-400 text-white shadow-inner border-t border-indigo-200 dark:border-blue-300 mt-auto">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between py-6 gap-4">
                    <div class="flex items-center gap-3">
                        <svg xmlns='http://www.w3.org/2000/svg' class='h-7 w-7 text-white/80' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7M16 3v4M8 3v4m-5 4h18' /></svg>
                        <span class="font-semibold tracking-wide text-lg drop-shadow">Aplikasi Manajemen Stok</span>
                    </div>
                    <div class="text-xs md:text-sm opacity-90">
                        &copy; {{ date('Y') }} Aplikasi Manajemen Stok. All rights reserved.
                    </div>
                    <div class="flex gap-3">
                        <a href="#" class="hover:text-cyan-100 transition-colors" title="Kebijakan Privasi">Kebijakan Privasi</a>
                        <span class="hidden md:inline">|</span>
                        <a href="#" class="hover:text-cyan-100 transition-colors" title="Kontak">Kontak</a>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Loading Screen Overlay -->
        <div id="loading-overlay" class="fixed inset-0 z-50 flex items-center justify-center bg-white/80 backdrop-blur-sm transition-opacity duration-300 opacity-0 pointer-events-none">
            <div class="flex flex-col items-center gap-4">
                <div class="relative flex items-center justify-center">
                    <span class="absolute inline-block w-16 h-16 rounded-full border-4 border-indigo-300 animate-ping"></span>
                    <svg class="animate-spin h-12 w-12 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                </div>
                <span class="text-indigo-700 font-semibold text-lg animate-pulse">Memuat...</span>
            </div>
        </div>
        <script>
            // Show loading overlay on navigation or form submit
            function showLoading() {
                const overlay = document.getElementById('loading-overlay');
                if (overlay) {
                    overlay.style.opacity = '1';
                    overlay.style.pointerEvents = 'auto';
                }
            }
            function hideLoading() {
                const overlay = document.getElementById('loading-overlay');
                if (overlay) {
                    overlay.style.opacity = '0';
                    overlay.style.pointerEvents = 'none';
                }
            }
            // Show loading on page navigation
            window.addEventListener('beforeunload', showLoading);
            // Show loading on all form submits
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('form').forEach(function(form) {
                    form.addEventListener('submit', showLoading);
                });
                // Hide loading after page load
                hideLoading();
            });
        </script>

        <style>
            .animate-fade-in {
                animation: fadeIn 0.7s cubic-bezier(0.4,0,0.2,1);
            }
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
        </style>
    </body>
</html>

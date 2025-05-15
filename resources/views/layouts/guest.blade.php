<!DOCTYPE html> 
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $header }} | {{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('images/UTAR_Logo.jpg') }}" type="image/jpeg">

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://unpkg.com/aos@next/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
</head>

<body class="font-sans antialiased bg-gray-100">
    <div>
        <!-- Navbar Section -->
        <nav class="bg-gray-900 text-white shadow-md sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                <!-- Logo and Name on the Left -->
                <div class="flex items-center space-x-4">
                    <a href="/">
                        <img src="{{ asset('images/UTAR_Logo.jpg') }}" class="w-16 h-8 rounded-full" alt="UTAR Logo">
                    </a>
                    <a href="/" class="text-xl sm:text-2xl font-bold text-blue-400 hover:text-blue-500 transition">
                        UTAR Facility Rental System
                    </a>
                </div>
                <!-- Desktop Menu (Centered Links) -->
                <div class="space-x-8 text-sm font-medium hidden md:flex justify-center flex-1">
                    <a href="{{ url('/about') }}" class="hover:text-blue-400 transition">About</a>
                    <a href="{{ url('/features') }}" class="hover:text-blue-400 transition">Features</a>
                    <a href="{{ url('/services') }}" class="hover:text-blue-400 transition">Services</a>
                    <a href="{{ url('/contact') }}" class="hover:text-blue-400 transition">Contact</a>
                    <a href="{{ url('/updates') }}" class="hover:text-blue-400 transition">Updates</a>
                </div>

                <!-- Desktop Menu (Right side for auth links) -->
                <div class="space-x-4 text-sm font-medium hidden md:flex">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="hover:text-blue-400 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="hover:text-blue-400 transition">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="hover:text-blue-400 transition">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-button" class="md:hidden text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden bg-gray-800 text-white">
                <div class="px-6 py-2">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="block py-2 text-gray-400 hover:text-blue-400 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="block py-2 text-gray-400 hover:text-blue-400 transition">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="block py-2 text-gray-400 hover:text-blue-400 transition">Register</a>
                            @endif
                        @endauth
                    @endif
                    <a href="{{ url('/about') }}" class="block py-2 text-gray-400 hover:text-blue-400 transition">About</a>
                    <a href="{{ url('/features') }}" class="block py-2 text-gray-400 hover:text-blue-400 transition">Features</a>
                    <a href="{{ url('/services') }}" class="block py-2 text-gray-400 hover:text-blue-400 transition">Services</a>
                    <a href="{{ url('/contact') }}" class="block py-2 text-gray-400 hover:text-blue-400 transition">Contact</a>
                    <a href="{{ url('/updates') }}" class="block py-2 text-gray-400 hover:text-blue-400 transition">Updates</a>
                </div>
            </div>
        </nav>

        @if (!Request::is('/'))
            <header class="bg-blue shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 font-semibold text-xl text-gray-800 leading-tight">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="py-3">
            {{ $slot }}
        </main>

        <!-- Footer Section -->
        <footer class="bg-gray-800 text-white py-8">
            <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <h3 class="text-xl font-semibold mb-2">UTAR Facility Rental</h3>
                    <p>Your go-to booking system for all campus needs. Book facilities easily and efficiently.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-2">Contact</h4>
                    <p>Email: support@utar.my</p>
                    <p>Phone: +60 17-3786800</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <div>
                        <h4 class="font-semibold mb-2">Quick Links</h4>
                        <ul>
                            <li><a href="{{ url('/') }}" class="hover:text-blue-400 transition">Home</a></li>
                            <li><a href="{{ url('/about') }}" class="hover:text-blue-400 transition">About</a></li>
                            <li><a href="{{ url('/features') }}" class="hover:text-blue-400 transition">Features</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-2">Services</h4>
                        <ul>
                            <li><a href="{{ url('/services') }}" class="hover:text-blue-400 transition">Services</a></li>
                            <li><a href="{{ url('/contact') }}" class="hover:text-blue-400 transition">Contact</a></li>
                            <li><a href="{{ url('/updates') }}" class="hover:text-blue-400 transition">Updates</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-2">Legal</h4>
                        <ul>
                            <li><a href="{{ url('/privacy-policy') }}" class="hover:text-blue-400 transition">Privacy Policy</a></li>
                            <li><a href="{{ url('/terms-of-service') }}" class="hover:text-blue-400 transition">Terms of Service</a></li>
                            <li><a href="{{ url('/faq') }}" class="hover:text-blue-400 transition">FAQ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="text-center py-4 text-sm">
                &copy; 2025 UTAR Facility Rental System. All rights reserved.
            </div>
        </footer>


        <!-- Back to Top Button -->
        <button onclick="window.scrollTo({ top: 0, behavior: 'smooth' })" class="fixed font-extrabold bottom-5 right-5 bg-blue-600 text-white py-3 px-5 rounded-full shadow-lg hover:bg-blue-700 transition">
            ↑
        </button>
    </div>

    <!-- AOS Initialization Script -->
    <script>
        AOS.init();
    </script>

    <!-- Mobile Menu Toggle Script -->
    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
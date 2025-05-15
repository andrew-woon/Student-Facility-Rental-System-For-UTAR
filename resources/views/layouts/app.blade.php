<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $header }} | {{ config('app.name') }}</title>
        <link rel="icon" href="{{ asset('images/UTAR_Logo.jpg') }}" type="image/jpeg">

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body class="font-sans antialiased">
        <div class="bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-blue shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 font-semibold text-xl text-gray-800 leading-tight">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main class="min-h-screen">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>

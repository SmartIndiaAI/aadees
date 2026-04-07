<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vendor Portal | Aadees Marketplace</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <!-- CSS Variables for Dynamic Theme -->
    <style>
        :root {
            --color-primary: {{ $themeColors['primary'] }};
            --color-secondary: {{ $themeColors['secondary'] }};
            --color-accent: {{ $themeColors['accent'] }};
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-white overflow-hidden">
    <div class="flex">
        <!-- Sidebar -->
        @include('partials.vendor.sidebar')

        <!-- Main Content -->
        <main class="flex-grow ml-64 h-screen overflow-y-auto no-scrollbar pt-10 pb-20 px-10">
            <header class="flex items-center justify-between mb-10">
                <div class="flex items-center space-x-3 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">
                    <span>Seller Central</span>
                    <span class="text-gray-200">/</span>
                    <span class="text-gray-900">@yield('page_title', 'Dashboard')</span>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="h-10 px-4 rounded-xl bg-green-50 text-green-600 flex items-center space-x-2 border border-green-100 shadow-sm">
                        <span class="h-2 w-2 rounded-full bg-green-600 animate-pulse"></span>
                        <span class="text-[10px] font-bold uppercase tracking-widest">Store Open</span>
                    </div>
                </div>
            </header>

            @yield('content')
        </main>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', 'Aadees Marketplace - Premium items from multiple vendors, delivered to your door.')">
    <meta name="keywords" content="@yield('meta_keywords', 'ecommerce, marketplace, multi-vendor, premium, Aadees')">
    <title>@yield('page_title', 'Home') | Aadees Marketplace</title>
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

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-white">
    <div id="app">
        <!-- Navigation -->
        @include('partials.customer.header')

        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        @include('partials.customer.footer')
    </div>

    <!-- Premium Notification System -->
    @if(session('status') || session('success') || session('error') || session('info') || session('warning'))
    <div id="notification-toast" class="fixed bottom-10 right-10 z-[100] transform translate-y-20 opacity-0 transition-all duration-700 pointer-events-none">
        <div class="bg-[#291030] text-white px-8 py-5 rounded-[24px] shadow-2xl border border-white/10 flex items-center space-x-4 backdrop-blur-xl">
            <div class="h-10 w-10 flex items-center justify-center rounded-xl {{ session('error') ? 'bg-rose-500/20 text-rose-500' : 'bg-accent/20 text-accent' }}">
                @if(session('error'))
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                @else
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                @endif
            </div>
            <div class="space-y-0.5">
                <p class="text-[9px] font-black uppercase tracking-[0.3em] opacity-40 leading-none">System Notification</p>
                <p class="text-[13px] font-black italic tracking-tighter">{{ session('status') ?? session('success') ?? session('error') ?? session('info') ?? session('warning') }}</p>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toast = document.getElementById('notification-toast');
            // Show toast
            setTimeout(() => {
                toast.classList.remove('translate-y-20', 'opacity-0');
                toast.classList.add('translate-y-0', 'opacity-100');
            }, 100);
            // Hide toast
            setTimeout(() => {
                toast.classList.add('translate-y-20', 'opacity-0');
                toast.classList.remove('translate-y-0', 'opacity-100');
            }, 4000);
        });
    </script>
    @endif

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>
</html>

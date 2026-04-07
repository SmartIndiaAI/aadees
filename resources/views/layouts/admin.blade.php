<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard | Aadees</title>
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
<body class="font-sans antialiased text-gray-900 bg-gray-50 overflow-hidden">
    <div class="flex">
        <!-- Sidebar -->
        @include('partials.admin.sidebar')

        <!-- Main Content -->
        <main class="flex-grow ml-72 h-screen overflow-y-auto no-scrollbar pt-12 pb-24 px-12">
            <header class="flex items-center justify-between mb-12">
                <div>
                    <p class="text-xs font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Marketplace Management Overview</p>
                    <h1 class="text-3xl font-black tracking-tight text-gray-900">@yield('page_title', 'Dashboard')</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="h-12 w-12 rounded-2xl bg-white border border-gray-100 flex items-center justify-center text-gray-400 hover:text-primary hover:border-primary/20 transition-all shadow-sm">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    </button>
                    <div class="h-12 w-12 rounded-2xl bg-primary flex items-center justify-center text-white font-black shadow-lg shadow-primary/20">A</div>
                </div>
            </header>

            @yield('content')
        </main>
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

    @stack('scripts')
</body>
</html>

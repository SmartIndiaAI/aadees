<header class="bg-white border-b border-gray-100 transition-all duration-500 py-4">
    <div class="max-w-7xl mx-auto px-4 lg:px-8 flex items-center justify-between gap-6 lg:gap-12 relative">
        <!-- Mobile Menu Button -->
        <button id="mobile-menu-open" class="md:hidden p-2 text-gray-400 hover:text-primary transition-colors focus:outline-none">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>

        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center space-x-4 group active:scale-95 transition-transform">
            <img src="{{ $siteLogo }}" class="h-10 w-auto rounded-lg shadow-xl shadow-primary/5 transition-all group-hover:scale-105 group-hover:shadow-2xl" alt="{{ $siteName }}">
        </a>

        <!-- Premium Nav -->
        <nav class="hidden md:flex items-center gap-8 text-[11px] font-black uppercase tracking-[0.3em] text-gray-400">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors hover:underline underline-offset-8 active:scale-95 {{ request()->routeIs('home') ? 'text-primary' : '' }}">Home</a>
            <a href="{{ route('products.index') }}" class="hover:text-primary transition-colors hover:underline underline-offset-8 active:scale-95 {{ request()->routeIs('products.index') ? 'text-primary' : '' }}">Shop</a>
            <div class="relative group">
                <button class="hover:text-primary transition-colors flex items-center uppercase py-4 {{ request()->routeIs('category.*') ? 'text-primary' : '' }}">
                    Categories
                    <svg class="ml-1 h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div class="absolute top-full left-0 bg-white border border-gray-100 shadow-2xl rounded-2xl py-6 w-56 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50">
                    @php $cats = \App\Models\Category::whereNull('parent_id')->get(); @endphp
                    @foreach($cats as $cat)
                        <a href="{{ route('category.show', $cat->slug) }}" class="block px-8 py-3 text-[10px] font-black uppercase tracking-widest text-gray-400 hover:bg-gray-50 hover:text-primary {{ request()->is('category/'.$cat->slug) ? 'text-primary bg-gray-50' : '' }} transition-colors">{{ $cat->name }}</a>
                    @endforeach
                </div>
            </div>
        </nav>

        <!-- Right Side Actions -->
        <div class="flex items-center gap-4">
            <!-- Search Bar (Simple) -->
            <div class="hidden lg:flex items-center relative group">
                <input type="text" placeholder="Search..." class="border border-gray-200 rounded-full px-4 py-2 pl-10 text-sm focus:ring-1 focus:ring-accent w-48 transition-all focus:w-72 outline-none hover:border-accent hover:shadow-sm">
                <svg class="absolute left-4 h-4 w-4 text-gray-400 group-hover:text-accent transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>

            <!-- Icons -->
            <a href="{{ route('wishlist.index') }}" class="cursor-pointer group relative">
                <span class="text-xl group-hover:scale-125 transition-transform inline-block">❤️</span>
                @php
                    $wishlistCount = Auth::check() ? Auth::user()->wishlist()->count() : 0;
                @endphp
                <span class="absolute -top-2 -right-2 bg-primary text-white text-[8px] font-black h-4 w-4 rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">{{ $wishlistCount }}</span>
            </a>
            <a href="{{ route('cart') }}" class="cursor-pointer group relative">
                <span class="text-xl group-hover:scale-125 transition-transform inline-block">🛒</span>
                <span class="absolute -top-2 -right-2 bg-secondary text-gray-900 text-[8px] font-black h-4 w-4 rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">{{ count(session('cart', [])) }}</span>
            </a>
            <div class="relative group">
                <button class="cursor-pointer hover:scale-110 transition-transform text-xl focus:outline-none py-2">👤</button>
                <div class="absolute right-0 top-full w-48 bg-white border border-gray-100 rounded-xl shadow-2xl py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-[60]">
                    @auth
                        <div class="px-4 py-2 border-b border-gray-50 mb-1">
                            <p class="text-[10px] font-black uppercase tracking-widest text-primary">{{ Auth::user()->name }}</p>
                            <p class="text-[9px] text-gray-400 capitalize">{{ Auth::user()->role ?? 'Customer' }}</p>
                        </div>
                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-[10px] font-black uppercase tracking-widest text-gray-600 hover:bg-gray-50 hover:text-primary transition-colors">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left block px-4 py-2 text-[10px] font-black uppercase tracking-widest text-red-500 hover:bg-gray-50 transition-colors">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block px-4 py-2 text-[10px] font-black uppercase tracking-widest text-gray-600 hover:bg-gray-50 hover:text-primary transition-colors">Login</a>
                        <a href="{{ route('register') }}" class="block px-4 py-2 text-[10px] font-black uppercase tracking-widest text-gray-600 hover:bg-gray-50 hover:text-primary transition-colors">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Drawer -->
    <div id="mobile-menu" class="fixed inset-0 z-[100] transition-all duration-500 opacity-0 invisible">
        <div id="mobile-menu-backdrop" class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm"></div>
        <div id="mobile-menu-content" class="absolute inset-y-0 left-0 w-80 bg-white shadow-2xl transition-transform duration-500 -translate-x-full flex flex-col">
            <div class="p-8 flex items-center justify-between border-b border-gray-50">
                <img src="{{ $siteLogo }}" class="h-8 w-auto rounded-lg" alt="{{ $siteName }}">
                <button id="mobile-menu-close" class="p-2 text-gray-400 hover:text-primary transition-colors">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            
            <div class="flex-1 overflow-y-auto py-8">
                <div class="px-8 space-y-2 mb-12">
                    <p class="text-[9px] font-black uppercase tracking-[0.3em] text-gray-400 mb-6">Discovery</p>
                    <a href="{{ route('home') }}" class="block text-xl font-black italic tracking-tighter text-gray-900 hover:text-primary transition-colors py-2 uppercase">Core Archive</a>
                    <a href="{{ route('products.index') }}" class="block text-xl font-black italic tracking-tighter text-gray-900 hover:text-primary transition-colors py-2 uppercase">Full Collections</a>
                </div>

                <div class="px-8 space-y-4">
                    <p class="text-[9px] font-black uppercase tracking-[0.3em] text-gray-400 mb-6">Classifications</p>
                    @foreach($cats as $cat)
                        <a href="{{ route('category.show', $cat->slug) }}" class="flex items-center justify-between group py-1">
                            <span class="text-[12px] font-black uppercase tracking-widest text-gray-500 group-hover:text-primary transition-colors">{{ $cat->name }}</span>
                            <svg class="h-4 w-4 text-gray-200 group-hover:text-primary transition-all translate-x-0 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="p-8 border-t border-gray-50 space-y-4">
                @auth
                    <div class="flex items-center gap-4 mb-6">
                        <div class="h-10 w-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-black">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-[11px] font-black uppercase tracking-widest leading-none">{{ Auth::user()->name }}</p>
                            <p class="text-[9px] text-gray-400 capitalize mt-1">{{ Auth::user()->role ?? 'Explorer' }}</p>
                        </div>
                    </div>
                @endauth
                <div class="grid grid-cols-2 gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="flex items-center justify-center h-12 bg-gray-50 rounded-xl text-[10px] font-black uppercase tracking-widest text-gray-600 hover:bg-primary/5 hover:text-primary transition-all">Portal</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full h-12 flex items-center justify-center bg-gray-50 rounded-xl text-[10px] font-black uppercase tracking-widest text-rose-500 hover:bg-rose-50 transition-all">Sign Off</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="flex items-center justify-center h-12 bg-primary text-white rounded-xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-primary/20">Sign In</a>
                        <a href="{{ route('register') }}" class="flex items-center justify-center h-12 bg-white border border-gray-100 rounded-xl text-[10px] font-black uppercase tracking-widest text-gray-600">Join</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const menu = document.getElementById('mobile-menu');
            const backdrop = document.getElementById('mobile-menu-backdrop');
            const content = document.getElementById('mobile-menu-content');
            const openBtn = document.getElementById('mobile-menu-open');
            const closeBtn = document.getElementById('mobile-menu-close');

            const toggleMenu = (show) => {
                if (show) {
                    menu.classList.remove('invisible');
                    menu.classList.add('opacity-100');
                    content.classList.remove('-translate-x-full');
                    document.body.style.overflow = 'hidden';
                } else {
                    menu.classList.remove('opacity-100');
                    content.classList.add('-translate-x-full');
                    document.body.style.overflow = '';
                    setTimeout(() => menu.classList.add('invisible'), 500);
                }
            };

            openBtn.addEventListener('click', () => toggleMenu(true));
            closeBtn.addEventListener('click', () => toggleMenu(false));
            backdrop.addEventListener('click', () => toggleMenu(false));
        });
    </script>

</header>

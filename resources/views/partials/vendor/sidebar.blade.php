<aside class="fixed left-0 top-0 h-screen w-64 bg-gray-900 shadow-2xl transition-all z-50">
    <div class="p-8">
        <div class="flex items-center space-x-3 mb-10">
            <div class="h-8 w-8 rounded-lg bg-primary flex items-center justify-center text-white font-black shadow-lg shadow-primary/20 italic">V</div>
            <span class="text-lg font-black tracking-tighter text-white uppercase">Aadees <span class="text-primary italic">Partner</span></span>
        </div>

        <nav class="space-y-1">
            <a href="{{ route('vendor.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('vendor.dashboard') ? 'bg-white/5 text-secondary border-l-4 border-secondary' : 'text-gray-500 hover:text-white hover:bg-white/5 border-l-4 border-transparent' }} transition-all font-bold">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span>Dashboard</span>
            </a>

            <div class="pt-6 pb-2 text-[10px] font-black uppercase tracking-[0.2em] text-gray-600 px-4">Sales & Inventory</div>
            <a href="{{ route('vendor.orders.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('vendor.orders.*') ? 'bg-white/5 text-secondary border-l-4 border-secondary' : 'text-gray-500 hover:text-white hover:bg-white/5 border-l-4 border-transparent' }} transition-all font-bold">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                <span>My Orders</span>
            </a>
            <a href="{{ route('vendor.products.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('vendor.products.*') ? 'bg-white/5 text-secondary border-l-4 border-secondary' : 'text-gray-500 hover:text-white hover:bg-white/5 border-l-4 border-transparent' }} transition-all font-bold">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                <span>My Products</span>
            </a>

            <div class="pt-6 pb-2 text-[10px] font-black uppercase tracking-[0.2em] text-gray-600 px-4">Finance</div>
            <a href="{{ route('vendor.earnings') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('vendor.earnings') ? 'bg-white/5 text-secondary border-l-4 border-secondary' : 'text-gray-500 hover:text-white hover:bg-white/5 border-l-4 border-transparent' }} transition-all font-bold">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>My Earnings</span>
            </a>

            <div class="pt-6 pb-2 text-[10px] font-black uppercase tracking-[0.2em] text-gray-600 px-4">Support</div>
            <a href="{{ route('vendor.guide') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('vendor.guide') ? 'bg-white/5 text-secondary border-l-4 border-secondary' : 'text-gray-500 hover:text-white hover:bg-white/5 border-l-4 border-transparent' }} transition-all font-bold">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Help Guide</span>
            </a>
            <a href="{{ route('vendor.settings') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('vendor.settings') ? 'bg-white/5 text-secondary border-l-4 border-secondary' : 'text-gray-500 hover:text-white hover:bg-white/5 border-l-4 border-transparent' }} transition-all font-bold">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37a1.724 1.724 0 002.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span>Profile Settings</span>
            </a>
        </nav>

        <div class="absolute bottom-8 left-6 right-6 p-4 rounded-3xl bg-secondary shadow-lg">
            <h5 class="text-xs font-black text-gray-900 mb-1">Super Pro Plus</h5>
            <p class="text-[10px] text-gray-600 mb-4 uppercase tracking-widest font-bold">Priority Seller Status</p>
            <form action="{{ route('vendor.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-gray-900 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest text-white hover:opacity-90 transition-opacity">Logout</button>
            </form>
        </div>
    </div>
</aside>

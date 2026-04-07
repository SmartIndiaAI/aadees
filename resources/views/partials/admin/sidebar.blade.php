<aside class="fixed left-0 top-0 h-screen w-72 bg-white border-r border-gray-100 transition-all z-50">
    <div class="p-8">
        <div class="flex items-center space-x-3 mb-12">
            <div class="h-10 w-10 rounded-xl bg-primary flex items-center justify-center text-white shadow-lg shadow-primary/20">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
            </div>
            <span class="text-xl font-black tracking-tight text-gray-900 uppercase">Aadees <span class="text-primary">Admin</span></span>
        </div>

        <nav class="space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-2xl {{ request()->routeIs('admin.dashboard') ? 'bg-primary/5 text-primary' : 'text-gray-400 hover:text-gray-900 hover:bg-gray-50' }} font-bold transition-all">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span>Dashboard</span>
            </a>

            <div class="pt-6 pb-2 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 px-4">Marketplace Management</div>
            <a href="{{ route('admin.vendors.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-2xl {{ request()->routeIs('admin.vendors.*') ? 'bg-primary/5 text-primary' : 'text-gray-400 hover:text-gray-900 hover:bg-gray-50' }} transition-all font-bold">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-7h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                <span>Vendors</span>
            </a>
            <a href="{{ route('admin.products') }}" class="flex items-center space-x-3 px-4 py-3 rounded-2xl {{ request()->routeIs('admin.products') ? 'bg-primary/5 text-primary' : 'text-gray-400 hover:text-gray-900 hover:bg-gray-50' }} transition-all font-bold">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                <span>All Products</span>
            </a>

            <div class="pt-6 pb-2 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 px-4">Financial Monitor</div>
            <a href="{{ route('admin.transfers') }}" class="flex items-center space-x-3 px-4 py-3 rounded-2xl {{ request()->routeIs('admin.transfers') ? 'bg-primary/5 text-primary' : 'text-gray-400 hover:text-gray-900 hover:bg-gray-50' }} transition-all font-bold">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                <span>Settlement Logs</span>
            </a>
            <a href="{{ route('admin.settings') }}" class="flex items-center space-x-3 px-4 py-3 rounded-2xl {{ request()->routeIs('admin.settings') ? 'bg-primary/5 text-primary' : 'text-gray-400 hover:text-gray-900 hover:bg-gray-50' }} transition-all font-bold">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span>Settings</span>
            </a>
        </nav>

        <div class="absolute bottom-8 left-8 right-8">
            <div class="bg-gray-900 rounded-3xl p-6 text-white overflow-hidden relative group">
                <div class="absolute inset-0 bg-primary opacity-0 group-hover:opacity-10 transition-opacity"></div>
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 mb-2">Logged in as</p>
                <h5 class="text-sm font-bold truncate">Super Admin</h5>
                <p class="text-[10px] text-gray-400 mb-4">admin@Aadees.com</p>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-white/10 py-3 rounded-2xl text-xs font-bold backdrop-blur-md hover:bg-white/20 transition-all">Sign Out</button>
                </form>
            </div>
        </div>
    </div>
</aside>

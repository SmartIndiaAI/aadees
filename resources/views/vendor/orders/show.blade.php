@extends('layouts.vendor')

@section('page_title', 'Acquisition Intelligence')

@section('content')
<div class="space-y-12 pb-24">
    <!-- Back Navigation -->
    <a href="{{ route('vendor.orders.index') }}" class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400 hover:text-primary transition-colors flex items-center group">
        <svg class="h-3 w-3 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
        Return to Portfolio
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Main Details -->
        <div class="lg:col-span-2 space-y-10">
            <!-- Order Identity -->
            <div class="bg-gray-50 rounded-[48px] p-12 text-gray-900 border border-gray-100 shadow-sm relative overflow-hidden group">
                <div class="absolute -top-12 -right-12 h-32 w-32 bg-primary rounded-full blur-3xl opacity-5 transition-transform duration-700 group-hover:scale-150"></div>
                
                <div class="flex items-center justify-between mb-10">
                    <span class="text-[10px] font-black uppercase tracking-[0.5em] text-gray-400">Masterpiece Identity</span>
                    <span class="px-4 py-1.5 rounded-full bg-white border border-gray-100 text-[9px] font-black uppercase tracking-widest text-primary shadow-sm">Verified Acquisition</span>
                </div>

                <div class="flex items-start justify-between gap-10">
                    <div class="flex items-center space-x-8">
                        <div class="h-24 w-24 rounded-[32px] overflow-hidden border-2 border-white shadow-2xl">
                            <img src="{{ $item->product->image ?? asset('placeholder.png') }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h1 class="text-4xl font-black uppercase tracking-tighter italic text-primary mb-2">{{ $item->product->name }}</h1>
                            <p class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">Order #{{ $item->order->order_number }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] font-black uppercase tracking-widest text-gray-300 mb-2">Yield Value</p>
                        <p class="text-3xl font-black italic text-gray-900">₹{{ number_format($item->vendor_share, 2) }}</p>
                    </div>
                </div>
            </div>

            <!-- Customer & Delivery -->
            <div class="bg-white rounded-[40px] p-12 border border-gray-100 shadow-sm space-y-12">
                <div>
                    <h3 class="text-xs font-black uppercase tracking-[0.4em] text-gray-400 border-b border-gray-50 pb-6 mb-10 italic">Patron Details</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        <div class="space-y-2">
                            <p class="text-[10px] font-black uppercase tracking-widest text-gray-300">Patron Name</p>
                            <p class="text-sm font-black text-gray-900 italic uppercase">{{ $item->order->shipping_name }}</p>
                        </div>
                        <div class="space-y-2">
                            <p class="text-[10px] font-black uppercase tracking-widest text-gray-300">Patron Connectivity</p>
                            <p class="text-sm font-black text-gray-900 uppercase italic">{{ $item->order->shipping_phone }} / {{ $item->order->user->email ?? $item->order->email }}</p>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-xs font-black uppercase tracking-[0.4em] text-gray-400 border-b border-gray-50 pb-6 mb-10 italic">Delivery Infrastructure</h3>
                    <div class="space-y-6">
                        <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100 shadow-inner">
                            <p class="text-sm font-black text-gray-900 leading-relaxed uppercase tracking-tighter italic">
                                {{ $item->order->shipping_address }},<br>
                                {{ $item->order->shipping_city }}, {{ $item->order->shipping_state }} - {{ $item->order->shipping_zip }}
                            </p>
                        </div>
                        <div class="flex items-center space-x-2 text-[10px] font-black uppercase tracking-widest text-gray-400 italic">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>Verified Global Shipping Nodes</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Actions -->
        <div class="space-y-10">
            <!-- Status Control -->
            <div class="bg-white rounded-[40px] p-10 border border-gray-100 shadow-sm">
                <h3 class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400 mb-8 italic">Transition Logic</h3>
                
                <form action="{{ route('vendor.orders.status', $item->id) }}" method="POST" class="space-y-8">
                    @csrf
                    <div class="space-y-4">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-300 ml-4">Current Pipeline Phase</label>
                        <select name="status" class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-xs font-black uppercase tracking-widest outline-none focus:ring-2 focus:ring-primary shadow-inner text-gray-900">
                            @foreach(['pending', 'processing', 'shipped', 'delivered', 'cancelled'] as $status)
                                <option value="{{ $status }}" {{ $item->status === $status ? 'selected' : '' }}>{{ strtoupper($status) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="p-6 rounded-3xl bg-gray-50 border border-gray-100">
                        <p class="text-[9px] text-gray-400 leading-relaxed italic font-bold uppercase tracking-widest">Updating this phase will immediately alert the patron's digital dashboard.</p>
                    </div>

                    <button type="submit" class="w-full bg-primary text-white rounded-3xl py-5 text-[10px] font-black uppercase tracking-widest hover:bg-primary/90 transition-all shadow-lg shadow-primary/20 italic">Authorize Transition</button>
                </form>
            </div>

            <!-- Artisan Note -->
            <div class="bg-gray-50 rounded-[40px] p-10 text-gray-900 border border-gray-100 shadow-sm relative overflow-hidden">
                <h3 class="text-[10px] font-black uppercase tracking-[0.4em] mb-6 text-gray-400">Artisan Integrity</h3>
                <p class="text-xs italic leading-relaxed text-gray-500 font-bold uppercase tracking-widest">Handle your masterpiece with premium care. Once authorized as 'Shipped', the digital ledger will lock the transaction for final settlement.</p>
            </div>
        </div>
    </div>
</div>
@endsection

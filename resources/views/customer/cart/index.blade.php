@extends('layouts.app')

@section('page_title', 'Basket Refinement')

@section('content')
<div class="bg-white min-h-[60vh] pb-24">
    <!-- Sophisticated Header -->
    <div class="container mx-auto px-4 lg:px-8 py-12 text-center space-y-3">
        <h1 class="text-3xl font-black tracking-tighter text-gray-900 uppercase leading-none italic">Your <span class="text-primary border-b-4 border-primary/10">Basket</span></h1>
        <p class="text-[9px] font-black uppercase tracking-[0.4em] text-gray-400">Review selected masterpieces before final acquisition.</p>
    </div>

    <div class="container mx-auto px-4 lg:px-8 lg:grid lg:grid-cols-12 lg:gap-12">
        <!-- Expanded Cart Items -->
        <div class="lg:col-span-8 lg:pr-10 space-y-6">
            @forelse($cart as $id => $item)
                <div class="flex items-center gap-16 p-8 rounded-[40px] bg-gray-50/50 border border-gray-100 hover:bg-white hover:shadow-2xl transition-all group">
                    <!-- Scaled Media -->
                    <a href="{{ route('product.show', $item['slug'] ?? $item['id']) }}" class="h-24 w-24 rounded-3xl overflow-hidden shrink-0 border-4 border-white shadow-xl block hover:scale-110 transition-transform duration-700">
                        <img src="{{ $item['image'] ?? asset('placeholder.png') }}" class="w-full h-full object-cover" alt="{{ $item['name'] }}">
                    </a>
                    
                    <!-- Refined Spread Details -->
                    <div class="flex-grow flex items-center justify-between gap-12">
                        <div class="space-y-3">
                            <a href="{{ route('product.show', $item['slug'] ?? $item['id']) }}" class="block group/title">
                                <h3 class="text-xl font-black text-gray-900 uppercase tracking-tighter italic leading-none group-hover/title:text-accent transition-colors">{{ $item['name'] }}</h3>
                            </a>
                            <div class="flex flex-wrap gap-3 items-center">
                                <span class="text-[8px] font-black uppercase tracking-[0.3em] text-[#291030] bg-[#291030]/5 px-3 py-1 rounded-lg">{{ $item['category_name'] ?? 'Premium' }}</span>
                                @if(isset($item['attributes']) && !empty($item['attributes']))
                                    @foreach($item['attributes'] as $key => $value)
                                        <span class="text-[8px] font-bold uppercase tracking-widest text-accent bg-accent/5 px-3 py-1 rounded-lg border border-accent/10">{{ $key }}: {{ $value }}</span>
                                    @endforeach
                                @endif
                            </div>
                            <p class="text-[10px] font-black text-gray-300 uppercase tracking-wide">Archived by <span class="text-primary italic">{{ $item['vendor_name'] ?? 'Artisan Partner' }}</span></p>
                        </div>
                        
                        <div class="flex items-center gap-20 shrink-0">
                            <!-- Qty Control -->
                            <div class="flex items-center bg-white rounded-2xl px-5 py-2 border border-gray-100 shadow-inner">
                                <span class="text-[11px] font-black text-[#291030] uppercase tracking-widest">Qty: {{ $item['quantity'] }}</span>
                            </div>
                            
                            <!-- Internal Valuation -->
                            <div class="text-right min-w-[140px]">
                                <span class="block text-2xl font-black text-[#291030] tracking-tighter italic leading-none">₹{{ number_format($item['price'] * $item['quantity'], 0) }}</span>
                                <form action="{{ route('cart.remove', $id) }}" method="POST" class="mt-2">
                                    @csrf
                                    <button type="submit" class="text-[9px] font-black uppercase tracking-[0.3em] text-rose-400 hover:text-rose-600 transition-all hover:underline">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="py-32 text-center rounded-[48px] bg-gray-50/50 border-2 border-dashed border-gray-100">
                    <p class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-300 italic">No masterpieces selected for acquisition.</p>
                    <div class="mt-8">
                        <a href="{{ route('products.index') }}" class="inline-block bg-primary text-white px-10 py-4 rounded-2xl text-[9px] font-black uppercase tracking-widest shadow-lg hover:scale-105 transition-transform">Explore Collections</a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Refined Order Summary -->
        @if(count($cart) > 0)
        <aside class="lg:col-span-4 mt-12 lg:mt-0 space-y-8">
            <div class="p-8 rounded-[40px] bg-[#291030] text-white space-y-10 shadow-premium relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-accent rounded-full blur-3xl opacity-10"></div>
                
                <h4 class="text-lg font-black uppercase tracking-[0.2em] italic border-b border-white/10 pb-5">Acquisition Summary</h4>
                
                <div class="space-y-5">
                    <div class="flex items-center justify-between text-[10px] font-black uppercase tracking-widest opacity-60">
                        <span>Consolidated Total</span>
                        <span class="text-base font-black tracking-tighter italic">₹{{ number_format($total, 0) }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-[9px] font-bold uppercase tracking-widest opacity-40">Shipment</span>
                        <span class="text-[8px] font-black uppercase tracking-widest border border-white/20 px-3 py-1 rounded-lg">Calculated Next</span>
                    </div>
                    <div class="flex items-center justify-between pt-6 border-t border-white/10">
                        <span class="text-xl font-black uppercase tracking-tighter italic">Aggregated Est.</span>
                        <span class="text-2xl font-black tracking-tighter italic text-secondary">₹{{ number_format($total, 0) }}</span>
                    </div>
                </div>
                
                <div class="flex justify-center">
                    <a href="{{ route('checkout') }}" class="block w-full sm:w-auto px-10 h-14 bg-secondary text-[#291030] rounded-2xl flex items-center justify-center text-[10px] font-black uppercase tracking-[0.3em] shadow-xl hover:shadow-2xl hover:scale-[1.02] transition-all group italic">
                        Proceed to Checkout
                        <svg class="ml-2 h-3 w-3 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>


        </aside>
        @endif
    </div>
</div>
@endsection

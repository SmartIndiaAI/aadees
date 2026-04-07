@extends('layouts.app')

@section('page_title', 'My Wishlist')

@section('content')
<div class="bg-white min-h-[70vh] pb-48">
    <!-- Header Section -->
    <div class="container mx-auto px-4 pt-16 pb-8 text-center space-y-4">
        <h1 class="text-5xl font-black tracking-tighter text-gray-900 mb-4 uppercase">My <span class="text-primary italic">Favorites</span></h1>
        <p class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400 max-w-sm mx-auto leading-relaxed">Artisan pieces you have discovered and saved. Curated for your collection.</p>
    </div>

    <!-- Items Grid -->
    <div class="container mx-auto px-4 lg:px-8">
        @if($wishlistItems->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-16 mt-12">
                @foreach($wishlistItems as $item)
                    @include('partials.customer.product-card', ['product' => $item->product, 'showMoveToCart' => true])
                @endforeach
            </div>
        @else
            <div class="py-32 text-center max-w-md mx-auto rounded-[60px] bg-gray-50 border-2 border-dashed border-gray-100">
                <div class="inline-flex items-center justify-center h-24 w-24 rounded-3xl bg-white text-gray-200 mb-8 transform -rotate-12 hover:rotate-0 transition-transform duration-500 shadow-sm">
                    <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </div>
                <h3 class="text-xl font-black text-gray-900 uppercase tracking-tight">Your wishlist is empty</h3>
                <p class="text-[10px] font-bold text-gray-400 mt-4 uppercase tracking-[0.2em] leading-loose">Explore our collections and save artisan pieces for later.</p>
                <div class="mt-12">
                    <a href="{{ route('products.index') }}" class="btn-premium bg-primary text-white">Browse Collections</a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

<div class="bg-white rounded-3xl p-6 shadow-premium hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group flex flex-col h-full border border-gray-100 hover:border-accent">
    <!-- Image Wrapper -->
    <div class="overflow-hidden rounded-2xl relative aspect-square bg-gray-50 border border-gray-50 group-hover:border-accent/10 transition-colors">
        <a href="{{ route('product.show', $product->slug) }}" class="block w-full h-full">
            <img src="{{ $product->image_url ?? asset('placeholder.png') }}" 
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000" alt="{{ $product->name }}">
        </a>
        <!-- Quick Wishlist (Optional Overlay) -->
        @php
            $isInWishlist = Auth::check() && Auth::user()->wishlist()->where('product_id', $product->id)->exists();
        @endphp
        <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST" class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-50">
            @csrf
            <button type="submit" class="p-3 bg-white/90 backdrop-blur-md rounded-xl shadow-xl hover:scale-110 active:scale-95 transition-all {{ $isInWishlist ? 'text-rose-500' : 'text-gray-400 hover:text-rose-500' }}">
                <svg class="h-4 w-4" fill="{{ $isInWishlist ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
            </button>
        </form>
    </div>

    <!-- Product Info -->
    <div class="mt-8 flex flex-col flex-grow space-y-4">
        <div class="space-y-1">
            <span class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-300 italic">{{ $product->category->name }}</span>
            <a href="{{ route('product.show', $product->slug) }}" class="block">
                <h4 class="font-black text-primary text-[15px] uppercase tracking-tighter line-clamp-1 group-hover:text-accent transition-colors duration-300 leading-none py-1">{{ $product->name }}</h4>
            </a>
        </div>
        
        <div class="flex items-center justify-between mt-auto py-5 border-y border-gray-50/50">
            <div class="space-y-0.5">
                <span class="text-[8px] font-bold text-gray-400 uppercase tracking-widest block">Valuation</span>
                <p class="text-primary font-black text-xl tracking-tighter italic leading-none">₹{{ number_format($product->discount_price ?? $product->price, 0) }}</p>
            </div>
            @if($product->discount_price)
                <p class="text-gray-300 text-[11px] line-through font-bold tracking-tighter">₹{{ number_format($product->price, 0) }}</p>
            @endif
        </div>

        @if(isset($showMoveToCart) && $showMoveToCart)
            <div class="pt-6">
                <form action="{{ route('wishlist.move_to_cart', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full h-12 bg-primary text-white text-[9px] font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-accent transition-all shadow-xl hover:shadow-accent/20 active:scale-95 flex items-center justify-center gap-2">
                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        Move to Basket
                    </button>
                </form>
            </div>
        @endif
    </div>
</div>

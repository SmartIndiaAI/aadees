@extends('layouts.app')

@section('content')
<div class="bg-white min-h-screen">
    <!-- Sophisticated Breadcrumbs -->
    <div class="bg-gray-50/30 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 lg:px-8 py-4 flex items-center space-x-3 text-[9px] uppercase tracking-[0.2em] font-bold text-gray-400">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Archive</a>
            <span class="text-gray-200">/</span>
            <a href="{{ route('products.index') }}" class="hover:text-primary transition-colors">Collections</a>
            <span class="text-gray-200">/</span>
            <span class="text-primary italic">{{ $product->name }}</span>
        </div>
    </div>

    <!-- Main Showcase -->
    <div class="max-w-7xl mx-auto px-4 lg:px-8 py-12">
        <div class="flex flex-col lg:flex-row gap-16">
            
            <!-- Architectural Media Gallery -->
            <div class="w-full lg:w-1/2 space-y-6">
                <div class="relative group bg-gray-50/50 rounded-[40px] overflow-hidden border border-gray-100 shadow-sm transition-all hover:shadow-xl">
                    <img id="main-product-image" src="{{ $product->image_url }}" 
                         class="w-full h-full object-cover min-h-[450px] transition-transform duration-700 group-hover:scale-105" 
                         alt="{{ $product->name }}">
                    
                    @if($product->discount_price)
                        <div class="absolute top-6 right-6 bg-primary text-white px-6 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest shadow-xl">Special Selection</div>
                    @endif
                </div>

                <!-- Gallery Grid -->
                @if($product->gallery && count($product->gallery) > 0)
                <div class="grid grid-cols-6 gap-4">
                    <button onclick="updateMainImage('{{ $product->image_url }}')" 
                            class="aspect-square rounded-2xl overflow-hidden border-2 border-primary shadow-sm hover:scale-105 transition-all">
                        <img src="{{ $product->image_url }}" class="w-full h-full object-cover">
                    </button>
                    @foreach($product->gallery as $image)
                    <button onclick="updateMainImage('{{ asset($image) }}')" 
                            class="aspect-square rounded-2xl overflow-hidden border border-gray-100 hover:border-accent hover:scale-105 transition-all">
                        <img src="{{ asset($image) }}" class="w-full h-full object-cover">
                    </button>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Curated Information Panel -->
            <aside class="w-full lg:w-1/2 space-y-12">
                <div class="space-y-6">
                    <div class="flex items-center space-x-4">
                        <span class="text-[9px] font-black uppercase tracking-[0.4em] text-accent border border-accent/20 px-4 py-1.5 rounded-full">{{ $product->category->name }}</span>
                        <span class="text-[9px] font-bold text-gray-300 uppercase tracking-widest">ID: {{ $product->sku }}</span>
                    </div>

                    <div class="space-y-3">
                        <h1 class="text-3xl font-black tracking-tight text-gray-900 uppercase leading-snug italic animate-fade-in">{{ $product->name }}</h1>
                        <p class="text-[10px] font-bold uppercase tracking-[0.3em] text-gray-400">
                            By <span class="text-primary italic border-b border-primary/10 hover:border-primary transition-all cursor-pointer">{{ $product->vendor->name }}</span>
                        </p>
                    </div>

                    <!-- Valuation Block -->
                    <div class="flex items-center space-x-8 p-8 bg-gray-50/50 rounded-3xl border border-gray-100 shadow-inner">
                        <div class="space-y-1">
                            <span class="text-[8px] font-black text-gray-400 uppercase tracking-[0.3em] block">Market Valuation</span>
                            <span class="text-3xl font-black text-primary tracking-tighter italic">₹{{ number_format($product->discount_price ?? $product->price, 0) }}</span>
                        </div>
                        @if($product->discount_price)
                        <div class="pt-4 border-l border-gray-100 pl-8">
                            <span class="text-gray-300 line-through font-bold text-sm tracking-tighter">₹{{ number_format($product->price, 0) }}</span>
                            <div class="text-[8px] font-bold text-accent uppercase tracking-widest mt-0.5">Exclusive Release</div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Options Form -->
                <form id="add-to-cart-form" action="{{ route('cart.add', $product->id) }}" method="POST" class="space-y-10">
                    @csrf
                    <input type="hidden" name="buy_now" id="buy_now_input" value="0">
                    
                    @php 
                        $colors = $product->attributeValues->where('attribute.name', 'Color');
                        $sizes = $product->attributeValues->where('attribute.name', 'Size');
                    @endphp

                    @if($colors->count() > 0)
                    <div class="space-y-6">
                        <h4 class="text-[9px] font-black uppercase tracking-[0.3em] text-gray-400 border-b border-gray-100 pb-3 italic">Finish Selection</h4>
                        <div class="flex flex-wrap gap-4">
                            @foreach($colors as $val)
                            <label class="group cursor-pointer relative">
                                <input type="radio" name="attribute[Color]" value="{{ $val->value }}" class="hidden peer attribute-input" data-name="Color" required>
                                <div class="px-8 py-5 bg-white border-2 border-gray-100 rounded-3xl text-[11px] font-black uppercase tracking-widest peer-checked:bg-[#291030] peer-checked:text-white peer-checked:border-[#ffbf00] peer-checked:border-[4px] peer-checked:shadow-[0_20px_50px_rgba(41,16,48,0.2)] transition-all hover:border-accent hover:scale-105 active:scale-95 shadow-sm flex items-center gap-3">
                                    <div class="h-2.5 w-2.5 rounded-full bg-accent opacity-0 peer-checked:opacity-100 peer-checked:scale-110 transition-all"></div>
                                    {{ $val->value }}
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if($sizes->count() > 0)
                    <div class="space-y-6">
                        <h4 class="text-[9px] font-black uppercase tracking-[0.3em] text-gray-400 border-b border-gray-100 pb-3 italic">Size Profile</h4>
                        <div class="flex flex-wrap gap-4">
                            @foreach($sizes as $val)
                            <label class="group cursor-pointer relative">
                                <input type="radio" name="attribute[Size]" value="{{ $val->value }}" class="hidden peer attribute-input" data-name="Size" required>
                                <div class="w-16 h-16 flex items-center justify-center bg-white border-2 border-gray-100 rounded-3xl text-[12px] font-black peer-checked:bg-[#291030] peer-checked:text-white peer-checked:border-accent peer-checked:border-[4px] peer-checked:shadow-[0_20px_50px_rgba(255,191,0,0.3)] transition-all hover:border-primary hover:scale-110 active:scale-95 shadow-sm relative overflow-hidden">
                                    <div class="absolute top-0 right-0 w-5 h-5 bg-white/20 -rotate-45 translate-x-4 -translate-y-4 peer-checked:translate-x-1 peer-checked:-translate-y-1 transition-transform"></div>
                                    {{ $val->value }}
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Quantity -->
                    <div class="flex items-center space-x-6">
                        <span class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400 italic">Quantity</span>
                        <div class="flex items-center h-14 bg-gray-50/50 rounded-2xl px-6 border border-gray-100 shadow-inner">
                            <button type="button" onclick="adjustQty(-1)" class="text-gray-400 hover:text-primary hover:scale-125 transition-all font-bold px-3 text-xl">-</button>
                            <input id="quantity" name="quantity" value="1" readonly class="w-12 text-center bg-transparent border-none text-[13px] font-black focus:ring-0 text-primary">
                            <button type="button" onclick="adjustQty(1)" class="text-gray-400 hover:text-primary hover:scale-125 transition-all font-bold px-3 text-xl">+</button>
                        </div>
                    </div>

                </form>
                
                <div class="flex flex-col sm:flex-row gap-5 pt-6 items-center">
                    <button type="button" onclick="validateAndSubmit(0)" class="flex-grow h-16 bg-white border-2 border-primary text-primary rounded-3xl text-[11px] font-black uppercase tracking-[0.3em] hover:bg-gray-50 hover:shadow-2xl hover:scale-[1.02] active:scale-95 transition-all duration-300">Add to Cart</button>
                    <button type="button" onclick="validateAndSubmit(1)" class="flex-grow h-16 bg-primary text-white rounded-3xl text-[11px] font-black uppercase tracking-[0.3em] hover:bg-accent hover:shadow-[0_20px_50px_rgba(255,191,0,0.3)] hover:scale-[1.05] active:scale-95 transition-all duration-300 shadow-xl shadow-primary/10">Buy Now</button>
                    
                    @php
                        $isInWishlist = Auth::check() && Auth::user()->wishlist()->where('product_id', $product->id)->exists();
                    @endphp
                    <form id="wishlist-form" action="{{ route('wishlist.toggle', $product->id) }}" method="POST" class="inline-block">
                        @csrf
                        <button type="button" onclick="validateWishlist({{ $isInWishlist ? 'true' : 'false' }})" class="h-16 w-16 flex items-center justify-center bg-gray-50 rounded-3xl border border-gray-100 hover:border-accent hover:scale-110 active:scale-95 transition-all {{ $isInWishlist ? 'text-rose-500' : 'text-gray-300 hover:text-rose-500' }} shadow-sm">
                            <svg class="h-6 w-6" fill="{{ $isInWishlist ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        </button>
                    </form>
                </div>

                <!-- Validation Message -->
                <p id="validation-msg" class="text-[11px] text-rose-500 font-black uppercase tracking-[0.2em] hidden italic text-center animate-bounce mt-4">Selection Mandatory for Processing.</p>


                <!-- Information Grid -->
                <div class="pt-10 border-t border-gray-100 grid grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <h4 class="text-[9px] font-black uppercase tracking-[0.3em] text-primary italic">Provenance</h4>
                        <p class="text-[11px] font-bold text-gray-700 leading-relaxed uppercase tracking-tighter italic">{{ $product->description }}</p>
                    </div>
                    <div class="space-y-4">
                        <h4 class="text-[9px] font-black uppercase tracking-[0.3em] text-primary italic">Specifications</h4>
                        <ul class="text-[9px] font-black text-gray-700 uppercase tracking-widest space-y-2 italic">
                            <li>• Genuine Artifact</li>
                            <li>• Artisan Verified</li>
                            <li>• Insured Delivery</li>
                        </ul>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>

<script>
    function updateMainImage(src) {
        const main = document.getElementById('main-product-image');
        main.style.opacity = '0';
        setTimeout(() => {
            main.src = src;
            main.style.opacity = '1';
        }, 200);
    }
    
    function adjustQty(amount) {
        let input = document.getElementById('quantity');
        let val = parseInt(input.value) + amount;
        if (val > 0) input.value = val;
    }

    function validateAndSubmit(buyNow) {
        const form = document.getElementById('add-to-cart-form');
        const validationMsg = document.getElementById('validation-msg');
        const attributes = form.querySelectorAll('.attribute-input');
        
        let groups = {};
        attributes.forEach(input => {
            let name = input.getAttribute('data-name');
            if (!groups[name]) groups[name] = false;
            if (input.checked) groups[name] = true;
        });

        let isValid = true;
        for (let name in groups) {
            if (!groups[name]) {
                isValid = false;
                break;
            }
        }

        if (!isValid && Object.keys(groups).length > 0) {
            validationMsg.innerText = "Selection Mandatory for Processing.";
            validationMsg.classList.remove('hidden');
            validationMsg.classList.add('animate-shake');
            setTimeout(() => validationMsg.classList.remove('animate-shake'), 500);
            return;
        }

        validationMsg.classList.add('hidden');
        document.getElementById('buy_now_input').value = buyNow;
        form.submit();
    }

    function validateWishlist(isInWishlist) {
        if (isInWishlist) {
            document.getElementById('wishlist-form').submit();
            return;
        }

        const cartForm = document.getElementById('add-to-cart-form');
        const validationMsg = document.getElementById('validation-msg');
        const attributes = cartForm.querySelectorAll('.attribute-input');
        
        let groups = {};
        attributes.forEach(input => {
            let name = input.getAttribute('data-name');
            if (!groups[name]) groups[name] = false;
            if (input.checked) groups[name] = true;
        });

        let isValid = true;
        for (let name in groups) {
            if (!groups[name]) {
                isValid = false;
                break;
            }
        }

        if (!isValid && Object.keys(groups).length > 0) {
            validationMsg.innerText = "Select attribute to add to wishlist.";
            validationMsg.classList.remove('hidden');
            validationMsg.classList.add('animate-shake');
            setTimeout(() => validationMsg.classList.remove('animate-shake'), 500);
            return;
        }

        validationMsg.classList.add('hidden');
        document.getElementById('wishlist-form').submit();
    }
</script>

<style>
    @keyframes fade-in {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    .animate-fade-in { animation: fade-in 1s ease-out; }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }
    .animate-shake { animation: shake 0.2s ease-in-out infinite; }
    
    #main-product-image { transition: opacity 0.2s ease-in-out; }
</style>
@endsection

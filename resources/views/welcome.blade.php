@extends('layouts.app')

@section('page_title', 'AADEES - Premium Store')

@section('content')
<div class="bg-white">
    <!-- HERO SLIDER (Swiper) -->
    <section class="relative bg-gradient-to-r from-white via-purple-50 to-white overflow-hidden border-b border-gray-50">
        <div class="swiper heroSwiper">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide py-12 lg:py-16">
                    <div class="max-w-7xl mx-auto px-4 lg:px-8 grid md:grid-cols-2 gap-12 items-center">
                        <div class="space-y-6">
                            <h2 class="text-4xl lg:text-5xl font-black text-primary leading-tight uppercase tracking-tighter italic">
                                Experience <span class="text-gold">Luxury</span> <br>Redefined
                            </h2>
                            <p class="text-sm lg:text-base text-gray-500 max-w-lg leading-relaxed font-medium uppercase tracking-tight">
                                Curated collections from master artisans. Selected for the global collector.
                            </p>
                            <div class="flex gap-4 pt-2">
                                <a href="{{ route('products.index') }}" class="btn-gold px-8 py-3 text-[10px]">Shop Archive</a>
                                <a href="#featured" class="btn-outline px-8 py-3 text-[10px]">Browse More</a>
                            </div>
                        </div>
                        <div class="relative group">
                            <div class="absolute -inset-4 bg-primary/5 rounded-[30px] blur-2xl opacity-0 group-hover:opacity-100 transition-all"></div>
                            <img src="https://images.unsplash.com/photo-1606813907291-d86efa9b94db?auto=format&fit=crop&q=80&w=1000" 
                                 class="relative rounded-[30px] shadow-xl w-full object-cover aspect-[4/3] group-hover:scale-[1.02] transition-transform duration-700" alt="Premium Collection">
                        </div>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="swiper-slide py-12 lg:py-16">
                    <div class="max-w-7xl mx-auto px-4 lg:px-8 grid md:grid-cols-2 gap-12 items-center">
                        <div class="space-y-6">
                            <h2 class="text-4xl lg:text-5xl font-black text-primary leading-tight uppercase tracking-tighter italic">
                                Artisanal <br><span class="text-accent underline underline-offset-[10px]">Elegance</span>
                            </h2>
                            <p class="text-sm lg:text-base text-gray-500 max-w-lg leading-relaxed font-medium uppercase tracking-tight">
                                Connecting you with the world's most talented creators. Quality assured globally.
                            </p>
                            <div class="flex gap-4 pt-2">
                                <a href="{{ route('products.index') }}" class="btn-gold px-8 py-3 text-[10px]">Discover More</a>
                            </div>
                        </div>
                        <div class="relative group">
                            <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&q=80&w=1000" 
                                 class="relative rounded-[30px] shadow-xl w-full object-cover aspect-[4/3]" alt="Artisan Work">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pagination/Navigation -->
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <!-- CATEGORIES GRID -->
    <section class="py-20 border-b border-gray-50">
        <div class="max-w-7xl mx-auto px-4 lg:px-8">
            <div class="flex justify-between items-end mb-12">
                <div class="space-y-2">
                    <span class="text-[10px] font-black uppercase tracking-[0.4em] text-accent">Discovery</span>
                    <h3 class="text-3xl font-black text-primary uppercase tracking-tight">Shop by Category</h3>
                </div>
                <div class="h-[2px] flex-grow mx-8 bg-gray-50 hidden lg:block"></div>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($categories as $category)
                    <a href="{{ route('category.show', $category->slug) }}" 
                       class="group relative h-64 overflow-hidden rounded-2xl border border-gray-100 hover:border-accent hover:shadow-2xl transition-all">
                        <img src="{{ $category->image_url }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="{{ $category->name }}">
                        <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors"></div>
                        <div class="absolute inset-x-0 bottom-0 p-6 text-center">
                            <h4 class="font-black text-white transition-colors text-[11px] uppercase tracking-widest">{{ $category->name }}</h4>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- FEATURED PRODUCTS GRID -->
    <section id="featured" class="py-24 bg-gray-50/50">
        <div class="max-w-7xl mx-auto px-4 lg:px-8">
            <div class="flex flex-col md:flex-row items-end justify-between gap-8 mb-16">
                <div class="space-y-4">
                    <span class="text-[10px] font-black uppercase tracking-[0.4em] text-primary">In Focus</span>
                    <h2 class="text-5xl lg:text-6xl font-black tracking-tighter text-gray-900 uppercase leading-none">Featured Collections</h2>
                </div>
                <a href="{{ route('products.index') }}" class="btn-outline border-none underline underline-offset-8">Browse All Gallery</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($featuredProducts as $product)
                    @include('partials.customer.product-card', ['product' => $product])
                @endforeach
            </div>
        </div>
    </section>

    <!-- EXCLUSIVE DEAL SECTION -->
    <section class="py-24 bg-primary relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-accent rounded-full blur-[100px] -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-gold rounded-full blur-[100px] translate-x-1/2 translate-y-1/2"></div>
        </div>
        <div class="max-w-4xl mx-auto px-4 text-center relative z-10 space-y-8">
            <span class="text-gold font-black uppercase tracking-[0.5em] text-xs">Limited Time Offer</span>
            <h3 class="text-5xl lg:text-7xl font-black text-white uppercase tracking-tighter leading-none">Exclusive Marketplace Deals</h3>
            <p class="text-white text-lg lg:text-xl font-medium tracking-tight">Up to 50% OFF on premium artisan collections. Hand-picked for the month of April.</p>
            <div class="pt-4">
                <a href="{{ route('products.index') }}" class="bg-white text-primary hover:bg-gold py-6 px-12 text-sm font-black uppercase tracking-widest rounded-2xl shadow-2xl transition-all hover:scale-105 inline-block">Access Private Sale</a>
            </div>
        </div>
    </section>

    <!-- NEWSLETTER / STAY UPDATED -->
    <section class="py-24 bg-white">
        <div class="container mx-auto px-4 text-center">
            <div class="max-w-2xl mx-auto space-y-10">
                <div class="space-y-4">
                    <h3 class="text-4xl font-black text-primary uppercase tracking-tighter">Stay Refined</h3>
                    <p class="text-gray-400 font-medium text-lg leading-relaxed">Join our inner circle for early access to premium drops and exclusive artisan stories.</p>
                </div>

                <form class="flex flex-col sm:flex-row justify-center gap-4">
                    <input type="email" placeholder="Enter your email" 
                        class="px-8 py-4 border border-gray-100 rounded-2xl w-full sm:w-[320px] text-sm font-medium focus:ring-1 focus:ring-accent focus:border-accent outline-none bg-gray-50/50 hover:shadow-lg transition-shadow">
                    <button class="bg-primary text-white px-10 py-4 rounded-2xl font-black uppercase tracking-widest text-[11px] shadow-xl hover:shadow-2xl hover:bg-accent transition-all">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </section>
</div>

<!-- Initialize Swiper -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiper = new Swiper('.heroSwiper', {
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            autoplay: {
                delay: 5000,
            },
        });
    });
</script>

<style>
    .swiper-pagination-bullet-active {
        background: var(--color-accent) !important;
    }
</style>
@endsection

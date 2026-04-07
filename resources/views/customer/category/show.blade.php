@extends('layouts.app')

@section('page_title', $category->name)

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Breadcrumbs Section -->
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 lg:px-8 py-4 flex items-center space-x-2 text-[10px] uppercase tracking-widest font-black text-gray-400">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Aadees</a>
            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('products.index') }}" class="hover:text-primary transition-colors">Collections</a>
            @if($category->parent)
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('category.show', $category->parent->slug) }}" class="hover:text-primary transition-colors">{{ $category->parent->name }}</a>
            @endif
            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-gray-900">{{ $category->name }}</span>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 lg:px-8 py-10">
        <form id="filterForm" action="{{ url()->current() }}" method="GET" class="flex flex-col lg:flex-row gap-12">
            <!-- Sidebar Filters -->
            <aside class="w-full lg:w-64 space-y-12 shrink-0">
                <div class="sticky top-24 bg-white p-8 rounded-[32px] border border-gray-100 shadow-xl shadow-gray-200/50">
                    <!-- category header -->
                    <div class="space-y-6 mb-12">
                        <div class="inline-block px-3 py-1 bg-gray-50 rounded-full">
                            <span class="text-[9px] font-black uppercase tracking-[0.4em] text-accent italic">In Focus</span>
                        </div>
                        <h1 class="text-4xl font-black tracking-tighter text-gray-900 uppercase leading-none break-words italic">{{ $category->name }}</h1>
                        <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest leading-loose">Curating <span class="text-primary">{{ $products->total() }}</span> premium items discovery.</p>
                    </div>

                    @if($category->children->count())
                        <div class="mb-10">
                            <h4 class="font-black text-[9px] uppercase tracking-[0.3em] text-gray-400 mb-5 pl-1 italic">Sub-Collections</h4>
                            <div class="space-y-4">
                                @foreach($category->children as $child)
                                    <a href="{{ route('category.show', $child->slug) }}" class="flex items-center justify-between group">
                                        <span class="text-[10px] font-black uppercase tracking-widest text-gray-500 group-hover:text-primary transition-colors">
                                            {{ $child->name }}
                                        </span>
                                        <div class="h-1 w-1 rounded-full bg-gray-100 group-hover:bg-primary transition-colors"></div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Color Profile -->
                    @if(count($availableColors))
                        <div class="mb-10 pt-10 border-t border-gray-50 text-left">
                            <h4 class="font-black text-[9px] uppercase tracking-[0.3em] text-gray-400 mb-5 pl-1 italic">Color Profile</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach($availableColors as $color)
                                    <label class="cursor-pointer group">
                                        <input type="checkbox" name="colors[]" value="{{ $color }}" {{ in_array($color, request('colors', [])) ? 'checked' : '' }} onchange="this.form.submit()" class="peer hidden">
                                        <div class="px-3 py-1.5 border rounded-xl text-[9px] font-black uppercase tracking-widest transition-all peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary peer-checked:shadow-md peer-checked:scale-105 bg-gray-50/50 border-gray-100 text-gray-500 hover:border-accent hover:bg-white group-active:scale-95">
                                            {{ $color }}
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Geometry (Sizes) -->
                    @if(count($availableSizes))
                        <div class="mb-10 pt-10 border-t border-gray-50 text-left">
                            <h4 class="font-black text-[9px] uppercase tracking-[0.3em] text-gray-400 mb-5 pl-1 italic">Geometry</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach($availableSizes as $size)
                                    <label class="cursor-pointer group">
                                        <input type="checkbox" name="sizes[]" value="{{ $size }}" {{ in_array($size, request('sizes', [])) ? 'checked' : '' }} class="peer hidden">
                                        <div class="w-10 h-10 border flex items-center justify-center rounded-xl text-[10px] font-black transition-all peer-checked:bg-accent peer-checked:text-white peer-checked:border-accent peer-checked:shadow-md peer-checked:scale-105 bg-gray-50/50 border-gray-100 text-gray-500 hover:border-primary hover:bg-white group-active:scale-95">
                                            {{ $size }}
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Valuation (Price) -->
                    <div class="mb-4 pt-10 border-t border-gray-50">
                        <h4 class="font-black text-[9px] uppercase tracking-[0.3em] text-gray-400 mb-5 pl-1 italic">Valuation</h4>
                        <div class="space-y-4">
                            <div class="flex gap-2">
                                <div class="relative w-1/2">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-[8px] text-gray-300 font-bold">₹</span>
                                    <input type="text" name="min_price" value="{{ request('min_price') }}" placeholder="Min" class="w-full border border-gray-100 bg-gray-50/30 rounded-xl pl-6 pr-3 py-2.5 text-[10px] outline-none focus:ring-1 focus:ring-accent focus:bg-white font-black tracking-widest transition-all">
                                </div>
                                <div class="relative w-1/2">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-[8px] text-gray-300 font-bold">₹</span>
                                    <input type="text" name="max_price" value="{{ request('max_price') }}" placeholder="Max" class="w-full border border-gray-100 bg-gray-50/30 rounded-xl pl-6 pr-3 py-2.5 text-[10px] outline-none focus:ring-1 focus:ring-accent focus:bg-white font-black tracking-widest transition-all">
                                </div>
                            </div>
                            <button type="submit" class="w-full h-11 bg-primary text-white rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] hover:bg-accent transition-all shadow-xl hover:shadow-accent/20 active:scale-[0.98]">Update View</button>
                        </div>
                    </div>

                    @if(request()->anyFilled(['colors', 'sizes', 'sort', 'min_price', 'max_price']))
                        <a href="{{ route('category.show', $category->slug) }}" class="block text-center mt-8 text-[9px] font-black uppercase tracking-widest text-accent hover:underline italic transition-all translate-y-0 hover:-translate-y-0.5">Reset Archive</a>
                    @endif
                </div>
            </aside>

            <!-- Product Grid Area -->
            <main class="flex-1">
                <div class="flex items-center justify-between mb-10 bg-white px-8 py-5 rounded-3xl border border-gray-100 shadow-sm">
                    <h3 class="font-black text-[10px] uppercase tracking-[0.3em] text-gray-400 italic">Inventory Audit: <span class="text-primary">{{ $products->total() }} Records</span></h3>
                    
                    <div class="flex items-center gap-4">
                        <span class="text-[9px] font-black uppercase tracking-widest text-gray-400">Sort By:</span>
                        <select name="sort" onchange="this.form.submit()" class="text-[10px] font-black uppercase tracking-widest border border-gray-50 outline-none bg-gray-50 px-5 py-2.5 rounded-2xl text-primary cursor-pointer hover:bg-white hover:border-gray-200 transition-all focus:ring-0">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Newest Exhibits</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Valuation: Ascending</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Valuation: Descending</option>
                        </select>
                    </div>
                </div>

                @if($products->isEmpty())
                    <div class="py-32 text-center bg-white rounded-[40px] border border-gray-100 shadow-inner">
                        <div class="mb-6 opacity-20">
                            <svg class="w-20 h-20 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        </div>
                        <h4 class="text-2xl font-black text-gray-400 uppercase tracking-tighter italic">Archive Depleted</h4>
                        <p class="text-[10px] text-gray-300 mt-4 uppercase tracking-[0.4em] max-w-xs mx-auto leading-relaxed">No matching masterpieces discovered in the current refinement criteria.</p>
                        <a href="{{ route('category.show', $category->slug) }}" class="inline-block mt-10 bg-primary text-white px-10 py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-2xl hover:bg-accent transition-all hover:scale-105 active:scale-95">Refresh Archive</a>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-x-8 gap-y-16">
                        @foreach($products as $product)
                            @include('partials.customer.product-card', ['product' => $product])
                        @endforeach
                    </div>

                    <div class="mt-40 pt-16 border-t border-gray-100 flex justify-center">
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                @endif
            </main>
        </form>
    </div>
</div>
@endsection

@extends('layouts.vendor')

@section('page_title', 'Exhibit New Masterpiece')

@section('content')
<div class="space-y-12 pb-20">
    <div>
        <a href="{{ route('vendor.products.index') }}" class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400 hover:text-primary transition-colors flex items-center group">
            <svg class="h-3 w-3 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
            Return to Collections
        </a>
        <h1 class="text-5xl font-black text-primary uppercase tracking-tighter mt-6 italic">Exhibit New <span class="text-gray-900">Masterpiece</span></h1>
        <p class="text-[11px] font-black uppercase tracking-[0.4em] text-gray-400 mt-2">Detail your creation for the global marketplace</p>
    </div>

        <form action="{{ route('vendor.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-12">
            @csrf
            
            <!-- SECTION 1: IDENTITY -->
            <div class="bg-white p-12 rounded-[40px] border border-gray-100 shadow-sm space-y-10">
                <h3 class="text-xs font-black uppercase tracking-[0.4em] text-primary border-b border-gray-50 pb-6 italic">Identity & Sphere</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Title of Creation</label>
                        <input type="text" name="name" required class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-black outline-none focus:ring-2 focus:ring-primary placeholder-gray-300 shadow-inner" placeholder="e.g. Eternal Emerald Necklace">
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Curated Sphere (Category)</label>
                        <select name="category_id" required class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-black outline-none focus:ring-2 focus:ring-primary shadow-inner">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">The Narrative (Description)</label>
                    <textarea name="description" rows="4" class="w-full bg-gray-50 border-none rounded-3xl px-6 py-4 text-sm font-black outline-none focus:ring-2 focus:ring-primary shadow-inner placeholder-gray-300" placeholder="Tell the story of your masterpiece..."></textarea>
                </div>
            </div>

            <!-- SECTION 2: VALUATION & RESERVE -->
            <div class="bg-white p-12 rounded-[40px] border border-gray-100 shadow-sm space-y-10">
                <h3 class="text-xs font-black uppercase tracking-[0.4em] text-primary border-b border-gray-50 pb-6 italic">Valuation & Reserve</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Retail Valuation (₹)</label>
                        <input type="number" name="price" required class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-black outline-none focus:ring-2 focus:ring-primary shadow-inner">
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Exclusive Valuation (₹)</label>
                        <input type="number" name="discount_price" class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-black outline-none focus:ring-2 focus:ring-primary shadow-inner" placeholder="Optional">
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Inventory Reserve</label>
                        <input type="number" name="stock" required class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-black outline-none focus:ring-2 focus:ring-primary shadow-inner">
                    </div>
                </div>
                <div class="w-full md:w-1/3 space-y-3">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Signature SKU</label>
                    <input type="text" name="sku" required class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-black outline-none focus:ring-2 focus:ring-primary shadow-inner uppercase tracking-widest">
                </div>
            </div>

            <!-- SECTION 3: ATTRIBUTES -->
            <div class="bg-white p-12 rounded-[40px] border border-gray-100 shadow-sm space-y-10">
                <h3 class="text-xs font-black uppercase tracking-[0.4em] text-primary border-b border-gray-50 pb-6 italic">Discovery Attributes</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    @foreach($attributes as $attr)
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">{{ $attr->name }} Profiles</label>
                        <input type="text" name="attributes[{{ $attr->id }}]" class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-black outline-none focus:ring-2 focus:ring-primary shadow-inner placeholder-gray-300" placeholder="Enter values separated by commas (e.g. Red, Blue, Gold)">
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- SECTION 4: VISUAL ASSETS -->
            <div class="bg-white p-12 rounded-[40px] border border-gray-100 shadow-sm space-y-10">
                <h3 class="text-xs font-black uppercase tracking-[0.4em] text-primary border-b border-gray-100 pb-6 italic">Cinematic Visuals</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-20">
                    <div class="space-y-6">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Primary Masterpiece Visual</label>
                        <div class="relative h-64 w-full border-2 border-dashed border-gray-100 rounded-[40px] flex items-center justify-center group overflow-hidden bg-gray-50/50 hover:bg-white hover:border-accent transition-all cursor-pointer">
                            <input type="file" name="thumbnail" required class="absolute inset-0 opacity-0 cursor-pointer z-10">
                            <div class="text-center group-hover:scale-110 transition-transform">
                                <svg class="h-10 w-10 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span class="text-[10px] font-black uppercase tracking-widest text-[#291030]">Select Main Image</span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Detail Gallery (Multi-Asset)</label>
                        <div class="relative h-64 w-full border-2 border-dashed border-gray-100 rounded-[40px] flex items-center justify-center group overflow-hidden bg-gray-50/50 hover:bg-white hover:border-accent transition-all cursor-pointer">
                            <input type="file" name="gallery[]" multiple class="absolute inset-0 opacity-0 cursor-pointer z-10">
                            <div class="text-center group-hover:scale-110 transition-transform">
                                <svg class="h-10 w-10 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6"/></svg>
                                <span class="text-[10px] font-black uppercase tracking-widest text-accent">Add Multiple Perspectives</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full h-24 bg-[#291030] text-[#fcd777] rounded-[40px] text-lg font-black uppercase tracking-[0.5em] hover:scale-[1.02] transition-all shadow-premium hover:shadow-2xl italic">Authorize & Launch Masterpiece</button>
        </form>
    </div>
@endsection

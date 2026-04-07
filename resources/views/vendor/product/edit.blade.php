@extends('layouts.vendor')

@section('page_title', 'Refine Masterpiece')

@section('content')
<div class="space-y-12 pb-20">
    <div>
        <a href="{{ route('vendor.products.index') }}" class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400 hover:text-primary transition-colors flex items-center group">
            <svg class="h-3 w-3 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
            Return to Archive
        </a>
        <h1 class="text-5xl font-black text-primary uppercase tracking-tighter mt-6 italic">Refine <span class="text-gray-900">Masterpiece</span></h1>
        <p class="text-[11px] font-black uppercase tracking-[0.4em] text-gray-400 mt-2">Adjust details for the verified listing</p>
    </div>

        <form action="{{ route('vendor.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-12">
            @csrf
            @method('PUT')
            
            <!-- SECTION 1: IDENTITY -->
            <div class="bg-white p-12 rounded-[40px] border border-gray-100 shadow-sm space-y-10">
                <h3 class="text-xs font-black uppercase tracking-[0.4em] text-primary border-b border-gray-50 pb-6 italic">Identity Update</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Title</label>
                        <input type="text" name="name" value="{{ $product->name }}" required class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-black outline-none focus:ring-2 focus:ring-primary shadow-inner">
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Sphere (Category)</label>
                        <select name="category_id" required class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-black outline-none focus:ring-2 focus:ring-primary shadow-inner">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Narrative Update</label>
                    <textarea name="description" rows="4" class="w-full bg-gray-50 border-none rounded-3xl px-6 py-4 text-sm font-black outline-none focus:ring-2 focus:ring-primary shadow-inner">{{ $product->description }}</textarea>
                </div>
            </div>

            <!-- SECTION 2: VALUATION -->
            <div class="bg-white p-12 rounded-[40px] border border-gray-100 shadow-sm space-y-10">
                <h3 class="text-xs font-black uppercase tracking-[0.4em] text-primary border-b border-gray-50 pb-6 italic">Valuation & Reserve Update</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Retail (₹)</label>
                        <input type="number" name="price" value="{{ $product->price }}" required class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-black outline-none focus:ring-2 focus:ring-primary shadow-inner">
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Exclusive (₹)</label>
                        <input type="number" name="discount_price" value="{{ $product->discount_price }}" class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-black outline-none focus:ring-2 focus:ring-primary shadow-inner">
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Stock Reserve</label>
                        <input type="number" name="stock" value="{{ $product->stock }}" required class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-black outline-none focus:ring-2 focus:ring-primary shadow-inner">
                    </div>
                </div>
                <div class="w-full md:w-1/3 space-y-3">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Signature SKU</label>
                    <input type="text" name="sku" value="{{ $product->sku }}" required class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-black outline-none focus:ring-2 focus:ring-primary shadow-inner uppercase tracking-widest">
                </div>
            </div>

            <!-- SECTION 3: ATTRIBUTES -->
            <div class="bg-white p-12 rounded-[40px] border border-gray-100 shadow-sm space-y-10">
                <h3 class="text-xs font-black uppercase tracking-[0.4em] text-primary border-b border-gray-50 pb-6 italic">Discovery Attributes</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    @foreach($attributes as $attr)
                    <div class="space-y-3">
                        @php $existingVals = $attr->productAttributeValues->pluck('value')->implode(', '); @endphp
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">{{ $attr->name }} Profiles</label>
                        <input type="text" name="attributes[{{ $attr->id }}]" value="{{ $existingVals }}" class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-black outline-none focus:ring-2 focus:ring-primary shadow-inner">
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- SECTION 4: VISUAL ASSETS -->
            <div class="bg-white p-12 rounded-[40px] border border-gray-100 shadow-sm space-y-10">
                <h3 class="text-xs font-black uppercase tracking-[0.4em] text-primary border-b border-gray-50 pb-6 italic">Visual Assets Portfolio</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-20">
                    <div class="space-y-6">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Re-verify Primary Visual</label>
                        <div class="relative h-64 w-full border-2 border-dashed border-gray-100 rounded-[40px] overflow-hidden group">
                            <input type="file" name="thumbnail" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                            <img src="{{ asset($product->thumbnail) }}" class="w-full h-full object-cover group-hover:opacity-40 transition-opacity">
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none">
                                <span class="text-[10px] font-black uppercase tracking-widest text-primary">Replace Current High-Res</span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Detail Gallery Archive</label>
                        <div class="grid grid-cols-3 gap-4 h-64 overflow-y-auto p-4 bg-gray-50 rounded-[30px] border border-gray-100">
                            @if($product->gallery)
                                @foreach($product->gallery as $img)
                                    <img src="{{ asset($img) }}" class="aspect-square rounded-xl object-cover shadow-sm">
                                @endforeach
                            @endif
                            <div class="relative aspect-square border-2 border-dashed border-gray-200 rounded-xl flex items-center justify-center group hover:border-accent cursor-pointer">
                                <input type="file" name="gallery[]" multiple class="absolute inset-0 opacity-0 cursor-pointer">
                                <svg class="h-6 w-6 text-gray-300 group-hover:text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v12m6-6H6"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full h-24 bg-[#291030] text-[#fcd777] rounded-[40px] text-lg font-black uppercase tracking-[0.5em] hover:scale-[1.02] transition-all shadow-premium hover:shadow-2xl italic">Authorize & Update Archive</button>
        </form>
    </div>
@endsection

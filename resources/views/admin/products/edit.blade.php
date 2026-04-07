@extends('layouts.admin')

@section('page_title', 'Refine Masterpiece')

@section('content')
<div class="space-y-12 pb-24">
    <div class="flex items-center justify-between">
        <div class="space-y-2">
            <span class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400">Moderation Hub</span>
            <h1 class="text-4xl font-black text-gray-900 uppercase tracking-tighter italic">Refine <span class="text-primary italic">Masterpiece</span></h1>
        </div>
        <a href="{{ route('admin.products') }}" class="btn-premium bg-gray-900 text-white h-14 px-8 text-[10px]">Back to Archive</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        <div class="lg:col-span-8 bg-white rounded-[48px] p-12 border border-gray-100 shadow-sm">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" class="space-y-12">
                @csrf
                @method('PUT')
                
                <div class="space-y-10">
                    <h3 class="text-xs font-black uppercase tracking-[0.4em] text-primary border-b border-gray-50 pb-6 mb-10 italic">Core Identity</h3>
                    
                    <div class="grid grid-cols-1 gap-10">
                        <div class="space-y-2">
                             <label class="text-[10px] font-black uppercase tracking-widest text-gray-300 ml-4">Masterpiece Name</label>
                             <input type="text" name="name" value="{{ $product->name }}" required class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-xs font-black uppercase tracking-widest outline-none focus:ring-2 focus:ring-primary shadow-inner text-gray-900">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-gray-300 ml-4">Artisan Partner</label>
                                <select name="vendor_id" required class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-xs font-black uppercase tracking-widest outline-none focus:ring-2 focus:ring-primary shadow-inner text-gray-900">
                                    @foreach($vendors as $vendor)
                                        <option value="{{ $vendor->id }}" {{ $product->vendor_id == $vendor->id ? 'selected' : '' }}>{{ $vendor->business_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-gray-300 ml-4">Curation Category</label>
                                <select name="category_id" required class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-xs font-black uppercase tracking-widest outline-none focus:ring-2 focus:ring-primary shadow-inner text-gray-900">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <h3 class="text-xs font-black uppercase tracking-[0.4em] text-primary border-b border-gray-50 pb-6 mt-16 mb-10 italic">Valuation & Stock</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                        <div class="space-y-2">
                             <label class="text-[10px] font-black uppercase tracking-widest text-gray-300 ml-4">Retail Yield (₹)</label>
                             <input type="number" name="price" value="{{ $product->price }}" required class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-xs font-black uppercase tracking-widest outline-none focus:ring-2 focus:ring-primary shadow-inner text-gray-900">
                        </div>
                        <div class="space-y-2">
                             <label class="text-[10px] font-black uppercase tracking-widest text-gray-300 ml-4">Exclusive Price (₹)</label>
                             <input type="number" name="discount_price" value="{{ $product->discount_price }}" class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-xs font-black uppercase tracking-widest outline-none focus:ring-2 focus:ring-primary shadow-inner text-gray-900">
                        </div>
                        <div class="space-y-2">
                             <label class="text-[10px] font-black uppercase tracking-widest text-gray-300 ml-4">Inventory Units</label>
                             <input type="number" name="stock" value="{{ $product->stock }}" required class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-xs font-black uppercase tracking-widest outline-none focus:ring-2 focus:ring-primary shadow-inner text-gray-900">
                        </div>
                    </div>

                    <div class="pt-12 text-right">
                        <button type="submit" class="btn-premium bg-primary text-white h-16 w-full sm:w-auto px-16 text-[11px] shadow-2xl hover:scale-[1.02] transition-transform">Synchronize Masterpiece Changes</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="lg:col-span-4 space-y-12">
            <div class="bg-gray-50 rounded-[40px] p-10 border border-gray-100 shadow-inner space-y-8">
                <h4 class="text-[10px] font-black uppercase tracking-widest text-gray-400">Masterpiece Visual</h4>
                <div class="aspect-square rounded-[32px] overflow-hidden bg-white border border-gray-200 shadow-sm relative group">
                    <img src="{{ $product->thumbnail ?? asset('placeholder.png') }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm pointer-events-none">
                        <span class="text-[9px] font-black uppercase tracking-[0.3em] text-white">Preview established</span>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="p-5 rounded-2xl bg-white border border-gray-100 shadow-sm">
                        <p class="text-[9px] font-black uppercase tracking-widest text-gray-300 mb-1">Masterpiece SKU</p>
                        <p class="text-xs font-black text-gray-900 tracking-widest italic">{{ $product->sku }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

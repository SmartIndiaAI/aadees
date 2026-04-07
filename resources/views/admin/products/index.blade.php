@extends('layouts.admin')

@section('page_title', 'Masterpiece Curation')

@section('content')
<div class="space-y-12 pb-24">
    <div class="flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="space-y-2">
            <span class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400">Marketplace Moderation</span>
            <h1 class="text-4xl font-black text-gray-900 uppercase tracking-tighter italic">Masterpiece <span class="text-primary italic">Curation</span></h1>
        </div>
        
        <form action="{{ route('admin.products') }}" method="GET" class="flex items-center gap-4 bg-white p-3 rounded-3xl border border-gray-100 shadow-sm">
            <select name="vendor_id" onchange="this.form.submit()" class="bg-gray-50 border-none rounded-xl px-6 py-3 text-[10px] font-black uppercase tracking-widest text-gray-900 focus:ring-2 focus:ring-primary outline-none min-w-[200px]">
                <option value="">All Artisan Partners</option>
                @foreach($vendors as $vendor)
                    <option value="{{ $vendor->id }}" {{ request('vendor_id') == $vendor->id ? 'selected' : '' }}>
                        {{ $vendor->business_name }}
                    </option>
                @endforeach
            </select>
            @if(request('vendor_id'))
                <a href="{{ route('admin.products') }}" class="p-2 text-gray-400 hover:text-red-500 transition-colors">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </a>
            @endif
        </form>
    </div>

    <div class="bg-white rounded-[48px] border border-gray-100 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left font-sans">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-10 py-6 text-[10px] font-black uppercase tracking-widest text-gray-400">Masterpiece Identity</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-gray-400">Artisan Partner</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-gray-400">Retail Yield</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-gray-400 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($products as $product)
                        <tr class="hover:bg-gray-50/50 transition-all group">
                            <td class="px-10 py-6">
                                <div class="flex items-center space-x-4">
                                    <div class="h-12 w-12 rounded-xl bg-gray-50 overflow-hidden border border-gray-100 flex items-center justify-center italic">
                                        <img src="{{ $product->thumbnail ?? asset('placeholder.png') }}" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <h5 class="text-sm font-black text-gray-900 mb-1 italic uppercase">{{ $product->name }}</h5>
                                        <p class="text-[9px] font-bold text-gray-400 uppercase tracking-[0.2em] italic">SKU: {{ $product->sku }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-xs font-black text-gray-900 uppercase tracking-widest italic group-hover:text-primary transition-colors">
                                {{ $product->vendor->business_name ?? 'Marketplace Partner' }}
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex flex-col">
                                    <span class="text-sm font-black text-gray-900 italic">₹{{ number_format($product->price, 2) }}</span>
                                    @if($product->discount_price)
                                        <span class="text-[9px] text-primary font-bold uppercase tracking-widest">Sale: ₹{{ number_format($product->discount_price, 2) }}</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="inline-flex items-center justify-center h-10 w-10 rounded-xl bg-gray-50 text-gray-400 hover:bg-primary hover:text-white transition-all shadow-sm">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('Archive this masterpiece permanently?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center h-10 w-10 rounded-xl bg-gray-50 text-gray-400 hover:bg-red-500 hover:text-white transition-all shadow-sm">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-10 py-24 text-center text-gray-300 italic uppercase font-black text-[10px] tracking-widest">No marketplace masterpieces currently indexed for moderation...</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-8 border-t border-gray-100 bg-gray-50/30">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection

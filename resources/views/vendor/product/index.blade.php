@extends('layouts.vendor')

@section('page_title', 'Collection Archive')

@section('content')
<div class="space-y-12">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-4xl font-black text-primary uppercase tracking-tighter italic">Collection <span class="text-gray-900">Archive</span></h1>
            <p class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400 mt-2">Manage your verified artisan listings</p>
        </div>
        <a href="{{ route('vendor.products.create') }}" class="bg-primary text-white px-10 py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:scale-105 transition-transform shadow-premium">List New Masterpiece</a>
    </div>

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-100 text-emerald-600 px-8 py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest mb-8">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-[40px] border border-gray-100 shadow-sm overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">Masterpiece</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">Sphere</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">Valuation</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">Reserve</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($products as $product)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <img src="{{ asset($product->thumbnail) }}" class="h-16 w-16 rounded-2xl object-cover shadow-sm grayscale group-hover:grayscale-0 transition-all">
                                <div>
                                    <h4 class="text-sm font-black text-gray-900 uppercase tracking-tighter">{{ $product->name }}</h4>
                                    <p class="text-[9px] font-black text-gray-300 uppercase tracking-widest mt-1">SKU: {{ $product->sku }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="text-[9px] font-black uppercase tracking-[0.2em] text-[#8e46a5] bg-[#8e46a5]/10 px-4 py-1.5 rounded-full">{{ $product->category->name }}</span>
                        </td>
                        <td class="px-8 py-6 font-black text-sm text-gray-900 italic">₹{{ number_format($product->price, 0) }}</td>
                        <td class="px-8 py-6">
                            <span class="text-[10px] font-black uppercase tracking-widest {{ $product->stock > 0 ? 'text-emerald-500' : 'text-rose-500' }}">
                                {{ $product->stock }} UNITS
                            </span>
                        </td>
                        <td class="px-8 py-6 text-right space-x-4">
                            <a href="{{ route('vendor.products.edit', $product->id) }}" class="text-[10px] font-black uppercase tracking-widest text-[#291030] hover:text-accent transition-colors">Refine</a>
                            <form action="{{ route('vendor.products.destroy', $product->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-[10px] font-black uppercase tracking-widest text-rose-400 hover:text-rose-600 transition-colors" onclick="return confirm('Archive this record?')">Archive</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-32 text-center">
                            <h3 class="text-xl font-black text-gray-200 uppercase italic">Archive Empty</h3>
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-[0.5em] mt-4">Begin your legacy by listing a masterpiece.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-8">
            {{ $products->links() }}
        </div>
</div>
@endsection

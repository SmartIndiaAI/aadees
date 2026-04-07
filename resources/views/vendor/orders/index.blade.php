@extends('layouts.vendor')

@section('page_title', 'Marketplace Acquisitions')

@section('content')
<div class="space-y-12 pb-20">
    <div class="flex items-center justify-between">
        <div class="space-y-2">
            <span class="text-[10px] font-black uppercase tracking-[0.4em] text-accent">Store Records</span>
            <h1 class="text-3xl font-black text-gray-900 uppercase tracking-tighter italic">Order <span class="text-primary italic">Portfolio</span></h1>
        </div>
    </div>

    <div class="bg-white rounded-[48px] border border-gray-100 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left font-sans">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-10 py-6 text-[10px] font-black uppercase tracking-widest text-gray-400">Identity/Order</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-gray-400">Artisan Product</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-gray-400">Yield Share</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-gray-400">Admin Share</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-gray-400 text-center">Settlement</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-gray-400 text-right">Records</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($orders as $item)
                        <tr class="hover:bg-gray-50/50 transition-all group">
                            <td class="px-10 py-6">
                                <h5 class="text-sm font-black text-gray-900 mb-1">#{{ $item->order->order_number }}</h5>
                                <p class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">{{ $item->created_at->format('d M Y') }}</p>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center space-x-4">
                                    <div class="h-10 w-10 rounded-lg bg-gray-50 overflow-hidden border border-gray-100">
                                        <img src="{{ $item->product->image ?? asset('placeholder.png') }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all opacity-80 group-hover:opacity-100">
                                    </div>
                                    <span class="text-xs font-black text-gray-900 uppercase truncate max-w-[150px] italic">{{ $item->product->name }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-sm font-black text-primary italic">₹{{ number_format($item->vendor_share, 2) }}</p>
                                <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest italic font-bold">Your Yield</p>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-sm font-black text-gray-400 italic">₹{{ number_format($item->admin_share, 2) }}</p>
                                <p class="text-[9px] font-bold text-gray-300 uppercase tracking-widest italic font-bold">Platform Tech</p>
                            </td>
                            <td class="px-8 py-6 text-center">
                                @if($item->is_transfer_processed)
                                    <span class="px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-widest bg-green-50 text-green-600 border border-green-100 shadow-sm">Settled</span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-widest bg-orange-50 text-orange-600 border border-orange-100 shadow-sm">Pending</span>
                                @endif
                            </td>
                            <td class="px-8 py-6 text-right">
                                <a href="{{ route('vendor.orders.show', $item->id) }}" class="inline-flex items-center justify-center h-8 w-8 rounded-lg bg-gray-50 text-primary border border-gray-100 hover:bg-primary hover:text-white transition-all shadow-sm">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-10 py-24 text-center text-gray-300 font-medium italic text-[10px] uppercase tracking-widest">Your store archive is currently empty of acquisitions...</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-8 border-t border-gray-50 bg-gray-50/30">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection

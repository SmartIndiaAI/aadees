@extends('layouts.admin')

@section('page_title', 'Remittance Intelligence')

@section('content')
<div class="space-y-12 pb-24">
    <div class="flex items-center justify-between">
        <div class="space-y-2">
            <span class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400">Financial Ledger Monitor</span>
            <h1 class="text-4xl font-black text-gray-900 uppercase tracking-tighter italic">Remittance <span class="text-primary italic">Intelligence</span></h1>
        </div>
    </div>

    <div class="bg-white rounded-[48px] border border-gray-100 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left font-sans">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-10 py-6 text-[10px] font-black uppercase tracking-widest text-gray-400">Order/ID</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-gray-400">Artisan Partner</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-gray-400">Yield Share</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-gray-400">Admin Share</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-gray-400">Settlement Status</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-gray-400 text-right">Records</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($transfers as $trf)
                        <tr class="hover:bg-gray-50/50 transition-all group">
                            <td class="px-10 py-6 border-l-4 border-transparent group-hover:border-primary transition-all">
                                <h5 class="text-sm font-black text-gray-900 mb-1">#{{ $trf->order->order_number }}</h5>
                                <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">Remittance ID: {{ $trf->reference_id ?? 'PENDING' }}</p>
                            </td>
                            <td class="px-8 py-6">
                                <h5 class="text-xs font-black text-gray-900 mb-1 uppercase italic group-hover:text-primary transition-colors tracking-widest">{{ $trf->vendor->shop_name ?? $trf->vendor->business_name }}</h5>
                                <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest italic tracking-tighter">{{ $trf->vendor->email }}</p>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-sm font-black text-primary italic font-bold">₹{{ number_format($trf->amount, 2) }}</p>
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Artisan Share</p>
                            </td>
                            <td class="px-8 py-6">
                                @php
                                    $adminShare = $trf->order->orderItems->where('vendor_id', $trf->vendor_id)->sum('admin_share');
                                @endphp
                                <p class="text-sm font-black text-gray-900 italic font-bold">₹{{ number_format($adminShare, 2) }}</p>
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Platform intake</p>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <span class="px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-[0.4em] 
                                    @if($trf->status === 'success') bg-green-50 text-green-600 shadow-sm border border-green-50
                                    @elseif($trf->status === 'failed') bg-red-50 text-red-600
                                    @else bg-orange-50 text-orange-600 @endif opacity-90 transition-opacity">
                                    {{ str_replace('_', ' ', strtoupper($trf->status)) }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-right font-black text-[10px] text-gray-400 uppercase tracking-widest italic">
                                {{ $trf->created_at->format('d M Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-10 py-24 text-center text-gray-300 italic uppercase font-black text-[10px] tracking-widest">No financial transfer intelligence currently indexed in the digital portfolio...</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-8 border-t border-gray-100 bg-gray-50/30">
            {{ $transfers->links() }}
        </div>
    </div>
</div>
@endsection

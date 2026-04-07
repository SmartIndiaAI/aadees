@extends('layouts.vendor')

@section('page_title', 'Earnings Intelligence')

@section('content')
<div class="space-y-12 pb-24">
    <div class="flex items-center justify-between">
        <div class="space-y-2">
            <span class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400">Financial Ledger</span>
            <h1 class="text-4xl font-black text-gray-900 uppercase tracking-tighter italic">Earnings <span class="text-primary italic">Overview</span></h1>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white rounded-[40px] p-10 border border-gray-100 shadow-sm group hover:shadow-xl hover:-translate-y-1 transition-all">
            <h3 class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Settled Yield</h3>
            <p class="text-3xl font-black text-green-600 italic">₹{{ number_format($stats['paid'], 2) }}</p>
            <div class="mt-4 h-1 w-12 bg-green-500 rounded-full"></div>
        </div>
        <div class="bg-white rounded-[40px] p-10 border border-gray-100 shadow-sm group hover:shadow-xl hover:-translate-y-1 transition-all">
            <h3 class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Pending Remittance</h3>
            <p class="text-3xl font-black text-orange-500 italic">₹{{ number_format($stats['pending'], 2) }}</p>
            <div class="mt-4 h-1 w-12 bg-orange-500 rounded-full"></div>
        </div>
        <div class="bg-white rounded-[40px] p-10 border border-gray-100 shadow-sm group hover:shadow-xl hover:-translate-y-1 transition-all">
            <h3 class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Failed Attempts</h3>
            <p class="text-3xl font-black text-rose-500 italic">₹{{ number_format($stats['failed'], 2) }}</p>
            <div class="mt-4 h-1 w-12 bg-rose-500 rounded-full"></div>
        </div>
    </div>

    <!-- Payout Logs -->
    <div class="bg-white rounded-[48px] border border-gray-100 overflow-hidden shadow-sm">
        <div class="p-10 border-b border-gray-50 bg-gray-50/50">
            <h3 class="text-xs font-black uppercase tracking-[0.3em] text-gray-900">Digital Ledger <span class="text-gray-400 ml-4 font-bold">Payout History</span></h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left font-sans">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-10 py-6 text-[10px] font-black uppercase tracking-widest text-gray-400">Order/Target</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-gray-400">Yield Amount</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-gray-400">Digital Status</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-gray-400 text-right">Settlement Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($transfers as $trf)
                        <tr class="hover:bg-gray-50/30 transition-all">
                            <td class="px-10 py-6">
                                <h5 class="text-sm font-black text-gray-900 mb-1">#{{ $trf->order->order_number }}</h5>
                                <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">Payout Link: {{ $trf->id }}</p>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-sm font-black text-primary italic">₹{{ number_format($trf->amount, 2) }}</p>
                            </td>
                            <td class="px-8 py-6">
                                <span class="px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-widest 
                                    @if($trf->status === 'success') bg-green-50 text-green-600
                                    @elseif($trf->status === 'failed') bg-red-50 text-red-600
                                    @else bg-orange-50 text-orange-600 @endif border border-current opacity-80">
                                    {{ str_replace('_', ' ', strtoupper($trf->status)) }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-right font-black text-[10px] text-gray-400 uppercase tracking-widest">
                                {{ $trf->created_at->format('d M Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-10 py-24 text-center text-gray-300 italic uppercase font-black text-[10px] tracking-widest">No financial transfers recorded in the current cycle...</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-10 py-8 border-t border-gray-100 bg-gray-50/30">
            {{ $transfers->links() }}
        </div>
    </div>
</div>
@endsection

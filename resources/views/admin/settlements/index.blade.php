@extends('layouts.admin')

@section('page_title', 'Settlement Logs')

@section('content')
<!-- Filter bar -->
<div class="bg-white rounded-[32px] p-8 shadow-sm border border-gray-100 mb-10">
    <form action="{{ route('admin.settlements.index') }}" method="GET" class="flex flex-col md:flex-row items-end gap-6">
        <div class="flex-grow">
            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 block">Vendor Filter</label>
            <select name="vendor_id" class="w-full bg-gray-50 border-none rounded-2xl py-4 px-6 text-sm focus:ring-1 focus:ring-primary transition-all">
                <option value="">All Partners</option>
                @foreach($vendors as $v)
                    <option value="{{ $v->id }}" {{ request('vendor_id') == $v->id ? 'selected' : '' }}>{{ $v->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="w-full md:w-64">
            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 block">Payout Status</label>
            <select name="status" class="w-full bg-gray-50 border-none rounded-2xl py-4 px-6 text-sm focus:ring-1 focus:ring-primary transition-all">
                <option value="">All Statuses</option>
                <option value="success" {{ request('status') == 'success' ? 'selected' : '' }}>Success</option>
                <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                <option value="pending_kyc" {{ request('status') == 'pending_kyc' ? 'selected' : '' }}>Pending KYC</option>
            </select>
        </div>
        <button type="submit" class="bg-primary text-white px-8 py-4 rounded-2xl font-black uppercase tracking-widest text-xs hover:shadow-xl transition-all h-[52px]">Apply</button>
        <a href="{{ route('admin.settlements.retry') }}" class="flex items-center space-x-2 bg-secondary text-gray-900 px-8 py-4 rounded-2xl font-black uppercase tracking-widest text-xs hover:shadow-xl transition-all h-[52px] group">
            <svg class="h-4 w-4 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
            <span>Retry Failed Queue</span>
        </a>
    </form>
</div>

<!-- Logs Table -->
<div class="bg-white rounded-[48px] shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-10 border-b border-gray-50">
        <h3 class="text-xl font-black tracking-tight uppercase">Split Transaction <span class="text-primary">History</span></h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50/50">
                <tr>
                    <th class="px-10 py-5 text-[10px] font-black uppercase tracking-widest text-gray-400">Order Ref</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-gray-400">Vendor Partner</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-gray-400">Amount (INR)</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-gray-400">Razorpay ID</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-gray-400">Status</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-gray-400">Attempted At</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 italic font-medium">
                @forelse($transfers as $trf)
                    <tr class="group hover:bg-gray-50/50 transition-colors not-italic">
                        <td class="px-10 py-6">
                            <span class="text-sm font-black text-gray-700">#{{ $trf->order->order_number }}</span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center space-x-3">
                                <div class="h-8 w-8 rounded-lg bg-primary/5 flex items-center justify-center text-primary font-black text-[10px]">
                                    {{ substr($trf->vendor->name, 0, 1) }}
                                </div>
                                <span class="text-sm font-bold text-gray-900">{{ $trf->vendor->name }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-6 font-black text-gray-900">₹{{ number_format($trf->amount, 2) }}</td>
                        <td class="px-8 py-6">
                            @if($trf->transfer_id)
                                <code class="text-[10px] bg-gray-100 px-2 py-1 rounded text-gray-400">{{ $trf->transfer_id }}</code>
                            @else
                                <span class="text-[10px] text-gray-300 italic">None</span>
                            @endif
                        </td>
                        <td class="px-8 py-6">
                            @php
                                $statusClasses = [
                                    'success' => 'bg-green-50 text-green-600',
                                    'failed' => 'bg-red-50 text-red-600',
                                    'pending_kyc' => 'bg-orange-50 text-orange-600',
                                    'pending' => 'bg-gray-50 text-gray-400'
                                ];
                                $class = $statusClasses[$trf->status] ?? $statusClasses['pending'];
                            @endphp
                            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $class }}">
                                {{ str_replace('_', ' ', $trf->status) }}
                            </span>
                            @if($trf->failure_reason)
                                <div class="mt-2 text-[10px] text-red-400 font-bold max-w-xs leading-relaxed">{{ $trf->failure_reason }}</div>
                            @endif
                        </td>
                        <td class="px-8 py-6 text-xs text-gray-400 font-bold tracking-tight">{{ $trf->updated_at->format('M d, Y H:i') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-10 py-20 text-center text-gray-300 italic">No settlement history found for this criteria.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="p-10 border-t border-gray-50">
        {{ $transfers->links() }}
    </div>
</div>
@endsection

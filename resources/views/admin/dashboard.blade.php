@extends('layouts.admin')

@section('page_title', 'Marketplace Overview')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
    <!-- Total Revenue -->
    <div class="bg-white rounded-[40px] p-8 shadow-sm border border-gray-100 hover:shadow-2xl hover:translate-y-[-4px] transition-all group">
        <div class="flex items-center justify-between mb-6">
            <div class="h-12 w-12 rounded-2xl bg-primary/5 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <span class="text-[10px] font-black uppercase tracking-widest text-green-500 bg-green-50 px-3 py-1 rounded-full">Paid</span>
        </div>
        <h3 class="text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Total Revenue</h3>
        <p class="text-3xl font-black tracking-tight text-gray-900">₹{{ number_format($stats['total_revenue'], 0) }}</p>
    </div>

    <!-- Admin Commission -->
    <div class="bg-white rounded-[40px] p-8 shadow-sm border border-gray-100 hover:shadow-2xl hover:translate-y-[-4px] transition-all group">
        <div class="flex items-center justify-between mb-6">
            <div class="h-12 w-12 rounded-2xl bg-secondary/10 flex items-center justify-center text-accent group-hover:bg-accent group-hover:text-white transition-all">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>
            </div>
            <span class="text-[10px] font-black uppercase tracking-widest text-accent bg-accent/5 px-3 py-1 rounded-full text-secondary">Your Share</span>
        </div>
        <h3 class="text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Admin Commission</h3>
        <p class="text-3xl font-black tracking-tight text-gray-900">₹{{ number_format($stats['admin_commission'], 0) }}</p>
    </div>

    <!-- Vendor Payouts -->
    <div class="bg-white rounded-[40px] p-8 shadow-sm border border-gray-100 hover:shadow-2xl hover:translate-y-[-4px] transition-all group">
        <div class="flex items-center justify-between mb-6">
            <div class="h-12 w-12 rounded-2xl bg-primary/5 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            </div>
            <span class="text-[10px] font-black uppercase tracking-widest text-primary bg-primary/5 px-3 py-1 rounded-full">Disbursed</span>
        </div>
        <h3 class="text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Vendor Payouts</h3>
        <p class="text-3xl font-black tracking-tight text-gray-900">₹{{ number_format($stats['vendor_payouts'], 0) }}</p>
    </div>

    <!-- Pending Payouts -->
    <div class="bg-white rounded-[40px] p-8 shadow-sm border border-gray-100 hover:shadow-2xl hover:translate-y-[-4px] transition-all group">
        <div class="flex items-center justify-between mb-6">
            <div class="h-12 w-12 rounded-2xl bg-orange-50 flex items-center justify-center text-orange-500 group-hover:bg-orange-500 group-hover:text-white transition-all">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <span class="text-[10px] font-black uppercase tracking-widest text-orange-500 bg-orange-50 px-3 py-1 rounded-full">Held/KYC</span>
        </div>
        <h3 class="text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Pending Payouts</h3>
        <p class="text-3xl font-black tracking-tight text-gray-900">₹{{ number_format($stats['pending_payouts'], 0) }}</p>
    </div>
</div>

<!-- Main Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
    <!-- Settlement History -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-[48px] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-10 border-b border-gray-50 flex items-center justify-between">
                <h3 class="text-xl font-black tracking-tight uppercase">Recent Split <span class="text-primary">Transfers</span></h3>
                <a href="#" class="text-xs font-black uppercase tracking-widest text-primary border-b-2 border-primary/20 hover:border-primary transition-all">View All logs</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50/50">
                        <tr>
                            <th class="px-10 py-5 text-[10px] font-black uppercase tracking-widest text-gray-400">Order/Vendor</th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-gray-400">Payout Amount</th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-gray-400">Status</th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-gray-400 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($recentTransfers as $trf)
                            <tr>
                                <td class="px-10 py-6">
                                    <div class="flex items-center space-x-4">
                                        <div class="h-10 w-10 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                        </div>
                                        <div>
                                            <h5 class="text-sm font-black text-gray-900 mb-1">#{{ $trf->order->order_number }}</h5>
                                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $trf->vendor->name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="text-sm font-black text-gray-900">₹{{ number_format($trf->amount, 0) }}</p>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="space-y-1">
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
                                            PAYOUT: {{ str_replace('_', ' ', $trf->status) }}
                                        </span>
                                        <div class="mt-2 text-[9px] font-black uppercase tracking-widest text-gray-400">
                                            DELIVERY: <span class="text-primary italic">{{ strtoupper($trf->order->orderItems->where('vendor_id', $trf->vendor_id)->first()->status ?? 'pending') }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    @if($trf->status === 'failed')
                                        <button class="h-8 w-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-10 py-10 text-center text-gray-400 font-medium italic">Establishing split connections...</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Vendor Status Stats -->
    <div class="space-y-8">
        <div class="bg-gray-900 rounded-[48px] p-10 text-white relative overflow-hidden group">
            <div class="absolute -top-12 -right-12 h-32 w-32 bg-primary rounded-full blur-3xl opacity-20 transition-transform duration-700 group-hover:scale-150"></div>
            <h3 class="text-xl font-black mb-8 tracking-tight uppercase">KYC <span class="text-secondary text-primary">Onboarding</span></h3>
            <div class="space-y-6">
                <!-- Active -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="h-10 w-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-green-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <span class="text-sm font-bold text-gray-400">Active Vendors</span>
                    </div>
                    <span class="text-xl font-black">{{ $stats['active_vendors'] }}</span>
                </div>
                <!-- Pending -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="h-10 w-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-orange-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <span class="text-sm font-bold text-gray-400">Pending KYC</span>
                    </div>
                    <span class="text-xl font-black text-orange-400">{{ $stats['pending_vendors'] }}</span>
                </div>
            </div>
            <hr class="border-white/10 my-8">
            <p class="text-xs text-white/50 leading-relaxed italic">Held funds will auto-disburse once vendor KYC is verified active via the dashboard queue.</p>
        </div>

        <div class="bg-white rounded-[48px] p-10 shadow-sm border border-gray-100 flex items-center justify-between">
             <div class="h-16 w-16 rounded-3xl bg-primary/5 flex items-center justify-center text-primary">
                 <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
             </div>
             <div class="text-right">
                 <h4 class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-1">Queue Jobs Finished</h4>
                 <p class="text-2xl font-black text-gray-900">0 Items</p>
             </div>
        </div>
    </div>
</div>
@endsection

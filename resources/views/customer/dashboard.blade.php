@extends('layouts.app')

@section('page_title', 'Account Discovery')

@section('content')
<div class="bg-gray-50 min-h-screen py-20">
    <div class="max-w-4xl mx-auto px-4 lg:px-8">
        <div class="space-y-12">
            <!-- Header -->
            <div class="space-y-4 text-center pb-12 border-b border-gray-100">
                <span class="text-[10px] font-black uppercase tracking-[0.5em] text-accent">Session Established</span>
                <h1 class="text-4xl font-black text-primary uppercase tracking-tighter italic">Welcome Home, <span class="text-gold">{{ auth()->user()->name }}</span></h1>
                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest leading-relaxed">Member since {{ auth()->user()->created_at->format('M Y') }}</p>
            </div>

            <!-- Stats/Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-[24px] border border-gray-100 shadow-premium flex flex-col items-center text-center space-y-4">
                    <span class="text-3xl text-primary">📦</span>
                    <div>
                        <h4 class="text-[10px] font-black uppercase tracking-widest text-gray-400">Total Acquisitions</h4>
                        <p class="text-2xl font-black text-primary leading-none mt-1">{{ number_format($stats['total_orders']) }}</p>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-[24px] border border-gray-100 shadow-premium flex flex-col items-center text-center space-y-4">
                    <span class="text-3xl text-primary">💠</span>
                    <div>
                        <h4 class="text-[10px] font-black uppercase tracking-widest text-gray-400">Active Pipeline</h4>
                        <p class="text-2xl font-black text-primary leading-none mt-1">{{ number_format($stats['pending_orders'] + $stats['confirmed_orders']) }}</p>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-[24px] border border-gray-100 shadow-premium flex flex-col items-center text-center space-y-4">
                    <span class="text-3xl text-primary">💎</span>
                    <div>
                        <h4 class="text-[10px] font-black uppercase tracking-widest text-gray-400">Premium Spent</h4>
                        <p class="text-2xl font-black text-primary leading-none mt-1">₹{{ number_format($stats['total_spent'], 0) }}</p>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-[32px] border border-gray-100 overflow-hidden shadow-premium">
                <div class="p-8 border-b border-gray-50 flex items-center justify-between">
                    <h3 class="text-xs font-black uppercase tracking-widest text-primary">Recent Acquisitions</h3>
                    <a href="#" class="text-[10px] font-black uppercase tracking-widest text-accent hover:underline">View History</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50/50">
                            <tr>
                                <th class="px-8 py-5 text-[9px] font-black uppercase tracking-widest text-gray-400">Order ID</th>
                                <th class="px-8 py-5 text-[9px] font-black uppercase tracking-widest text-gray-400">Date/Time</th>
                                <th class="px-8 py-5 text-[9px] font-black uppercase tracking-widest text-gray-400">Portfolio Total</th>
                                <th class="px-8 py-5 text-[9px] font-black uppercase tracking-widest text-gray-400 text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($recentOrders as $order)
                            <tr>
                                <td class="px-8 py-6">
                                    <span class="text-xs font-black text-primary">#{{ $order->order_number }}</span>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $order->created_at->format('d M Y, H:i') }}</span>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="text-sm font-black text-primary">₹{{ number_format($order->total_amount, 2) }}</span>
                                </td>
                                <td class="px-8 py-6 text-right space-y-4">
                                    <div class="flex flex-col items-end space-y-4">
                                        <!-- Order Global Payment -->
                                        <span class="px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-widest 
                                            {{ $order->payment_status === 'paid' ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600' }}">
                                            {{ $order->payment_status === 'paid' ? 'REMITTANCE SUCCESS' : 'PAYMENT PENDING' }}
                                        </span>

                                        <!-- Itemized Pipeline Tracking -->
                                        <div class="space-y-2 border-t border-gray-50 pt-3 w-full">
                                            @foreach($order->orderItems as $item)
                                                <div class="flex items-center justify-between space-x-4">
                                                    <span class="text-[9px] font-bold text-gray-400 uppercase truncate max-w-[120px]">{{ $item->product->name }}</span>
                                                    <span class="px-2 py-0.5 rounded-full text-[8px] font-black uppercase tracking-widest 
                                                        @if($item->status === 'completed' || $item->status === 'delivered') bg-green-50 text-green-600
                                                        @elseif($item->status === 'processing' || $item->status === 'shipped') bg-blue-50 text-blue-600
                                                        @elseif($item->status === 'cancelled') bg-red-50 text-red-600
                                                        @else bg-orange-50 text-orange-600 @endif whitespace-nowrap">
                                                        {{ strtoupper($item->status ?? 'pending') }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-20 text-center space-y-4">
                                    <p class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-300 italic">No recent acquisition records found.</p>
                                    <a href="{{ route('products.index') }}" class="inline-block mt-4 text-accent border-b-2 border-accent/20 hover:border-accent text-xs font-black uppercase tracking-widest">Start Discovery</a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

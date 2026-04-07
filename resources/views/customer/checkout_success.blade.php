@extends('layouts.app')

@section('page_title', 'Transaction Confirmed')

@section('content')
<div class="bg-gray-50 min-h-[80vh] flex items-center justify-center py-20 px-4">
    <div class="max-w-xl w-full text-center space-y-12">
        <!-- Iconic Success Indicator -->
        <div class="relative inline-block">
            <div class="h-32 w-32 rounded-[40px] bg-primary flex items-center justify-center text-white shadow-[0_25px_50px_-12px_rgba(41,16,48,0.3)] animate-bounce-subtle">
                <svg class="h-16 w-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <div class="absolute -right-4 -bottom-4 h-12 w-12 rounded-2xl bg-gold flex items-center justify-center text-primary shadow-xl">
                <span class="text-xl">✨</span>
            </div>
        </div>

        <!-- Success Message -->
        <div class="space-y-4">
            <span class="text-[10px] font-black uppercase tracking-[0.6em] text-accent">Acquisition Confirmed</span>
            <h1 class="text-4xl font-black text-primary uppercase tracking-tighter italic">Thank You for <span class="text-gold italic">Choosing Refined.</span></h1>
            <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest leading-loose max-w-sm mx-auto">
                Your order <span class="text-primary font-black">#{{ $order->order_number }}</span> has been established into our fulfillment pipeline.
            </p>
        </div>

        <!-- Order Summary Card -->
        <div class="bg-white p-10 rounded-[48px] border border-gray-100 shadow-premium space-y-8">
            <div class="flex items-center justify-between border-b border-gray-50 pb-6">
                <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 text-left">Delivering to</span>
                <span class="text-xs font-black text-primary text-right uppercase tracking-tighter">{{ $order->shipping_name }}</span>
            </div>
            <div class="flex items-center justify-between border-b border-gray-50 pb-6">
                <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 text-left">Portfolio Total</span>
                <span class="text-xs font-black text-primary text-right italic">₹{{ number_format($order->total_amount, 2) }}</span>
            </div>
            <div class="pt-4 grid grid-cols-2 gap-6">
                <a href="{{ route('dashboard') }}" class="btn-premium bg-gray-50 text-gray-900 h-14 text-[10px]">Track Order</a>
                <a href="{{ route('home') }}" class="btn-premium bg-primary text-white h-14 text-[10px]">Back to Archive</a>
            </div>
        </div>

        <!-- Email Confirmation Note -->
        <p class="text-[9px] font-black uppercase tracking-[0.3em] text-gray-400 italic">
            A confirmation mailable has been dispatched to your digital correspondence address.
        </p>
    </div>
</div>
@endsection

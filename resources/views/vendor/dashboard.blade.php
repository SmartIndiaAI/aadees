@extends('layouts.vendor')

@section('page_title', 'Business Highlights')

@section('content')
<!-- KYC Banner -->
@if($vendor->razorpay_account_status !== 'active')
    <div class="mb-10 bg-orange-50 border border-orange-100 rounded-[32px] p-8 flex flex-col md:flex-row items-center justify-between gap-6 shadow-sm">
        <div class="flex items-center space-x-6 text-center md:text-left">
            <div class="h-16 w-16 rounded-3xl bg-white flex items-center justify-center text-orange-500 shadow-sm border border-orange-100">
                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div>
                <h3 class="text-lg font-black text-gray-900 mb-1">KYC Verification Pending</h3>
                <p class="text-sm text-gray-500 leading-relaxed max-w-lg">Your store is open, but payouts are on hold. Complete your Razorpay verification to receive your earnings automatically.</p>
            </div>
        </div>
        <a href="{{ $vendor->razorpay_onboarding_link ?? '#' }}" target="_blank" class="bg-orange-500 text-white px-8 py-4 rounded-2xl font-black uppercase tracking-widest text-sm hover:bg-orange-600 transition-colors shadow-lg shadow-orange-200">Complete KYC Now</a>
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
    <!-- Total Sales -->
    <div class="bg-white rounded-[40px] p-8 shadow-sm border border-gray-100 hover:shadow-2xl hover:translate-y-[-4px] transition-all group">
         <div class="h-12 w-12 rounded-2xl bg-primary/5 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all mb-6">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
        </div>
        <h3 class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Total Gross Sales</h3>
        <p class="text-3xl font-black tracking-tight text-gray-900">₹{{ number_format($stats['total_sales'], 0) }}</p>
    </div>

    <!-- Paid Earnings -->
    <div class="bg-white rounded-[40px] p-8 shadow-sm border border-gray-100 hover:shadow-2xl hover:translate-y-[-4px] transition-all group">
         <div class="h-12 w-12 rounded-2xl bg-green-50 flex items-center justify-center text-green-600 group-hover:bg-green-600 group-hover:text-white transition-all mb-6">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <h3 class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Paid Earnings</h3>
        <p class="text-3xl font-black tracking-tight text-gray-900">₹{{ number_format($stats['paid_earnings'], 0) }}</p>
    </div>

    <!-- Held Earnings -->
    <div class="bg-white rounded-[40px] p-8 shadow-sm border border-gray-100 hover:shadow-2xl hover:translate-y-[-4px] transition-all group">
         <div class="h-12 w-12 rounded-2xl bg-orange-50 flex items-center justify-center text-orange-500 group-hover:bg-orange-500 group-hover:text-white transition-all mb-6">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <h3 class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Pending / Held</h3>
        <p class="text-3xl font-black tracking-tight text-gray-900">₹{{ number_format($stats['pending_earnings'], 0) }}</p>
    </div>

    <!-- Total Orders -->
    <div class="bg-white rounded-[40px] p-8 shadow-sm border border-gray-100 hover:shadow-2xl hover:translate-y-[-4px] transition-all group">
         <div class="h-12 w-12 rounded-2xl bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-gray-900 group-hover:text-white transition-all mb-6">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
        </div>
        <h3 class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Order Count</h3>
        <p class="text-3xl font-black tracking-tight text-gray-900">{{ $stats['total_orders'] }}</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
    <!-- Help Instructions -->
    <div class="bg-white rounded-[48px] p-10 text-gray-900 shadow-sm border border-gray-100 relative overflow-hidden group">
        <div class="absolute -top-20 -right-20 h-48 w-48 bg-primary rounded-full blur-3xl opacity-5 transition-transform duration-700 group-hover:scale-150"></div>
        <h3 class="text-2xl font-black mb-8 tracking-tight uppercase">Seller <span class="text-primary italic">Instructions</span></h3>
        <div class="space-y-6 text-xs text-gray-400 leading-relaxed font-bold uppercase tracking-widest">
            @if($vendor->help_instructions)
                {!! $vendor->help_instructions !!}
            @else
                <p>Welcome to Aadees Partner! Here are some key steps to thrive:</p>
                <div class="flex items-start space-x-4">
                    <span class="h-6 w-6 rounded-lg bg-gray-50 flex items-center justify-center text-primary font-bold shrink-0 shadow-sm">1</span>
                    <p>Keep your KYC active to ensure instant split payouts into your bank account via Razorpay Route.</p>
                </div>
                <div class="flex items-start space-x-4">
                    <span class="h-6 w-6 rounded-lg bg-gray-50 flex items-center justify-center text-primary font-bold shrink-0 shadow-sm">2</span>
                    <p>Fulfill orders within 24 hours to maintain a 'Priority Seller' status and rank higher in search results.</p>
                </div>
                <div class="flex items-start space-x-4">
                    <span class="h-6 w-6 rounded-lg bg-gray-50 flex items-center justify-center text-primary font-bold shrink-0 shadow-sm">3</span>
                    <p>Your commission is set at <span class="text-gray-900 font-bold border-b border-gray-200">{{ $vendor->commission_percentage }}%</span> per sale as per admin settings.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="bg-white rounded-[48px] shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-10 border-b border-gray-50 flex items-center justify-between bg-gray-50/50">
            <h3 class="text-lg font-black tracking-tight uppercase text-gray-900">Recent <span class="text-primary italic">Sales</span></h3>
            <a href="{{ route('vendor.orders.index') }}" class="text-[10px] font-black uppercase tracking-widest text-primary border-b-2 border-primary/20 hover:border-primary transition-all pb-1">View Full Logs</a>
        </div>
        <div class="divide-y divide-gray-50">
            @forelse($recentOrders as $item)
                <div class="p-8 flex items-center justify-between hover:bg-gray-50/50 transition-colors group">
                    <div class="flex items-center space-x-4">
                         <div class="h-10 w-10 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 overflow-hidden border border-gray-100 italic">
                            <img src="{{ $item->product?->image ?? asset('logo.jpeg') }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all opacity-80 group-hover:opacity-100">
                        </div>
                        <div>
                            <h5 class="text-sm font-black text-gray-900 mb-1 truncate max-w-[150px]">#{{ $item->order->order_number }}</h5>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $item->product?->name ?? 'Deleted Product' }} x {{ $item->quantity }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-12">
                        <div class="text-right">
                            <p class="text-[9px] font-black uppercase tracking-widest text-gray-300 mb-1">Admin Share</p>
                            <p class="text-xs font-black text-gray-400 italic font-bold">₹{{ number_format($item->admin_share, 0) }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-[9px] font-black uppercase tracking-widest text-gray-400 mb-1">Your Yield</p>
                            <p class="text-sm font-black text-gray-900 mb-1 font-black italic">₹{{ number_format($item->vendor_share, 0) }}</p>
                            @if($item->is_transfer_processed)
                                <span class="px-2 py-1 bg-green-50 text-green-600 text-[8px] font-black uppercase rounded shadow-sm border border-green-100">Settled</span>
                            @else
                                <span class="px-2 py-1 bg-orange-50 text-orange-600 text-[8px] font-black uppercase rounded shadow-sm border border-orange-100">Pending</span>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-12 text-center text-gray-300 text-sm italic font-black uppercase tracking-widest">Establish your store by adding your first product...</div>
            @endforelse
        </div>
    </div>
</div>
@endsection

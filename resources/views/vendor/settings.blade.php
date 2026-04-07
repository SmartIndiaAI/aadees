@extends('layouts.vendor')

@section('page_title', 'Business Profile & Integration')

@section('content')
<div class="space-y-12 pb-24">
    <div class="flex items-center justify-between">
        <div class="space-y-2">
            <span class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400">Merchant Settings</span>
            <h1 class="text-4xl font-black text-gray-900 uppercase tracking-tighter italic">Profile <span class="text-primary italic">& Integration</span></h1>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-100 text-emerald-600 px-8 py-5 rounded-3xl text-xs font-black uppercase tracking-widest flex items-center gap-4">
            <div class="h-8 w-8 rounded-xl bg-emerald-500 text-white flex items-center justify-center">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
            </div>
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        <div class="lg:col-span-8 bg-white rounded-[48px] p-12 border border-gray-100 shadow-sm">
            <form action="{{ route('vendor.settings.update') }}" method="POST" class="space-y-12">
                @csrf
                <div class="space-y-10">
                    <h3 class="text-xs font-black uppercase tracking-[0.4em] text-primary border-b border-gray-50 pb-6 mb-10 italic">Core Business Details</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-300 ml-4">Business Name</label>
                            <input type="text" name="business_name" value="{{ $vendor->business_name }}" required
                                   class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-xs font-black uppercase tracking-widest outline-none focus:ring-2 focus:ring-primary shadow-inner text-gray-900">
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-300 ml-4">Official Email</label>
                            <input type="email" name="business_email" value="{{ $vendor->email }}" required
                                   class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-xs font-black uppercase tracking-widest outline-none focus:ring-2 focus:ring-primary shadow-inner text-gray-900">
                        </div>
                    </div>

                    <div class="pt-10">
                        <h3 class="text-xs font-black uppercase tracking-[0.4em] text-primary border-b border-gray-50 pb-6 mb-10 italic">Financial Integration (Razorpay)</h3>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-300 ml-4">Razorpay Account ID (linked for settlements)</label>
                            <input type="text" name="razorpay_account_id" value="{{ $vendor->razorpay_account_id }}" required
                                   class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-xs font-black uppercase tracking-widest outline-none focus:ring-2 focus:ring-primary shadow-inner text-gray-900" placeholder="acc_XXXXXXXXXXXXXX">
                            <p class="text-[9px] font-bold text-gray-400 mt-3 px-4 leading-relaxed tracking-widest uppercase">
                                This ID is essential for the automatic split of funds. Ensure it matches your linked Razorpay Route account.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="pt-12 border-t border-gray-50">
                    <button type="submit" class="w-full sm:w-auto px-12 h-14 bg-primary text-white rounded-2xl text-[10px] font-black uppercase tracking-[0.3em] shadow-xl hover:shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all italic">
                        Synchronize Business Profile
                    </button>
                </div>
            </form>
        </div>

        <div class="lg:col-span-4 space-y-8">
            <div class="bg-[#291030] rounded-[48px] p-10 text-white space-y-6 shadow-premium relative overflow-hidden group">
                <div class="absolute -top-12 -right-12 h-32 w-32 bg-accent rounded-full blur-3xl opacity-10 transition-transform duration-700 group-hover:scale-150"></div>
                <h4 class="text-xs font-black uppercase tracking-[0.4em] italic text-accent">Integration Status</h4>
                <div class="flex items-center gap-4">
                    <div class="h-3 w-3 rounded-full {{ $vendor->razorpay_account_id ? 'bg-emerald-500 shadow-[0_0_15px_rgba(16,185,129,0.5)]' : 'bg-rose-500 shadow-[0_0_15px_rgba(244,63,94,0.5)]' }}"></div>
                    <span class="text-[10px] font-black uppercase tracking-widest text-white">{{ $vendor->razorpay_account_id ? 'Active Connectivity' : 'Action Required' }}</span>
                </div>
                <p class="text-[9px] font-bold text-white/60 uppercase tracking-widest leading-relaxed">
                    Automatic settlement is powered by Razorpay Route. Your account ID must be verified by the admin before the next payout cycle.
                </p>
            </div>

            <div class="bg-white rounded-[40px] p-10 border border-gray-100 shadow-sm space-y-6">
                <h4 class="text-[10px] font-black uppercase tracking-widest text-primary italic">Documentation</h4>
                <div class="space-y-4">
                    <a href="{{ route('vendor.guide') }}" class="block p-4 rounded-2xl bg-gray-50 hover:bg-primary hover:text-white transition-all group">
                        <span class="text-[9px] font-black uppercase tracking-widest group-hover:text-white transition-all">Onboarding Manual</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

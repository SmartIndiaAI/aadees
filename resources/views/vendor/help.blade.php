@extends('layouts.vendor')

@section('page_title', 'Artisan Support Archive')

@section('content')
<div class="space-y-12 pb-24">
    <div class="flex items-center justify-between">
        <div class="space-y-2">
            <span class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400">Support Resource</span>
            <h1 class="text-4xl font-black text-gray-900 uppercase tracking-tighter italic">Artisan <span class="text-primary italic">Guide</span></h1>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <div class="bg-white rounded-[48px] p-12 border border-gray-100 shadow-sm space-y-10">
            <h3 class="text-xs font-black uppercase tracking-[0.4em] text-primary border-b border-gray-50 pb-6 mb-10 italic">Core Operations</h3>
            <div class="space-y-8">
                <div class="flex items-start space-x-6 group">
                    <span class="h-8 w-8 rounded-xl bg-gray-50 flex items-center justify-center text-primary font-black shadow-sm group-hover:bg-primary group-hover:text-white transition-all text-xs">01</span>
                    <div>
                        <h4 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-2">Masterpiece Listing</h4>
                        <p class="text-xs text-gray-400 leading-relaxed font-bold uppercase tracking-widest">Detail your creation in the 'My Products' suite. Ensure high-resolution visuals are uploaded for global discovery.</p>
                    </div>
                </div>
                <div class="flex items-start space-x-6 group">
                    <span class="h-8 w-8 rounded-xl bg-gray-50 flex items-center justify-center text-primary font-black shadow-sm group-hover:bg-primary group-hover:text-white transition-all text-xs">02</span>
                    <div>
                        <h4 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-2">Acquisition Pipeline</h4>
                        <p class="text-xs text-gray-400 leading-relaxed font-bold uppercase tracking-widest">When a purchase occurs, update the status to 'Shipped' within 24 hours to maintain 'Super Pro Plus' priority status.</p>
                    </div>
                </div>
                <div class="flex items-start space-x-6 group">
                    <span class="h-8 w-8 rounded-xl bg-gray-50 flex items-center justify-center text-primary font-black shadow-sm group-hover:bg-primary group-hover:text-white transition-all text-xs">03</span>
                    <div>
                        <h4 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-2">Remittance Cycles</h4>
                        <p class="text-xs text-gray-400 leading-relaxed font-bold uppercase tracking-widest">Your total yield is calculated per acquisition. All settled transfers are logged in the 'My Earnings' summary.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 rounded-[48px] p-12 border border-gray-100 shadow-sm space-y-10 relative overflow-hidden group">
            <div class="absolute -top-12 -right-12 h-32 w-32 bg-primary rounded-full blur-3xl opacity-5"></div>
            <h3 class="text-xs font-black uppercase tracking-[0.4em] text-gray-400 border-b border-gray-100 pb-6 mb-10 italic">Premium Etiquette</h3>
            <div class="space-y-6 text-xs text-gray-500 leading-relaxed font-bold uppercase tracking-wider">
                <p>Every masterpiece sold through Aadees is part of a curated global legacy. Maintain your artisan profile with verified visuals and precise descriptions.</p>
                <div class="p-8 bg-white rounded-3xl border border-gray-100 italic space-y-4 shadow-sm text-primary">
                    <p>"Quality is not an act, it is a habit."</p>
                    <p class="text-[9px] font-black uppercase tracking-widest text-gray-400 not-italic">— Artisanal Integrity Code</p>
                </div>
                <p>For direct technical support regarding your Digital Portfolio, contact the Aadees Executive curator team via the official vendor channel.</p>
            </div>
        </div>
    </div>
</div>
@endsection

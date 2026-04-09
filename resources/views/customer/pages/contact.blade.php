@extends('layouts.app')

@section('page_title', 'Connect with Archivists')

@section('content')
<div class="bg-gray-50 min-h-screen py-24">
    <div class="max-w-6xl mx-auto px-4 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-24">
            <div class="space-y-12">
                <div class="space-y-4">
                    <span class="text-[10px] font-black uppercase tracking-[0.4em] text-primary italic">Operational Channel</span>
                    <h1 class="text-6xl font-black text-gray-900 uppercase tracking-tighter italic whitespace-nowrap">Connect <br> <span class="text-primary italic">Systems</span></h1>
                </div>
                
                <p class="text-gray-400 font-bold uppercase tracking-[0.2em] leading-relaxed text-[11px] max-w-md">Our specialized curators are available for inquiries regarding artisan coordination, platform integrity, and high-tier logistics.</p>
                
                <div class="space-y-12">
                    <div class="space-y-4">
                        <h4 class="text-[10px] font-black uppercase tracking-widest text-primary italic">Transmission Protocols</h4>
                        <div class="space-y-4">
                            <div class="flex items-center gap-6">
                                <div class="h-12 w-12 rounded-2xl bg-white border border-gray-100 flex items-center justify-center text-primary shadow-sm">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </div>
                                <div>
                                    <p class="text-[9px] font-black uppercase tracking-widest text-gray-300 mb-1 leading-none">Primary Correspondence</p>
                                    <p class="text-[11px] font-black uppercase tracking-widest text-gray-900">{{ $contactInfo['email'] }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-6">
                                <div class="h-12 w-12 rounded-2xl bg-white border border-gray-100 flex items-center justify-center text-primary shadow-sm">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                </div>
                                <div>
                                    <p class="text-[9px] font-black uppercase tracking-widest text-gray-300 mb-1 leading-none">Direct Connection</p>
                                    <p class="text-[11px] font-black uppercase tracking-widest text-gray-900">{{ $contactInfo['phone'] }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-6">
                                <div class="h-12 w-12 rounded-2xl bg-white border border-gray-100 flex items-center justify-center text-primary shadow-sm">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <div>
                                    <p class="text-[9px] font-black uppercase tracking-widest text-gray-300 mb-1 leading-none">Physical Archive</p>
                                    <p class="text-[11px] font-black uppercase tracking-widest text-gray-900">{{ $contactInfo['address'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-[48px] p-12 lg:p-20 shadow-xl border border-gray-100 relative overflow-hidden group">
                <div class="absolute -bottom-12 -left-12 h-32 w-32 bg-primary rounded-full blur-3xl opacity-5 transition-transform group-hover:scale-150"></div>
                <form action="#" class="space-y-10 relative">
                    <div class="space-y-8">
                        <div class="space-y-2">
                             <label class="text-[9px] font-black uppercase tracking-[0.3em] text-gray-300 ml-4">Identifier</label>
                             <input type="text" placeholder="FULL NAME" class="w-full bg-gray-50 border-none rounded-2xl px-8 py-6 text-[11px] font-black uppercase tracking-widest outline-none focus:ring-2 focus:ring-primary shadow-inner">
                        </div>
                        <div class="space-y-2">
                             <label class="text-[9px] font-black uppercase tracking-[0.3em] text-gray-300 ml-4">Digital Signal</label>
                             <input type="email" placeholder="EMAIL ADDRESS" class="w-full bg-gray-50 border-none rounded-2xl px-8 py-6 text-[11px] font-black uppercase tracking-widest outline-none focus:ring-2 focus:ring-primary shadow-inner">
                        </div>
                        <div class="space-y-2">
                             <label class="text-[9px] font-black uppercase tracking-[0.3em] text-gray-300 ml-4">Communication Core</label>
                             <textarea rows="4" placeholder="YOUR MESSAGE" class="w-full bg-gray-50 border-none rounded-3xl px-8 py-6 text-[11px] font-black uppercase tracking-widest outline-none focus:ring-2 focus:ring-primary shadow-inner resize-none"></textarea>
                        </div>
                    </div>
                    
                    <button type="submit" class="w-full bg-primary text-white h-20 rounded-3xl text-[10px] font-black uppercase tracking-[0.4em] shadow-2xl shadow-primary/20 hover:scale-105 active:scale-95 transition-all">Transmit Intelligence</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

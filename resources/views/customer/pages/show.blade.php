@extends('layouts.app')

@section('page_title', $title)

@section('content')
<div class="bg-gray-50 min-h-screen py-24">
    <div class="max-w-4xl mx-auto px-4 lg:px-8">
        <div class="space-y-4 mb-16 text-center">
            <span class="text-[10px] font-black uppercase tracking-[0.4em] text-primary italic">Official Documentation</span>
            <h1 class="text-5xl font-black text-gray-900 uppercase tracking-tighter italic">{{ $title }}</h1>
            <div class="h-1 w-24 bg-primary mx-auto rounded-full"></div>
        </div>

        <div class="bg-white rounded-[48px] p-12 lg:p-20 shadow-sm border border-gray-100">
            <div class="prose prose-sm max-w-none text-gray-600 leading-loose font-medium">
                {!! $content !!}
            </div>
            
            <div class="mt-20 pt-12 border-t border-gray-50 flex flex-col items-center gap-6">
                <p class="text-[9px] font-black uppercase tracking-[0.4em] text-gray-300 italic">End of Document — Verified for Platform Integrity</p>
                <a href="{{ route('home') }}" class="group flex items-center gap-4 text-[10px] font-black uppercase tracking-widest text-primary hover:scale-105 transition-all">
                    <svg class="h-4 w-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Return to Archive
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

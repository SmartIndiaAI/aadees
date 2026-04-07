@extends('layouts.app')

@section('page_title', 'Recover Identity')

@section('content')
<div class="bg-gray-50 min-h-[90vh] flex items-center justify-center py-24 px-4">
    <div class="w-full max-w-md space-y-12">
        <!-- Brand Header -->
        <div class="text-center space-y-6">
            <a href="{{ route('home') }}" class="inline-flex items-center space-x-3 group active:scale-95 transition-transform">
                <img src="{{ asset('logo.jpeg') }}" class="h-10 w-auto rounded-xl shadow-premium" alt="Aadees">
                <span class="text-2xl font-black tracking-tighter text-gray-900 group-hover:text-primary transition-colors">Aadees</span>
            </a>
            <div class="space-y-2">
                <h1 class="text-4xl font-black tracking-tighter text-gray-900 uppercase italic">Recover <span class="text-primary not-italic">Key.</span></h1>
                <p class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400">Initiate secure password recovery flow</p>
            </div>
        </div>

        <!-- Auth Card -->
        <div class="bg-white p-12 rounded-[48px] shadow-premium border border-gray-100">
            @if (session('status'))
                <div class="mb-8 p-6 bg-green-50 border border-green-100 rounded-2xl text-[10px] font-black uppercase tracking-widest text-green-600 leading-relaxed text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route(($role === 'user' ? '' : $role . '.') . 'password.email') }}" method="POST" class="space-y-10">
                @csrf
                <div class="space-y-2">
                    <label class="text-[9px] font-black uppercase tracking-widest text-gray-400 ml-4">Authorized Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full h-16 bg-gray-50 border-none rounded-2xl px-8 text-sm font-bold focus:ring-1 focus:ring-primary transition-all">
                    @error('email') <p class="text-[10px] font-black text-red-100 ml-4 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full btn-premium bg-primary text-white h-16 shadow-[0_25px_50px_-12px_rgba(41,16,48,0.2)]">Generate Reset Link</button>
                    <p class="text-center mt-10 text-[9px] font-black uppercase tracking-widest text-gray-300 leading-loose">
                        Contact support if you still can't access your account.
                    </p>
                </div>
            </form>
        </div>

        <div class="text-center">
            <a href="{{ route(($role === 'user' ? '' : $role . '.') . 'login') }}" class="text-[9px] font-black uppercase tracking-widest text-gray-400 hover:text-primary transition-colors flex items-center justify-center group">
                <svg class="mr-2 h-4 w-4 transform group-hover:-translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to Authentication
            </a>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('page_title', 'Access ' . ucfirst($role))

@section('content')
<div class="bg-gray-50 min-h-[90vh] flex items-center justify-center py-24 px-4">
    <div class="w-full max-w-lg space-y-12">
        <!-- Brand Header -->
        <div class="text-center space-y-6">
            <a href="{{ route('home') }}" class="inline-flex items-center space-x-3 group active:scale-95 transition-transform">
                <img src="{{ asset('logo.jpeg') }}" class="h-10 w-auto rounded-xl shadow-premium" alt="Aadees">
            </a>
            <div class="space-y-2">
                <h1 class="text-4xl font-black tracking-tighter text-gray-900 uppercase italic">Welcome <span class="text-primary not-italic">Back.</span></h1>
                <p class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400">Secure entry to your premium {{ $role }} identity</p>
            </div>
        </div>

        <!-- Auth Card -->
        <div class="bg-white p-12 rounded-[48px] shadow-premium border border-gray-100">
            <form action="{{ url(($role === 'user' ? '' : $role . '/') . 'login') }}" method="POST" class="space-y-10">
                @csrf
                <div class="space-y-8">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase tracking-widest text-[#291030] ml-4">Credentials Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full h-14 bg-gray-50 border-none rounded-[24px] px-8 text-xs font-bold focus:ring-1 focus:ring-primary transition-all @error('email') ring-1 ring-red-300 @enderror">
                        @error('email') <p class="text-[10px] font-black text-red-500 ml-4 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between px-4">
                            <label class="text-[10px] font-black uppercase tracking-widest text-[#291030]">Secure Password</label>
                            <a href="{{ route(($role === 'user' ? '' : $role . '.') . 'password.request') }}" class="text-[9px] font-black uppercase tracking-widest text-gray-300 hover:text-primary transition-colors italic">Forgot Key?</a>
                        </div>
                        <input type="password" name="password" required class="w-full h-14 bg-gray-50 border-none rounded-[24px] px-8 text-xs font-bold focus:ring-1 focus:ring-primary transition-all">
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full h-14 bg-primary text-white rounded-[24px] text-[10px] font-black uppercase tracking-widest shadow-xl hover:shadow-2xl transition-all active:scale-95">Secure Login</button>
                    @if($role !== 'admin')
                        <p class="text-center mt-10 text-[10px] font-black uppercase tracking-widest text-gray-400 leading-loose">
                            New member? <a href="{{ route(($role === 'user' ? '' : $role . '.') . 'register') }}" class="text-primary hover:underline italic">Create Account</a>
                        </p>
                    @endif
                </div>
            </form>
        </div>

        <!-- Role Switcher -->
        <div class="flex items-center justify-center space-x-6 opacity-30 hover:opacity-100 transition-opacity">
            @foreach(['user', 'vendor', 'admin'] as $r)
                @if($r !== $role)
                    <a href="{{ route(($r === 'user' ? '' : $r . '.') . 'login') }}" class="text-[9px] font-black uppercase tracking-widest text-gray-400 hover:text-primary transition-colors">{{ ucfirst($r) }} Area</a>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection

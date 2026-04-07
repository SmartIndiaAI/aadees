@extends('layouts.app')

@section('page_title', 'Register ' . ucfirst($role))

@section('content')
<div class="bg-gray-50 min-h-[90vh] flex items-center justify-center py-24 px-4">
    <div class="w-full max-w-lg space-y-12">
        <!-- Brand Header -->
        <div class="text-center space-y-6">
            <a href="{{ route('home') }}" class="inline-flex items-center space-x-3 group active:scale-95 transition-transform">
                <img src="{{ asset('logo.jpeg') }}" class="h-10 w-auto rounded-xl shadow-premium" alt="Aadees">
            </a>
            <div class="space-y-2">
                <h1 class="text-4xl font-black tracking-tighter text-gray-900 uppercase italic">Join <span class="text-primary not-italic">Refined.</span></h1>
                <p class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400">Establish your {{ $role }} identity in our marketplace</p>
            </div>
        </div>

        <!-- Auth Card -->
        <div class="bg-white p-12 rounded-[48px] shadow-premium border border-gray-100">
            <form action="{{ url(($role === 'user' ? '' : $role . '/') . 'register') }}" method="POST" class="space-y-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-[#291030] ml-4">Full Identity</label>
                        <input type="text" name="name" value="{{ old('name') }}" required autofocus class="w-full h-12 bg-gray-50 border-none rounded-2xl px-6 text-xs font-bold focus:ring-1 focus:ring-primary transition-all">
                        @error('name') <p class="text-[10px] font-black text-red-100 ml-4 mt-1">{{ $message }}</p> @enderror
                    </div>
                    @if($role === 'vendor')
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-[#291030] ml-4">Establishment Name</label>
                            <input type="text" name="shop_name" value="{{ old('shop_name') }}" required class="w-full h-12 bg-gray-50 border-none rounded-2xl px-6 text-xs font-bold focus:ring-1 focus:ring-primary transition-all">
                            @error('shop_name') <p class="text-[10px] font-black text-red-100 ml-4 mt-1">{{ $message }}</p> @enderror
                        </div>
                    @endif
                    <div class="col-span-full space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-[#291030] ml-4">Corporate Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="w-full h-12 bg-gray-50 border-none rounded-2xl px-6 text-xs font-bold focus:ring-1 focus:ring-primary transition-all">
                        @error('email') <p class="text-[10px] font-black text-red-100 ml-4 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-[#291030] ml-4">Master Password</label>
                        <input type="password" name="password" required class="w-full h-12 bg-gray-50 border-none rounded-2xl px-6 text-xs font-bold focus:ring-1 focus:ring-primary transition-all">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-[#291030] ml-4">Confirm Key</label>
                        <input type="password" name="password_confirmation" required class="w-full h-12 bg-gray-50 border-none rounded-2xl px-6 text-xs font-bold focus:ring-1 focus:ring-primary transition-all">
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full h-12 bg-primary text-white rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl hover:shadow-2xl transition-all active:scale-95">Establish Account</button>
                    <p class="text-center mt-8 text-[10px] font-black uppercase tracking-widest text-gray-400 leading-loose">
                        Already have access? <a href="{{ route(($role === 'user' ? '' : $role . '.') . 'login') }}" class="text-primary hover:underline italic">Initialize Session</a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Role Switcher -->
        <div class="flex items-center justify-center space-x-6 opacity-30 hover:opacity-100 transition-opacity">
            @foreach(['user', 'vendor'] as $r)
                @if($r !== $role)
                    <a href="{{ route(($r === 'user' ? '' : $r . '.') . 'register') }}" class="text-[9px] font-black uppercase tracking-widest text-gray-400 hover:text-primary transition-colors">Become a {{ ucfirst($r) }}</a>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection

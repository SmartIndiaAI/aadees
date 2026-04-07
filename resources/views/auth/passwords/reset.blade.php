@extends('layouts.app')

@section('page_title', 'Establish New Key')

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
                <h1 class="text-4xl font-black tracking-tighter text-gray-900 uppercase italic">Update <span class="text-primary not-italic">Key.</span></h1>
                <p class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400">Establish your new master password</p>
            </div>
        </div>

        <!-- Auth Card -->
        <div class="bg-white p-12 rounded-[48px] shadow-premium border border-gray-100">
            <form action="{{ route(($role === 'user' ? '' : $role . '.') . 'password.update') }}" method="POST" class="space-y-8">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="role" value="{{ $role }}">

                <div class="space-y-6">
                    <div class="space-y-2">
                        <label class="text-[9px] font-black uppercase tracking-widest text-gray-400 ml-4">Confirm Email Identity</label>
                        <input type="email" name="email" value="{{ $email ?? old('email') }}" required class="w-full h-16 bg-gray-50 border-none rounded-2xl px-8 text-sm font-bold focus:ring-1 focus:ring-primary transition-all">
                        @error('email') <p class="text-[10px] font-black text-red-100 ml-4 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-[9px] font-black uppercase tracking-widest text-gray-400 ml-4">New Master Password</label>
                        <input type="password" name="password" required autofocus class="w-full h-16 bg-gray-50 border-none rounded-2xl px-8 text-sm font-bold focus:ring-1 focus:ring-primary transition-all">
                        @error('password') <p class="text-[10px] font-black text-red-100 ml-4 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-[9px] font-black uppercase tracking-widest text-gray-400 ml-4">Validate Master Key</label>
                        <input type="password" name="password_confirmation" required class="w-full h-16 bg-gray-50 border-none rounded-2xl px-8 text-sm font-bold focus:ring-1 focus:ring-primary transition-all">
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full btn-premium bg-primary text-white h-16 shadow-[0_25px_50px_-12px_rgba(41,16,48,0.2)]">Update Authentication</button>
                    <p class="text-center mt-8 text-[9px] font-black uppercase tracking-widest text-gray-300 leading-loose">
                        Your security is our priority. Ensure your new key is unique.
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('page_title', 'Artisan Partner Dossier')

@section('content')
<div class="space-y-12 pb-24">
    <div class="flex items-center justify-between">
        <div class="space-y-2">
            <a href="{{ route('admin.vendors.index') }}" class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400 hover:text-primary transition-colors flex items-center group">
                <svg class="h-3 w-3 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
                Return to Oversight
            </a>
            <h1 class="text-4xl font-black text-gray-900 uppercase tracking-tighter italic">Partner <span class="text-primary italic">Dossier</span></h1>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Profile Card -->
        <div class="lg:col-span-1 space-y-8">
            <div class="bg-white rounded-[48px] p-10 border border-gray-100 shadow-sm text-center">
                <div class="h-24 w-24 rounded-[32px] bg-primary/5 flex items-center justify-center text-primary font-black text-4xl mx-auto mb-6 shadow-sm border border-primary/10">
                    {{ substr($vendor->shop_name ?? $vendor->business_name, 0, 1) }}
                </div>
                <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight mb-2">{{ $vendor->shop_name ?? $vendor->business_name }}</h2>
                <p class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400 mb-8 italic">Verified Artisan Partner</p>
                
                <div class="space-y-4 pt-8 border-t border-gray-50">
                    <div class="flex items-center justify-between text-xs">
                        <span class="font-black uppercase tracking-widest text-gray-300">KYC Node</span>
                        <span class="font-black text-green-500 uppercase tracking-widest bg-green-50 px-3 py-1 rounded-full">{{ $vendor->razorpay_account_status ?? 'PENDING' }}</span>
                    </div>
                    <div class="flex items-center justify-between text-xs">
                        <span class="font-black uppercase tracking-widest text-gray-300">Revenue Split</span>
                        <span class="font-black text-primary italic">{{ $vendor->commission_percentage }}% Admin Share</span>
                    </div>
                </div>
            </div>

            <div class="bg-gray-900 rounded-[40px] p-10 text-white relative overflow-hidden group">
                <div class="absolute -top-12 -right-12 h-32 w-32 bg-primary rounded-full blur-3xl opacity-20"></div>
                <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-500 mb-6 italic">Moderation Terminal</h4>
                <form action="{{ route('admin.vendors.update', $vendor->id) }}" method="POST" class="space-y-6">
                    @csrf @method('PUT')
                    <div class="space-y-2">
                        <label class="text-[9px] font-black uppercase tracking-widest text-gray-400 ml-2">Commission Logic (%)</label>
                        <input type="number" name="commission_percentage" value="{{ $vendor->commission_percentage }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm font-black outline-none focus:ring-1 focus:ring-primary">
                    </div>
                     <div class="space-y-2">
                        <label class="text-[9px] font-black uppercase tracking-widest text-gray-400 ml-2">Status Node</label>
                        <select name="razorpay_account_status" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm font-black outline-none focus:ring-1 focus:ring-primary">
                            <option value="active" {{ $vendor->razorpay_account_status === 'active' ? 'selected' : '' }}>ACTIVE</option>
                            <option value="pending" {{ $vendor->razorpay_account_status === 'pending' ? 'selected' : '' }}>PENDING</option>
                            <option value="suspended" {{ $vendor->razorpay_account_status === 'suspended' ? 'selected' : '' }}>SUSPENDED</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full bg-primary text-white py-4 rounded-2xl text-[10px] font-black uppercase tracking-[0.3em] hover:bg-white hover:text-primary transition-all shadow-lg italic">Authorize Protocol Update</button>
                </form>
            </div>
        </div>

        <!-- Masterpiece Audit -->
        <div class="lg:col-span-2 space-y-12">
            <div class="bg-white rounded-[48px] border border-gray-100 overflow-hidden shadow-sm">
                <div class="p-10 border-b border-gray-50 bg-gray-50/50">
                    <h3 class="text-xs font-black uppercase tracking-[0.3em] text-gray-900 italic">Masterpiece Portfolio <span class="text-gray-400 ml-4 font-bold">Active Listings</span></h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th class="px-10 py-6 text-[10px] font-black uppercase tracking-widest text-gray-400">Creation</th>
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-gray-400">Retail Yield</th>
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-gray-400">Exclusive Price</th>
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-gray-400 text-right">Moderation</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($vendor->products ?? [] as $product)
                                <tr class="hover:bg-gray-50/30 transition-all">
                                    <td class="px-10 py-6 font-black text-sm text-gray-900 uppercase italic">{{ $product->name }}</td>
                                    <td class="px-8 py-6 font-black text-sm text-gray-400 italic font-bold tracking-tighter italic">₹{{ number_format($product->price, 0) }}</td>
                                    <td class="px-8 py-6 font-black text-sm text-primary italic font-bold italic tracking-tighter uppercase italic">₹{{ number_format($product->discount_price ?? $product->price, 0) }}</td>
                                    <td class="px-8 py-6 text-right">
                                        <span class="px-2 py-1 rounded-md text-[8px] font-black uppercase {{ $product->status ? 'text-green-600 bg-green-50' : 'text-red-600 bg-red-50' }}">{{ $product->status ? 'Active' : 'Archived' }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="px-10 py-12 text-center text-gray-300 italic uppercase font-black text-[10px] tracking-widest">No masterpieces indexed in this artisan's dossier...</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

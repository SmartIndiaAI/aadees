@extends('layouts.admin')

@section('page_title', 'Artisan Oversight')

@section('content')
<div class="space-y-12 pb-24">
    <div class="flex items-center justify-between">
        <div class="space-y-2">
            <span class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400">Marketplace Management</span>
            <h1 class="text-4xl font-black text-gray-900 uppercase tracking-tighter italic">Artisan <span class="text-primary italic">Oversight</span></h1>
        </div>
    </div>

    <div class="bg-white rounded-[48px] border border-gray-100 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left font-sans">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-10 py-6 text-[10px] font-black uppercase tracking-widest text-gray-400">Artisan Identity</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-gray-400">Contact Node</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-gray-400">KYC Status</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-gray-400">Yield Share</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-gray-400 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($vendors as $vendor)
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="px-10 py-6">
                                <div class="flex items-center space-x-4">
                                    <div class="h-10 w-10 rounded-xl bg-primary/5 flex items-center justify-center text-primary font-black shadow-sm">
                                        {{ substr($vendor->shop_name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h5 class="text-sm font-black text-gray-900">{{ $vendor->shop_name }}</h5>
                                        <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest italic">Since {{ $vendor->created_at->format('M Y') }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-xs font-bold text-gray-600 uppercase">{{ $vendor->email }}</p>
                                <p class="text-[10px] text-gray-400">{{ $vendor->phone }}</p>
                            </td>
                            <td class="px-8 py-6">
                                <span class="px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-widest 
                                    {{ $vendor->razorpay_account_status === 'active' ? 'bg-green-50 text-green-600' : 'bg-orange-50 text-orange-600' }}">
                                    {{ $vendor->razorpay_account_status ?? 'PENDING' }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-sm font-black text-primary">
                                {{ $vendor->commission_percentage }}%
                            </td>
                            <td class="px-8 py-6 text-right">
                                <a href="{{ route('admin.vendors.show', $vendor->id) }}" class="inline-flex items-center justify-center h-8 w-8 rounded-lg bg-gray-50 text-gray-400 hover:bg-primary hover:text-white transition-all shadow-sm">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-10 py-24 text-center text-gray-300 italic uppercase font-black text-[10px] tracking-widest">No marketplace partners registered in the digital portfolio...</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-8 border-t border-gray-100 bg-gray-50/30">
            {{ $vendors->links() }}
        </div>
    </div>
</div>
@endsection

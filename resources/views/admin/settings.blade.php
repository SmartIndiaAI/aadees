@extends('layouts.admin')

@section('page_title', 'System Logistics')

@section('content')
<div class="space-y-12 pb-24">
    <div class="flex items-center justify-between">
        <div class="space-y-2">
            <span class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400">Digital Configuration</span>
            <h1 class="text-4xl font-black text-gray-900 uppercase tracking-tighter italic">Platform <span class="text-primary italic">Variables</span></h1>
        </div>
    </div>

    @if(session('status'))
        <div class="bg-emerald-50 border border-emerald-100 text-emerald-600 px-8 py-4 rounded-3xl text-[10px] font-black uppercase tracking-widest animate-pulse">
            {{ session('status') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <div class="lg:col-span-2 space-y-12">
            @foreach($settings as $group => $items)
                <div class="bg-white rounded-[48px] p-12 border border-gray-100 shadow-sm space-y-10">
                    <h3 class="text-xs font-black uppercase tracking-[0.4em] text-primary border-b border-gray-50 pb-6 mb-10 italic">{{ $group }}</h3>
                    <div class="space-y-10">
                        @foreach($items as $setting)
                            <div class="space-y-4">
                                <label class="text-[10px] font-black uppercase tracking-widest text-gray-300 ml-4">{{ str_replace(['site_', 'contact_', 'social_', '_content'], '', $setting->key) }}</label>
                                
                                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                    @csrf
                                    <input type="hidden" name="key" value="{{ $setting->key }}">
                                    
                                    <div class="flex items-start gap-4">
                                        @if($setting->key === 'site_logo')
                                            <div class="shrink-0 h-16 w-16 rounded-2xl bg-gray-50 border border-gray-100 flex items-center justify-center overflow-hidden">
                                                <img src="{{ str_starts_with($setting->value, 'settings/') ? asset('storage/' . $setting->value) : asset($setting->value) }}" class="h-10 w-auto">
                                            </div>
                                            <div class="flex-grow">
                                                <input type="file" name="value" class="hidden" id="file-{{ $setting->id }}" onchange="this.form.submit()">
                                                <button type="button" onclick="document.getElementById('file-{{ $setting->id }}').click()" 
                                                        class="w-full bg-gray-50 hover:bg-primary hover:text-white transition-all rounded-2xl px-6 py-4 text-[10px] font-black uppercase tracking-widest text-gray-400">
                                                    Upload New Intelligence
                                                </button>
                                            </div>
                                        @elseif(str_ends_with($setting->key, '_content'))
                                            <textarea name="value" id="input-{{ $setting->id }}" rows="4"
                                                   class="flex-grow bg-gray-50 border-none rounded-3xl px-8 py-6 text-xs font-bold tracking-wide outline-none focus:ring-2 focus:ring-primary shadow-inner text-gray-900 transition-all resize-none" readonly>{{ $setting->value }}</textarea>
                                        @else
                                            <input type="text" name="value" value="{{ $setting->value }}" id="input-{{ $setting->id }}" 
                                                   class="flex-grow bg-gray-50 border-none rounded-2xl px-6 py-4 text-xs font-black uppercase tracking-widest outline-none focus:ring-2 focus:ring-primary shadow-inner text-gray-900 transition-all" readonly>
                                        @endif

                                        @if($setting->key !== 'site_logo')
                                            <div class="flex gap-2">
                                                <button type="button" onclick="toggleEdit('{{ $setting->id }}')" id="btn-edit-{{ $setting->id }}"
                                                        class="h-12 w-12 rounded-2xl bg-gray-50 text-gray-400 hover:bg-primary hover:text-white transition-all shadow-sm flex items-center justify-center">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                                </button>

                                                <button type="submit" id="btn-save-{{ $setting->id }}"
                                                        class="hidden h-12 w-12 rounded-2xl bg-accent text-white hover:scale-110 active:scale-95 transition-all shadow-xl flex items-center justify-center border-none">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <div class="space-y-8">
            <div class="bg-gray-900 rounded-[48px] p-12 text-white space-y-10 relative overflow-hidden group">
                <div class="absolute -top-12 -right-12 h-32 w-32 bg-primary rounded-full blur-3xl opacity-20"></div>
                <h3 class="text-xs font-black uppercase tracking-[0.4em] text-primary italic">Platform Integrity</h3>
                <p class="text-[10px] text-gray-400 leading-relaxed font-bold uppercase tracking-widest">These variables control the marketplace's fundamental logic—including payment identifiers and visual themes. Modifying these parameters will instantly alter the digital infrastructure across all user and artisan profiles.</p>
                <div class="p-8 bg-white/5 backdrop-blur-sm rounded-3xl border border-white/5 italic space-y-4 shadow-sm text-primary">
                    <p>"Structure is the foundation of digital excellence."</p>
                    <p class="text-[9px] font-black uppercase tracking-widest text-gray-500 not-italic">— Executive Operation Code</p>
                </div>
            </div>

            <div class="bg-white rounded-[40px] p-10 border border-gray-100 shadow-sm space-y-6">
                <h4 class="text-[10px] font-black uppercase tracking-widest text-red-500 italic">Payment Split Requirements</h4>
                <div class="space-y-4">
                    <div class="space-y-1">
                        <p class="text-[9px] font-black uppercase tracking-widest text-gray-900">1. Admin Account</p>
                        <p class="text-[8px] font-bold text-gray-400 leading-relaxed uppercase">Razorpay "Route" must be enabled in your primary dashboard to split funds.</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[9px] font-black uppercase tracking-widest text-gray-900">2. Vendor KYC</p>
                        <p class="text-[8px] font-bold text-gray-400 leading-relaxed uppercase">Instant split ONLY works for vendors with "Active" KYC status. Check Vendor Management for status.</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[9px] font-black uppercase tracking-widest text-gray-900">3. API Credentials</p>
                        <p class="text-[8px] font-bold text-gray-400 leading-relaxed uppercase">Ensure "razorpay_key" and "razorpay_secret" are correct and have "Route" permissions.</p>
                    </div>
                </div>
            </div>

            <div class="bg-primary/5 rounded-[48px] p-12 border border-primary/10 space-y-6">
                <h4 class="text-[10px] font-black uppercase tracking-widest text-primary">System Status</h4>
                <div class="flex items-center gap-4">
                    <div class="h-2 w-2 rounded-full bg-emerald-500 animate-ping"></div>
                    <span class="text-[9px] font-black uppercase tracking-[0.2em] text-gray-600">All Modules Operational</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function toggleEdit(id) {
        const input = document.getElementById('input-' + id);
        const editBtn = document.getElementById('btn-edit-' + id);
        const saveBtn = document.getElementById('btn-save-' + id);

        if (input.hasAttribute('readonly')) {
            input.removeAttribute('readonly');
            input.classList.remove('bg-gray-50');
            input.classList.add('bg-white', 'ring-2', 'ring-primary/20');
            input.focus();
            editBtn.classList.add('hidden');
            saveBtn.classList.remove('hidden');
        }
    }
</script>
@endpush

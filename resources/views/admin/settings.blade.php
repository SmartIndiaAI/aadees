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

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <div class="bg-white rounded-[48px] p-12 border border-gray-100 shadow-sm space-y-10">
            <h3 class="text-xs font-black uppercase tracking-[0.4em] text-primary border-b border-gray-50 pb-6 mb-10 italic">Core Parameters</h3>
            <div class="space-y-8">
                @forelse($settings as $setting)
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-300 ml-4">{{ str_replace('_', ' ', $setting->key) }}</label>
                        <form action="{{ route('admin.settings.update') }}" method="POST" class="flex items-center space-x-4">
                            @csrf
                            <input type="hidden" name="key" value="{{ $setting->key }}">
                            <input type="text" name="value" value="{{ $setting->value }}" id="input-{{ $setting->id }}" 
                                   class="flex-grow bg-gray-50 border-none rounded-2xl px-6 py-4 text-xs font-black uppercase tracking-widest outline-none focus:ring-2 focus:ring-primary shadow-inner text-gray-900 transition-all" readonly>
                            
                            <button type="button" onclick="toggleEdit('{{ $setting->id }}')" id="btn-edit-{{ $setting->id }}"
                                    class="h-12 w-12 rounded-2xl bg-gray-50 text-gray-400 hover:bg-primary hover:text-white transition-all shadow-sm flex items-center justify-center">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                            </button>

                            <button type="submit" id="btn-save-{{ $setting->id }}"
                                    class="hidden h-12 w-12 rounded-2xl bg-accent text-white hover:scale-110 active:scale-95 transition-all shadow-xl flex items-center justify-center border-none">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </button>
                        </form>
                    </div>
                @empty
                    <p class="text-xs text-gray-300 italic uppercase font-black tracking-widest">No digital parameters indexed in the current cycle...</p>
                @endforelse
            </div>
        </div>

        <div class="bg-gray-50 rounded-[48px] p-12 border border-gray-100 shadow-sm space-y-10 relative overflow-hidden group">
            <div class="absolute -top-12 -right-12 h-32 w-32 bg-primary rounded-full blur-3xl opacity-5 transition-transform duration-700 group-hover:scale-150"></div>
            <h3 class="text-xs font-black uppercase tracking-[0.4em] text-gray-400 border-b border-gray-100 pb-6 mb-10 italic">Platform Integrity</h3>
            <p class="text-xs text-gray-400 leading-relaxed font-bold uppercase tracking-widest">These variables control the marketplace's fundamental logic—including payment identifiers and visual themes. Modifying these parameters will instantly alter the digital infrastructure across all user and artisan profiles.</p>
            <div class="p-8 bg-white/50 backdrop-blur-sm rounded-3xl border border-white italic space-y-4 shadow-sm text-primary">
                <p>"Structure is the foundation of digital excellence."</p>
                <p class="text-[9px] font-black uppercase tracking-widest text-gray-400 not-italic">— Executive Operation Code</p>
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

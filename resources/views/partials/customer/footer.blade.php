<footer class="bg-white border-t border-gray-100 pt-40 pb-10">
    <!-- Category Marquee -->
    <div class="relative overflow-hidden bg-[#291030] py-5 -mt-40 border-y border-white/5">
        <div class="flex animate-marquee whitespace-nowrap items-center gap-2">
            @php $allCats = \App\Models\Category::whereNull('parent_id')->get(); @endphp
            @for ($i = 0; $i < 10; $i++)
                @foreach($allCats as $cat)
                    <div class="flex items-center shrink-0">
                        <a href="{{ route('category.show', $cat->slug) }}" class="text-[10px] font-black uppercase tracking-[0.4em] text-white/40 hover:text-accent transition-colors italic whitespace-nowrap">
                            {{ $cat->name }}
                        </a>
                        <span class="text-accent/30 text-xs px-6">✦</span>
                    </div>
                @endforeach
            @endfor
        </div>
    </div>

    <style>
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .animate-marquee {
            display: inline-flex;
            animation: marquee 40s linear infinite;
        }
    </style>

    <div class="max-w-7xl mx-auto px-4 lg:px-8 grid grid-cols-2 md:grid-cols-4 gap-12 text-sm pt-10">
        <!-- Brand Column -->
        <div class="space-y-6">
            <div class="flex items-center gap-3">
                <img src="{{ $siteLogo }}" class="h-10 w-auto rounded-lg shadow-sm" alt="{{ $siteName }}">
            </div>
            <p class="text-gray-400 font-medium leading-relaxed uppercase tracking-widest text-[10px]">
                {{ \App\Models\Setting::getValue('site_description', 'Premium multi-vendor marketplace curated for quality, style, and performance.') }}
            </p>
        </div>

        <!-- Quick Links -->
        <div>
            <h4 class="font-black text-primary mb-6 uppercase tracking-widest text-[11px]">Quick Links</h4>
            <div class="flex flex-col gap-4 text-gray-500 font-bold uppercase tracking-widest text-[10px]">
                <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Home</a>
                <a href="{{ route('products.index') }}" class="hover:text-primary transition-colors">Shop All</a>
                @php $cats = \App\Models\Category::whereNull('parent_id')->take(3)->get(); @endphp
                @foreach($cats as $c)
                    <a href="{{ route('category.show', $c->slug) }}" class="hover:text-primary transition-colors">{{ $c->name }}</a>
                @endforeach
            </div>
        </div>

        <!-- Support -->
        <div>
            <h4 class="font-black text-primary mb-6 uppercase tracking-widest text-[11px]">Support</h4>
            <div class="flex flex-col gap-4 text-gray-500 font-bold uppercase tracking-widest text-[10px]">
                <a href="{{ route('pages.show', 'about-us') }}" class="hover:text-primary transition-colors">About Us</a>
                <a href="{{ route('pages.show', 'shipping-info') }}" class="hover:text-primary transition-colors">Returns & Shipping</a>
                <a href="{{ route('pages.show', 'terms-of-service') }}" class="hover:text-primary transition-colors">Terms of Service</a>
                <a href="{{ route('pages.show', 'privacy-policy') }}" class="hover:text-primary transition-colors">Privacy Policy</a>
            </div>
        </div>

        <!-- Follow -->
        <div>
            <h4 class="font-black text-primary mb-6 uppercase tracking-widest text-[11px]">Follow Us</h4>
            <div class="flex flex-col gap-4 text-gray-500 font-bold uppercase tracking-widest text-[10px]">
                @if($socialLinks['instagram']) <a href="{{ $socialLinks['instagram'] }}" class="hover:text-primary transition-colors">Instagram</a> @endif
                @if($socialLinks['facebook']) <a href="{{ $socialLinks['facebook'] }}" class="hover:text-primary transition-colors">Facebook</a> @endif
                @if($socialLinks['twitter']) <a href="{{ $socialLinks['twitter'] }}" class="hover:text-primary transition-colors">Twitter</a> @endif
                @if($socialLinks['pinterest']) <a href="{{ $socialLinks['pinterest'] }}" class="hover:text-primary transition-colors">Pinterest</a> @endif
            </div>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="max-w-7xl mx-auto px-4 lg:px-8 mt-20 pt-8 border-t border-gray-50 flex flex-col md:flex-row justify-between items-center gap-4">
        <p class="text-[10px] font-black uppercase tracking-widest text-gray-300">© {{ date('Y') }} {{ $siteName }} MARKETPLACE. OPTIMIZED FOR QUALITY.</p>
        <div class="flex gap-8 opacity-40 grayscale contrast-125">
            <span class="text-[9px] font-black tracking-[0.5em] text-gray-500">RAZORPAY SECURE</span>
            <span class="text-[9px] font-black tracking-[0.5em] text-gray-500">ISO CERTIFIED</span>
        </div>
    </div>
</footer>

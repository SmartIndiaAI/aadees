@extends('layouts.app')

@section('page_title', 'Secure Checkout')

@section('content')
<div class="bg-gray-50 min-h-screen pb-32">
    <!-- Header -->
    <div class="bg-white border-b border-gray-100">
        <div class="container mx-auto px-4 lg:px-8 py-10 flex items-center justify-between">
            <div class="flex items-center space-x-6">
                <a href="{{ route('cart') }}" class="p-3 rounded-full hover:bg-gray-50 text-gray-400 hover:text-primary transition-all">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </a>
                <h1 class="text-3xl font-black tracking-tighter text-gray-900 uppercase">Secure <span class="text-primary italic">Checkout</span></h1>
            </div>
            <div class="hidden md:flex items-center space-x-8 opacity-40">
                <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">SSL ENCRYPTED</span>
                <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">RAZORPAY PARTNER</span>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 lg:px-8 py-16">
        <form id="checkout-form" action="{{ route('checkout.process') }}" method="POST" class="flex flex-col xl:flex-row gap-16">
            @csrf
            <!-- Left Side: Delivery Details -->
            <div class="flex-1 space-y-12">
                <section class="p-10 rounded-[48px] bg-white shadow-sm border border-gray-100 space-y-10">
                    <div class="flex items-center space-x-4">
                        <div class="h-10 w-10 rounded-xl bg-primary flex items-center justify-center text-secondary font-black">1</div>
                        <h3 class="text-xl font-black uppercase tracking-widest text-gray-900">Delivery Information <span class="text-xs text-primary low-case italic opacity-50 ml-2">(Mandatory Selection)</span></h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-10">
                        <div class="space-y-2">
                             <label class="text-[9px] font-black uppercase tracking-widest text-gray-400 ml-4">Recipient Name <span class="text-red-400">*</span></label>
                             <input type="text" name="name" value="{{ auth()->user()->name ?? '' }}" required class="w-full h-12 bg-gray-50 border-none rounded-2xl px-6 text-xs font-bold focus:ring-1 focus:ring-primary transition-all">
                        </div>
                        <div class="space-y-2">
                             <label class="text-[9px] font-black uppercase tracking-widest text-gray-400 ml-4">Contact Protocol <span class="text-red-400">*</span></label>
                             <input type="tel" name="phone" placeholder="+91 XXXX-XXXXXX" required class="w-full h-12 bg-gray-50 border-none rounded-2xl px-6 text-xs font-bold focus:ring-1 focus:ring-primary transition-all">
                        </div>
                        <div class="col-span-full space-y-2">
                             <label class="text-[9px] font-black uppercase tracking-widest text-gray-400 ml-4">Street Address/Establishment <span class="text-red-400">*</span></label>
                             <input type="text" name="address" required class="w-full h-12 bg-gray-50 border-none rounded-2xl px-6 text-xs font-bold focus:ring-1 focus:ring-primary transition-all">
                        </div>
                        <div class="space-y-2">
                             <label class="text-[9px] font-black uppercase tracking-widest text-gray-400 ml-4">City/District <span class="text-red-400">*</span></label>
                             <input type="text" name="city" required class="w-full h-12 bg-gray-50 border-none rounded-2xl px-6 text-xs font-bold focus:ring-1 focus:ring-primary transition-all">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="text-[9px] font-black uppercase tracking-widest text-gray-400 ml-4">State <span class="text-red-400">*</span></label>
                                <input type="text" name="state" required class="w-full h-12 bg-gray-50 border-none rounded-2xl px-6 text-xs font-bold focus:ring-1 focus:ring-primary transition-all">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[9px] font-black uppercase tracking-widest text-gray-400 ml-4">ZIP/PIN <span class="text-red-400">*</span></label>
                                <input type="text" name="zip" required class="w-full h-12 bg-gray-50 border-none rounded-2xl px-6 text-xs font-bold focus:ring-1 focus:ring-primary transition-all">
                            </div>
                        </div>
                    </div>
                </section>

                <section class="p-10 rounded-[48px] bg-white shadow-sm border border-gray-100 space-y-10">
                    <div class="flex items-center space-x-4">
                        <div class="h-10 w-10 rounded-xl bg-primary flex items-center justify-center text-secondary font-black">2</div>
                        <h3 class="text-xl font-black uppercase tracking-widest text-gray-900">Payment Selection</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <label class="relative flex items-center p-8 rounded-3xl border-2 border-primary bg-primary/5 cursor-pointer group">
                             <input type="radio" name="payment_method" value="razorpay" checked class="h-5 w-5 border-gray-200 text-primary focus:ring-0">
                             <div class="ml-6 uppercase tracking-widest font-black text-gray-900 text-xs">Razorpay</div>
                             <div class="ml-auto opacity-40"><svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15l-5-5 1.41-1.41L11 14.17l7.59-7.59L20 8l-9 9z"/></svg></div>
                        </label>
                        <label class="relative flex items-center p-8 rounded-3xl border-2 border-gray-50 hover:border-gray-100 cursor-pointer group transition-all">
                             <input type="radio" name="payment_method" value="cod" class="h-5 w-5 border-gray-200 text-primary">
                             <div class="ml-6 uppercase tracking-widest font-black text-gray-400 group-hover:text-gray-900 text-xs">Cash on Delivery</div>
                        </label>
                    </div>
                </section>
            </div>

            <!-- Right: Order Review -->
            <aside class="w-full xl:w-[450px] space-y-10">
                <div class="p-10 rounded-[48px] bg-white shadow-xl border border-gray-100 space-y-10">
                    <h4 class="text-xl font-black uppercase tracking-widest text-gray-900 border-b border-gray-50 pb-6">Basket <span class="text-primary italic">Review</span></h4>
                    <div class="space-y-6 max-h-[300px] overflow-y-auto no-scrollbar pr-2">
                        @foreach($cart as $key => $item)
                            <div class="flex items-center space-x-4 group">
                                <div class="h-16 w-16 rounded-xl bg-gray-50 border border-gray-50 overflow-hidden shrink-0">
                                    <img src="{{ $item['image'] ?? asset('placeholder.png') }}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-grow space-y-1">
                                    <div class="flex items-center justify-between">
                                        <h4 class="text-xs font-black text-gray-900 uppercase tracking-tight italic">{{ $item['name'] }}</h4>
                                        <a href="{{ route('cart.remove', $key) }}" class="p-2 rounded-lg text-gray-300 hover:text-red-500 hover:bg-red-50 transition-all" title="Remove Acquisition">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </a>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Qty: {{ $item['quantity'] }}</span>
                                        <span class="text-xs font-black text-primary italic">₹{{ number_format($item['price'], 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="space-y-4 pt-10 border-t border-gray-50">
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Order Subtotal</span>
                            <span class="text-xs font-black italic">₹{{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Tax Estimation</span>
                            <span class="text-xs font-black italic">₹0.00</span>
                        </div>
                        <div class="flex items-center justify-between py-6 border-y border-gray-50">
                            <span class="text-xl font-black uppercase tracking-widest text-gray-900">Grand Total</span>
                            <span class="text-2xl font-black italic text-primary">₹{{ number_format($total + $shipping, 2) }}</span>
                        </div>
                    </div>
                    <button type="button" onclick="triggerPaymentFlow()" class="w-full btn-premium bg-primary text-white h-16 shadow-[0_25px_50px_-12px_rgba(41,16,48,0.25)]">Complete Transaction</button>
                    <p class="text-[9px] font-bold uppercase tracking-widest text-center text-gray-400 italic">By completing this secure transaction, you agree to the conditions of artisan delivery.</p>
                </div>
            </aside>
        </form>
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    function triggerPaymentFlow() {
        // 1. Basic Form Validation
        const form = document.getElementById('checkout-form');
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('ring-2', 'ring-rose-500/20');
                isValid = false;
            } else {
                field.classList.remove('ring-2', 'ring-rose-500/20');
            }
        });

        if (!isValid) {
            alert('Please provide all mandatory delivery protocols.');
            return;
        }

        const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;

        if (paymentMethod === 'razorpay') {
            // Launch Razorpay Protocol
            const options = {
                "key": "{{ \App\Models\Setting::where('key', 'razorpay_key')->first()->value ?? 'rzp_test_placeholder' }}",
                "amount": "{{ ($total + $shipping) * 100 }}",
                "currency": "INR",
                "name": "AADEES COLLECTIONS",
                "description": "Premium Marketplace Acquisition",
                "image": "{{ asset('logo.jpeg') }}",
                "handler": function (response) {
                    // Inject Payment ID and Submit
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'razorpay_payment_id';
                    input.value = response.razorpay_payment_id;
                    form.appendChild(input);
                    form.submit();
                },
                "prefill": {
                    "name": document.getElementsByName('name')[0].value,
                    "email": "{{ auth()->user()->email }}",
                    "contact": document.getElementsByName('phone')[0].value
                },
                "theme": {
                    "color": "#291030"
                },
                "modal": {
                    "ondismiss": function() {
                        console.log('Payment Protocol Cancelled');
                    }
                }
            };
            
            const rzp = new Razorpay(options);
            rzp.on('payment.failed', function (response) {
                alert("Transaction Protocol Interrupted: " + response.error.description);
            });
            rzp.open();
        } else {
            // Proceed with COD Protocol
            form.submit();
        }
    }

    // Toggle styling for radio labels
    document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
        radio.addEventListener('change', (e) => {
            document.querySelectorAll('input[name="payment_method"]').forEach(r => {
                const parent = r.closest('label');
                parent.classList.remove('border-primary', 'bg-primary/5');
                parent.classList.add('border-gray-50');
                parent.querySelector('div').classList.remove('text-gray-900');
                parent.querySelector('div').classList.add('text-gray-400');
            });
            
            const selectedParent = e.target.closest('label');
            selectedParent.classList.add('border-primary', 'bg-primary/5');
            selectedParent.classList.remove('border-gray-50');
            selectedParent.querySelector('div').classList.add('text-gray-900');
            selectedParent.querySelector('div').classList.remove('text-gray-400');
        });
    });
</script>
@endsection

<x-layouts.frontend>
    <x-slot:title>
        Refund Policy | NatureTrail POJ
    </x-slot:title>

    <div class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 opacity-30">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-brand-tiger rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float"></div>
            <div class="absolute top-64 -left-24 w-72 h-72 bg-brand-green rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float" style="animation-delay: 2s;"></div>
        </div>

        <div class="container mx-auto px-6 max-w-4xl">
            <div class="text-center mb-16">
                <h1 class="font-display font-black text-4xl md:text-5xl text-brand-dark uppercase tracking-tight mb-4">
                    Refund <span class="text-brand-tiger">Policy</span>
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Thank you for registering for an event with <span class="font-bold text-brand-green">NatureTrail POJ</span>. We value your participation and want to ensure complete transparency regarding our event registration and cancellation process.
                </p>
            </div>

            <div class="space-y-4" x-data="{ activeAccordion: 1 }">
                
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-md">
                    <button @click="activeAccordion = activeAccordion === 1 ? null : 1" 
                            class="w-full px-8 py-6 text-left flex justify-between items-center focus:outline-none">
                        <h3 class="font-display font-bold text-xl text-brand-dark" :class="activeAccordion === 1 ? 'text-brand-tiger' : ''">
                            1. The 24-Hour Refund Window
                        </h3>
                        <svg class="w-6 h-6 transform transition-transform duration-300 text-brand-tiger" 
                             :class="activeAccordion === 1 ? 'rotate-180' : ''" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="activeAccordion === 1" x-collapse x-cloak>
                        <div class="px-8 pb-6 text-gray-600 space-y-3 border-t border-gray-50 pt-4">
                            <p>Because event planning requires finalizing logistics, venue capacities, and participant materials well in advance, we operate under a strict time-based refund policy.</p>
                            <ul class="list-disc pl-5 space-y-2">
                                <li><strong class="text-brand-dark">Eligible:</strong> Refund requests must be submitted within exactly <strong class="text-brand-tiger">24 hours</strong> of your successful registration and payment.</li>
                                <li><strong class="text-brand-dark">Not Eligible:</strong> Requests made after the 24-hour window has passed are strictly non-refundable. Additionally, registrations made within 48 hours of the event's start time are final and not eligible for the 24-hour refund window.</li>
                                <li>Tickets are non-transferable to other individuals unless explicitly stated in the specific event guidelines.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-md">
                    <button @click="activeAccordion = activeAccordion === 2 ? null : 2" 
                            class="w-full px-8 py-6 text-left flex justify-between items-center focus:outline-none">
                        <h3 class="font-display font-bold text-xl text-brand-dark" :class="activeAccordion === 2 ? 'text-brand-tiger' : ''">
                            2. How to Request a Refund
                        </h3>
                        <svg class="w-6 h-6 transform transition-transform duration-300 text-brand-tiger" 
                             :class="activeAccordion === 2 ? 'rotate-180' : ''" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="activeAccordion === 2" x-collapse x-cloak>
                        <div class="px-8 pb-6 text-gray-600 space-y-3 border-t border-gray-50 pt-4">
                            <p>To initiate a cancellation and refund within your 24-hour window, please contact our support team immediately.</p>
                            <div class="bg-brand-cream p-4 rounded-lg border border-brand-sand mt-3">
                                <p class="font-medium text-brand-dark mb-1">Email us at: <a href="mailto:info@naturetrailpojf.org" class="text-brand-tiger hover:underline">info@naturetrailpojf.org</a></p>
                                <p class="text-sm">You <strong class="text-brand-dark">must</strong> include your Event Name, Registration ID, and the Phone Number/Email used during checkout.</p>
                            </div>
                            <p>Our team will review your timestamped request and notify you of the approval or rejection of your refund based on the 24-hour rule.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-md">
                    <button @click="activeAccordion = activeAccordion === 3 ? null : 3" 
                            class="w-full px-8 py-6 text-left flex justify-between items-center focus:outline-none">
                        <h3 class="font-display font-bold text-xl text-brand-dark" :class="activeAccordion === 3 ? 'text-brand-tiger' : ''">
                            3. Refund Processing Time
                        </h3>
                        <svg class="w-6 h-6 transform transition-transform duration-300 text-brand-tiger" 
                             :class="activeAccordion === 3 ? 'rotate-180' : ''" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="activeAccordion === 3" x-collapse x-cloak>
                        <div class="px-8 pb-6 text-gray-600 space-y-3 border-t border-gray-50 pt-4">
                            <p>If approved, your refund will be processed, and a credit will automatically be applied to your original method of payment (Card, Mobile Financial Service, or Bank Account).</p>
                            <p>Please allow <strong class="text-brand-dark">5 to 7 working days</strong> for the funds to appear in your account after initiation.</p>
                            <p class="text-sm italic mt-2 text-gray-500">If you haven’t received a refund within the specified timeframe, please double-check your bank/MFS account and contact your issuer. If the issue persists, reach out to us at info@naturetrailpojf.org.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-md">
                    <button @click="activeAccordion = activeAccordion === 4 ? null : 4" 
                            class="w-full px-8 py-6 text-left flex justify-between items-center focus:outline-none">
                        <h3 class="font-display font-bold text-xl text-brand-dark" :class="activeAccordion === 4 ? 'text-brand-tiger' : ''">
                            4. Policy Modifications
                        </h3>
                        <svg class="w-6 h-6 transform transition-transform duration-300 text-brand-tiger" 
                             :class="activeAccordion === 4 ? 'rotate-180' : ''" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="activeAccordion === 4" x-collapse x-cloak>
                        <div class="px-8 pb-6 text-gray-600 space-y-3 border-t border-gray-50 pt-4">
                            <p>We reserve the right to modify this refund policy at any time. Changes and clarifications will take effect immediately upon posting on the NatureTrail POJ website.</p>
                            <p>By registering for our events, you agree to and accept the terms of this policy.</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="mt-12 bg-brand-dark rounded-2xl p-8 text-center shadow-xl relative overflow-hidden">
                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
                <div class="relative z-10">
                    <h4 class="text-white font-display font-bold text-2xl mb-3">Need to cancel your registration?</h4>
                    <p class="text-gray-300 mb-6 max-w-lg mx-auto">If you are within your 24-hour window, our team is ready to assist you with a hassle-free refund process.</p>
                    <a href="mailto:info@naturetrailpojf.org" class="inline-block bg-brand-tiger text-white px-8 py-3 rounded-full font-bold hover:bg-orange-500 transition shadow-[0_0_15px_rgba(249,115,22,0.4)] transform hover:-translate-y-0.5">
                        Contact Support Now
                    </a>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <style>
            [x-cloak] { display: none !important; }
        </style>
    @endpush
</x-layouts.frontend>
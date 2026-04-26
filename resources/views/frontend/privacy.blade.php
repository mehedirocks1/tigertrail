<x-layouts.frontend>
    <x-slot:title>
        Privacy Policy | NatureTrail POJ
    </x-slot:title>

    <div class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 opacity-30">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-brand-green rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float"></div>
            <div class="absolute top-64 -left-24 w-72 h-72 bg-brand-tiger rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float" style="animation-delay: 2s;"></div>
        </div>

        <div class="container mx-auto px-6 max-w-4xl">
            <div class="text-center mb-16">
                <h1 class="font-display font-black text-4xl md:text-5xl text-brand-dark uppercase tracking-tight mb-4">
                    Privacy <span class="text-brand-tiger">Policy</span>
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    This Privacy Policy describes how <span class="font-bold text-brand-green">NatureTrail POJ</span> ("we," "us," or "our") collects, uses, shares, and protects the information obtained from users ("you" or "your") of the Tiger Trail event registration platform.
                </p>
                <p class="text-sm text-gray-400 mt-4">Last Updated: April 26, 2026</p>
            </div>

            <div class="space-y-4" x-data="{ activeAccordion: 1 }">
                
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-md">
                    <button @click="activeAccordion = activeAccordion === 1 ? null : 1" 
                            class="w-full px-8 py-6 text-left flex justify-between items-center focus:outline-none">
                        <h3 class="font-display font-bold text-xl text-brand-dark" :class="activeAccordion === 1 ? 'text-brand-tiger' : ''">
                            1. Information We Collect
                        </h3>
                        <svg class="w-6 h-6 transform transition-transform duration-300 text-brand-tiger" 
                             :class="activeAccordion === 1 ? 'rotate-180' : ''" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="activeAccordion === 1" x-collapse x-cloak>
                        <div class="px-8 pb-6 text-gray-600 space-y-3 border-t border-gray-50 pt-4">
                            <p>To safely and effectively manage our events, we collect specific personal information when you register, create an account, or contact us. This includes:</p>
                            <ul class="list-disc pl-5 space-y-2">
                                <li><strong class="text-brand-dark">Identity & Contact:</strong> Full name, email address, mailing address, and mobile phone number (used for SMS notifications).</li>
                                <li><strong class="text-brand-dark">Event Logistics:</strong> Demographic data (age/gender for race categories), t-shirt size, blood group, and emergency contact details.</li>
                                <li><strong class="text-brand-dark">Transaction Data:</strong> Payment details (processed securely via our payment gateway).</li>
                                <li><strong class="text-brand-dark">Technical Data:</strong> Interaction metrics with our website through cookies and similar technologies.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-md">
                    <button @click="activeAccordion = activeAccordion === 2 ? null : 2" 
                            class="w-full px-8 py-6 text-left flex justify-between items-center focus:outline-none">
                        <h3 class="font-display font-bold text-xl text-brand-dark" :class="activeAccordion === 2 ? 'text-brand-tiger' : ''">
                            2. How We Use Your Information
                        </h3>
                        <svg class="w-6 h-6 transform transition-transform duration-300 text-brand-tiger" 
                             :class="activeAccordion === 2 ? 'rotate-180' : ''" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="activeAccordion === 2" x-collapse x-cloak>
                        <div class="px-8 pb-6 text-gray-600 space-y-3 border-t border-gray-50 pt-4">
                            <p>We use your information exclusively to ensure a smooth event experience. Purposes include:</p>
                            <ul class="list-disc pl-5 space-y-2">
                                <li>Processing event registrations, assigning Bib numbers, and managing payment transactions.</li>
                                <li>Sending automated SMS and email notifications regarding event updates, start times, and results.</li>
                                <li>Ensuring participant safety by having emergency contact and medical (blood group) information on hand during the event.</li>
                                <li>Improving our platform, products (like Race Kits), and customer services.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-md">
                    <button @click="activeAccordion = activeAccordion === 3 ? null : 3" 
                            class="w-full px-8 py-6 text-left flex justify-between items-center focus:outline-none">
                        <h3 class="font-display font-bold text-xl text-brand-dark" :class="activeAccordion === 3 ? 'text-brand-tiger' : ''">
                            3. Information Sharing & Data Security
                        </h3>
                        <svg class="w-6 h-6 transform transition-transform duration-300 text-brand-tiger" 
                             :class="activeAccordion === 3 ? 'rotate-180' : ''" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="activeAccordion === 3" x-collapse x-cloak>
                        <div class="px-8 pb-6 text-gray-600 space-y-3 border-t border-gray-50 pt-4">
                            <p><strong class="text-brand-dark">Sharing:</strong> We do not sell your data. We only share information with:</p>
                            <ul class="list-disc pl-5 space-y-1 mb-4">
                                <li>Service providers who assist us in operating our website (e.g., Payment Gateways, SMS gateways).</li>
                                <li>Law enforcement or government agencies when strictly required by law.</li>
                            </ul>
                            <p><strong class="text-brand-dark">Security:</strong> We implement appropriate security measures to protect your information within our database. However, please note that no method of transmission over the internet or electronic storage is 100% secure.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-md">
                    <button @click="activeAccordion = activeAccordion === 4 ? null : 4" 
                            class="w-full px-8 py-6 text-left flex justify-between items-center focus:outline-none">
                        <h3 class="font-display font-bold text-xl text-brand-dark" :class="activeAccordion === 4 ? 'text-brand-tiger' : ''">
                            4. Your Rights & Cookies
                        </h3>
                        <svg class="w-6 h-6 transform transition-transform duration-300 text-brand-tiger" 
                             :class="activeAccordion === 4 ? 'rotate-180' : ''" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="activeAccordion === 4" x-collapse x-cloak>
                        <div class="px-8 pb-6 text-gray-600 space-y-3 border-t border-gray-50 pt-4">
                            <p><strong class="text-brand-dark">Your Rights:</strong> You have the right to access, update, or request the deletion of your personal information. You may also opt-out of receiving promotional communications.</p>
                            <p><strong class="text-brand-dark">Cookies:</strong> Our website uses cookies and similar technologies to maintain your session and enhance your browsing experience. You can manage your cookie preferences through your browser settings.</p>
                            <p class="text-sm italic mt-2 text-gray-500">We reserve the right to modify this policy at any time. Changes take effect immediately upon posting.</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="mt-12 bg-brand-dark rounded-2xl p-8 text-center shadow-xl relative overflow-hidden">
                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
                <div class="relative z-10">
                    <h4 class="text-white font-display font-bold text-2xl mb-3">Questions about your privacy?</h4>
                    <p class="text-gray-300 mb-6 max-w-lg mx-auto">If you have any concerns or requests regarding this Privacy Policy or the handling of your personal information, please reach out to us.</p>
                    <a href="mailto:info@naturetrailpojf.org" class="inline-block bg-brand-tiger text-white px-8 py-3 rounded-full font-bold hover:bg-orange-500 transition shadow-[0_0_15px_rgba(249,115,22,0.4)] transform hover:-translate-y-0.5">
                        Contact Privacy Team
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
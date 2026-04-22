<x-layouts.frontend>
    <x-slot:title>Terms and Conditions | Nature Trail</x-slot:title>

    <style>
        html { scroll-behavior: smooth; }
        
        /* Custom scrollbar for sidebar */
        .toc-scrollbar::-webkit-scrollbar { width: 4px; }
        .toc-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .toc-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        
        .clause-card {
            transition: all 0.3s ease;
        }
        .clause-card:hover {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
            transform: translateY(-2px);
        }
    </style>

    <header class="bg-brand-green pt-32 pb-16 relative overflow-hidden">
        <div class="absolute inset-0 z-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'#ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <h4 class="text-brand-tiger font-bold uppercase tracking-[0.2em] mb-3 text-sm opacity-90">Legal & Policy</h4>
            <h1 class="font-display text-4xl md:text-5xl font-extrabold text-white mb-4">Terms and Conditions</h1>
            <p class="text-gray-300 text-lg max-w-2xl mx-auto font-light">Please read these rules and guidelines carefully before participating in the Event.</p>
        </div>
    </header>

    <section class="py-12 bg-[#F8FAFC] relative">
        <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-b from-gray-100 to-transparent"></div>
        
        <div class="container mx-auto px-6 max-w-6xl relative z-10 flex flex-col md:flex-row gap-10">
            
            <aside class="w-full md:w-1/4 hidden md:block">
                <div class="sticky top-28 bg-white p-6 rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 toc-scrollbar max-h-[80vh] overflow-y-auto">
                    <h3 class="font-bold text-gray-900 mb-4 uppercase tracking-wider text-sm border-b pb-3">Table of Contents</h3>
                    <ul class="space-y-3 text-sm font-medium text-gray-500">
                        <li><a href="#acceptance" class="hover:text-brand-tiger transition-colors block">1. Acceptance of Terms</a></li>
                        <li><a href="#eligibility" class="hover:text-brand-tiger transition-colors block">2. Registration & Eligibility</a></li>
                        <li><a href="#health-waiver" class="hover:text-brand-tiger transition-colors block">3. Health & Liability Waiver</a></li>
                        <li><a href="#payments" class="hover:text-brand-tiger transition-colors block">4. Payments & Refunds</a></li>
                        <li><a href="#rules" class="hover:text-brand-tiger transition-colors block">5. Race Rules & Conduct</a></li>
                        <li><a href="#media" class="hover:text-brand-tiger transition-colors block">6. Media & Photography</a></li>
                        <li><a href="#privacy" class="hover:text-brand-tiger transition-colors block">7. Privacy & Data</a></li>
                    </ul>
                    <div class="mt-8 pt-6 border-t border-gray-100">
                        <p class="text-xs text-gray-400 mb-2">Last Updated</p>
                        <p class="text-sm font-bold text-gray-700">April 2026</p>
                    </div>
                </div>
            </aside>

            <main class="w-full md:w-3/4 space-y-6">
                
                <div id="acceptance" class="clause-card bg-white p-8 rounded-2xl border border-gray-100 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1.5 h-full bg-brand-green opacity-80"></div>
                    <div class="flex items-center gap-4 mb-4">
                        <span class="w-8 h-8 rounded-full bg-brand-green/10 text-brand-green font-bold flex items-center justify-center">1</span>
                        <h2 class="text-xl font-extrabold text-gray-900">Acceptance of Terms</h2>
                    </div>
                    <p class="text-gray-600 leading-relaxed pl-12">
By registering for and participating in the event (hereinafter referred to as the "Event") hosted by the respective event organizer (hereinafter referred to as the "Organizer"), you agree to abide by these Terms and Conditions. If you do not agree to these terms, please do not proceed with the registration.                    </p>
                </div>

                <div id="eligibility" class="clause-card bg-white p-8 rounded-2xl border border-gray-100 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1.5 h-full bg-brand-tiger opacity-80"></div>
                    <div class="flex items-center gap-4 mb-4">
                        <span class="w-8 h-8 rounded-full bg-brand-tiger/10 text-brand-tiger font-bold flex items-center justify-center">2</span>
                        <h2 class="text-xl font-extrabold text-gray-900">Registration and Eligibility</h2>
                    </div>
                    <ul class="list-none space-y-3 text-gray-600 pl-12">
                        <li class="relative pl-5 before:content-[''] before:absolute before:left-0 before:top-2 before:w-1.5 before:h-1.5 before:bg-gray-400 before:rounded-full">Registrations are strictly personal, non-transferable, and cannot be deferred to future events.</li>
                        <li class="relative pl-5 before:content-[''] before:absolute before:left-0 before:top-2 before:w-1.5 before:h-1.5 before:bg-gray-400 before:rounded-full">Participants must meet the minimum age requirements specified for their respective race categories.</li>
                        <li class="relative pl-5 before:content-[''] before:absolute before:left-0 before:top-2 before:w-1.5 before:h-1.5 before:bg-gray-400 before:rounded-full">The Organizer reserves the right to reject or cancel any registration at their sole discretion if the provided information is found to be false.</li>
                    </ul>
                </div>

                <div id="health-waiver" class="clause-card bg-white p-8 rounded-2xl border border-red-100 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1.5 h-full bg-red-500 opacity-80"></div>
                    <div class="flex items-center gap-4 mb-4">
                        <span class="w-8 h-8 rounded-full bg-red-100 text-red-600 font-bold flex items-center justify-center">3</span>
                        <h2 class="text-xl font-extrabold text-gray-900">Health, Safety, and Liability Waiver</h2>
                    </div>
                    <div class="pl-12">
                        <p class="text-gray-600 mb-4 font-medium">Running a marathon is a physically demanding activity. By registering, you explicitly declare that:</p>
                        <ul class="list-none space-y-3 text-gray-600">
                            <li class="relative pl-5 before:content-[''] before:absolute before:left-0 before:top-2 before:w-1.5 before:h-1.5 before:bg-red-400 before:rounded-full">You are medically and physically fit to participate in the Event.</li>
                            <li class="relative pl-5 before:content-[''] before:absolute before:left-0 before:top-2 before:w-1.5 before:h-1.5 before:bg-red-400 before:rounded-full"><strong>Release of Liability:</strong> To the maximum extent permitted by law, you release the Organizer, sponsors, and local authorities from any claims arising out of your participation.</li>
                            <li class="relative pl-5 before:content-[''] before:absolute before:left-0 before:top-2 before:w-1.5 before:h-1.5 before:bg-red-400 before:rounded-full">You consent to receive medical treatment that may be deemed advisable in the event of injury during the race.</li>
                        </ul>
                    </div>
                </div>

                <div id="payments" class="clause-card bg-white p-8 rounded-2xl border border-gray-100 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1.5 h-full bg-blue-500 opacity-80"></div>
                    <div class="flex items-center gap-4 mb-4">
                        <span class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 font-bold flex items-center justify-center">4</span>
                        <h2 class="text-xl font-extrabold text-gray-900">Payments and Refund Policy</h2>
                    </div>
                    <ul class="list-none space-y-3 text-gray-600 pl-12">
                        <li class="relative pl-5 before:content-[''] before:absolute before:left-0 before:top-2 before:w-1.5 before:h-1.5 before:bg-blue-400 before:rounded-full">All registration fees are processed securely via our payment gateway.</li>
                        <li class="relative pl-5 before:content-[''] before:absolute before:left-0 before:top-2 before:w-1.5 before:h-1.5 before:bg-blue-400 before:rounded-full"><strong class="text-gray-900">No Refunds:</strong> Once successfully processed, registration fees are strictly <strong>non-refundable</strong> under any circumstances.</li>
                        <li class="relative pl-5 before:content-[''] before:absolute before:left-0 before:top-2 before:w-1.5 before:h-1.5 before:bg-blue-400 before:rounded-full"><strong class="text-gray-900">Force Majeure:</strong> In the event of cancellation due to severe weather, political unrest, or government directives, no refunds will be issued, but the event may be rescheduled.</li>
                    </ul>
                </div>

                <div id="rules" class="clause-card bg-white p-8 rounded-2xl border border-gray-100 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1.5 h-full bg-purple-500 opacity-80"></div>
                    <div class="flex items-center gap-4 mb-4">
                        <span class="w-8 h-8 rounded-full bg-purple-100 text-purple-600 font-bold flex items-center justify-center">5</span>
                        <h2 class="text-xl font-extrabold text-gray-900">Race Rules and Code of Conduct</h2>
                    </div>
                    <ul class="list-none space-y-3 text-gray-600 pl-12">
                        <li class="relative pl-5 before:content-[''] before:absolute before:left-0 before:top-2 before:w-1.5 before:h-1.5 before:bg-purple-400 before:rounded-full">The provided BIB number must be visible on the chest at all times. Modifying the BIB is strictly prohibited.</li>
                        <li class="relative pl-5 before:content-[''] before:absolute before:left-0 before:top-2 before:w-1.5 before:h-1.5 before:bg-purple-400 before:rounded-full">Participants must follow the designated route. Taking shortcuts will result in disqualification.</li>
                        <li class="relative pl-5 before:content-[''] before:absolute before:left-0 before:top-2 before:w-1.5 before:h-1.5 before:bg-purple-400 before:rounded-full">The Organizer reserves the right to remove any participant who exhibits unsportsmanlike conduct or poses a safety risk.</li>
                    </ul>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div id="media" class="clause-card bg-white p-8 rounded-2xl border border-gray-100 relative overflow-hidden">
                        <h2 class="text-lg font-bold text-gray-900 mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-brand-tiger" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            6. Media Rights
                        </h2>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            By participating, you grant the Organizer the irrevocable right to use photographs and recordings of your participation for any legitimate marketing purpose without compensation.
                        </p>
                    </div>

                    <div id="privacy" class="clause-card bg-white p-8 rounded-2xl border border-gray-100 relative overflow-hidden">
                        <h2 class="text-lg font-bold text-gray-900 mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-brand-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8V7z"></path></svg>
                            7. Privacy Data
                        </h2>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            We collect personal info solely to manage the Event safely. Your data will not be sold to third parties. Payment data is managed securely by the payment gateway.
                        </p>
                    </div>
                </div>

                <div class="mt-8 bg-brand-green p-8 rounded-2xl text-center shadow-lg relative overflow-hidden">
                    <div class="absolute inset-0 z-0 opacity-20 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-white via-transparent to-transparent"></div>
                    <div class="relative z-10">
                        <h3 class="font-display font-bold text-white text-xl mb-2">Still have questions?</h3>
                        <p class="text-brand-green-100 mb-6 text-sm">Our support team is here to help you with any inquiries.</p>
                        <a href="/contact" class="inline-block bg-brand-tiger text-white font-bold py-3 px-8 rounded-full shadow hover:bg-orange-600 transition-colors">Contact Support</a>
                    </div>
                </div>

            </main>
        </div>
    </section>
</x-layouts.frontend>
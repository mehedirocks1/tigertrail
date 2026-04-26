<x-layouts.frontend>
    <x-slot:title>
        About Us | NatureTrail POJ
    </x-slot:title>

    <div class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 opacity-30">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-brand-green rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float"></div>
            <div class="absolute top-64 -left-24 w-72 h-72 bg-brand-tiger rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float" style="animation-delay: 2s;"></div>
        </div>

        <div class="container mx-auto px-6 max-w-5xl">
            <div class="text-center mb-16">
                <h1 class="font-display font-black text-4xl md:text-5xl text-brand-dark uppercase tracking-tight mb-4">
                    About <span class="text-brand-tiger">NatureTrail</span>
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    An initiative by the <span class="font-bold text-brand-green">Prokriti O Jibon Foundation</span>, dedicated to promoting health, fitness, and wildlife conservation through community-driven events.
                </p>
            </div>

            <div class="space-y-16">
                
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-md transition-shadow">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-brand-cream rounded-bl-full -z-10 transition-transform group-hover:scale-110"></div>
                        <h3 class="font-display font-bold text-2xl text-brand-dark mb-4 flex items-center gap-3">
                            <span class="w-8 h-1 bg-brand-tiger rounded-full"></span> Our Story
                        </h3>
                        <p class="text-gray-600 leading-relaxed">
                            NatureTrail POJ is a destination committed to providing exceptional, high-quality outdoor event experiences. We are dedicated to organizing purposeful activities that meet the growing need for physical fitness while nurturing a deep respect for our natural environment.
                        </p>
                    </div>

                    <div class="bg-brand-dark p-8 rounded-2xl shadow-xl relative overflow-hidden group">
                        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
                        <h3 class="font-display font-bold text-2xl text-white mb-4 flex items-center gap-3 relative z-10">
                            <span class="w-8 h-1 bg-brand-tiger rounded-full"></span> Our Mission
                        </h3>
                        <p class="text-gray-300 leading-relaxed relative z-10">
                            Our mission is to raise awareness for endangered wildlife—specifically the majestic Bengal Tiger. We strive to blend physical fitness with environmental stewardship. Through our commitment to excellence, we aim to inspire a healthier lifestyle while building a community dedicated to protecting our natural heritage.
                        </p>
                    </div>
                </div>

                <div class="text-center max-w-3xl mx-auto">
                    <h3 class="font-display font-bold text-3xl text-brand-dark mb-6">What We Do</h3>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        We specialize in offering a diverse selection of carefully curated events, including marathons, nature walks, and conservation campaigns. Our flagship event, the <strong class="text-brand-tiger">Tiger Run Dhaka</strong>, brings together runners of all levels. Every event is designed with attention to detail to ensure safety, enjoyment, and meaningful impact.
                    </p>
                </div>

                <div>
                    <h3 class="font-display font-bold text-3xl text-center text-brand-dark mb-10">Why Run With Us?</h3>
                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                        
                        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 text-center group">
                            <div class="w-14 h-14 mx-auto bg-brand-cream text-brand-green rounded-full flex items-center justify-center mb-4 group-hover:bg-brand-green group-hover:text-white transition-colors">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h4 class="font-bold text-brand-dark mb-2">Quality Experience</h4>
                            <p class="text-sm text-gray-500">We partner with reputable sponsors and utilize industry-standard race technologies to ensure a premium event.</p>
                        </div>

                        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 text-center group">
                            <div class="w-14 h-14 mx-auto bg-brand-cream text-brand-tiger rounded-full flex items-center justify-center mb-4 group-hover:bg-brand-tiger group-hover:text-white transition-colors">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <h4 class="font-bold text-brand-dark mb-2">Dedicated Support</h4>
                            <p class="text-sm text-gray-500">Our volunteer and medical support teams are always on standby to ensure a safe and smooth race day.</p>
                        </div>

                        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 text-center group">
                            <div class="w-14 h-14 mx-auto bg-brand-cream text-brand-green rounded-full flex items-center justify-center mb-4 group-hover:bg-brand-green group-hover:text-white transition-colors">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <h4 class="font-bold text-brand-dark mb-2">Secure Registration</h4>
                            <p class="text-sm text-gray-500">We prioritize the security of your data and transactions through encrypted payment gateways.</p>
                        </div>

                        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 text-center group">
                            <div class="w-14 h-14 mx-auto bg-brand-cream text-brand-tiger rounded-full flex items-center justify-center mb-4 group-hover:bg-brand-tiger group-hover:text-white transition-colors">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <h4 class="font-bold text-brand-dark mb-2">Fast Logistics</h4>
                            <p class="text-sm text-gray-500">Prompt Race Kit distribution, clear pre-race communication, and fast result processing via SMS.</p>
                        </div>

                    </div>
                </div>

            </div>

            <div class="mt-20 bg-brand-cream border border-brand-sand rounded-2xl p-10 text-center relative overflow-hidden">
                <h4 class="text-brand-dark font-display font-bold text-2xl mb-3">Join Our Journey</h4>
                <p class="text-gray-600 mb-8 max-w-lg mx-auto">Follow us on our social media platforms to stay updated on our latest events, conservation news, and exciting offers. Connect with us at <a href="mailto:info@naturetrailpojf.org" class="text-brand-tiger font-semibold hover:underline">info@naturetrailpojf.org</a>.</p>
                <div class="flex justify-center gap-4">
                    <a href="{{ url('/events/register') }}" class="inline-block bg-brand-tiger text-white px-8 py-3 rounded-full font-bold hover:bg-orange-500 transition shadow-lg transform hover:-translate-y-0.5">
                        Register for an Event
                    </a>
                    <a href="{{ route('contact.index') }}" class="inline-block bg-white text-brand-dark border border-gray-200 px-8 py-3 rounded-full font-bold hover:bg-gray-50 transition transform hover:-translate-y-0.5">
                        Contact Us
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-layouts.frontend>
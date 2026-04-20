<x-layouts.frontend>
    <x-slot:title>Our Activities | Tiger Run Dhaka</x-slot:title>

    <style>
        /* Elements start hidden and pushed down/aside for the scroll reveal effect */
        .reveal-left { opacity: 0; transform: translateX(-50px); transition: all 1s cubic-bezier(0.5, 0, 0, 1); }
        .reveal-right { opacity: 0; transform: translateX(50px); transition: all 1s cubic-bezier(0.5, 0, 0, 1); }
        .reveal-up { opacity: 0; transform: translateY(50px); transition: all 1s cubic-bezier(0.5, 0, 0, 1); }
        
        /* The class applied by JS when element enters viewport */
        .is-revealed { opacity: 1; transform: translate(0, 0); }
    </style>

    <section class="pt-32 pb-20 bg-brand-green relative overflow-hidden">
        <div class="absolute top-10 -left-20 w-72 h-72 bg-brand-tiger rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float"></div>
        <div class="absolute -bottom-20 right-10 w-96 h-96 bg-brand-gold rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-float" style="animation-delay: 2s;"></div>
        
        <div class="container mx-auto px-6 relative z-10 text-center reveal-up">
            <h1 class="text-5xl md:text-6xl font-display font-black text-white mb-6 uppercase tracking-widest">
                Action Beyond <span class="text-brand-tiger">The Run</span>
            </h1>
            <p class="text-brand-sand max-w-3xl mx-auto font-medium text-lg leading-relaxed">
                Tiger Run is more than just a marathon. It’s a movement. Discover the hands-on conservation and community activities we organize throughout the year.
            </p>
        </div>
    </section>

    <section class="py-24 bg-brand-cream relative z-10 overflow-hidden">
        <div class="container mx-auto px-6 max-w-7xl">
            
            <div class="space-y-32" id="activities-container">
                
                <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
                    <div class="w-full lg:w-1/2 reveal-left">
                        <div class="relative group rounded-3xl overflow-hidden shadow-2xl">
                            <img src="https://picsum.photos/seed/run/1000/700" alt="Annual Marathon" class="w-full h-[400px] object-cover transition-transform duration-1000 group-hover:scale-105">
                            <div class="absolute inset-0 bg-brand-green/20 group-hover:bg-transparent transition-colors duration-500"></div>
                            <div class="absolute bottom-6 left-6 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-lg font-bold text-brand-tiger tracking-wide shadow-lg">01</div>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/2 reveal-right">
                        <h4 class="text-brand-tiger font-bold tracking-widest uppercase mb-2">Flagship Event</h4>
                        <h2 class="text-4xl font-display font-black text-brand-charcoal mb-6">The Annual Tiger Run</h2>
                        <p class="text-gray-600 text-lg leading-relaxed mb-8">
                            Our core event brings thousands of runners together in the heart of Dhaka. Participants push their limits while raising crucial funds and awareness for the Prokriti O Jibon Foundation's wildlife conservation efforts.
                        </p>
                        <a href="#" class="inline-flex items-center space-x-2 text-brand-green font-bold hover:text-brand-tiger transition group">
                            <span>Explore the route</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row-reverse items-center gap-12 lg:gap-20">
                    <div class="w-full lg:w-1/2 reveal-right">
                        <div class="relative group rounded-3xl overflow-hidden shadow-2xl">
                            <img src="https://picsum.photos/seed/tree/1000/700" alt="Tree Plantation" class="w-full h-[400px] object-cover transition-transform duration-1000 group-hover:scale-105">
                            <div class="absolute inset-0 bg-brand-green/20 group-hover:bg-transparent transition-colors duration-500"></div>
                            <div class="absolute bottom-6 right-6 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-lg font-bold text-brand-tiger tracking-wide shadow-lg">02</div>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/2 reveal-left">
                        <h4 class="text-brand-tiger font-bold tracking-widest uppercase mb-2">Habitat Restoration</h4>
                        <h2 class="text-4xl font-display font-black text-brand-charcoal mb-6">Mass Tree Plantation</h2>
                        <p class="text-gray-600 text-lg leading-relaxed mb-8">
                            For every runner who crosses the finish line, we plant a tree. Volunteers and participants join hands in post-run plantation drives to restore the natural habitats crucial for local wildlife and ecological balance.
                        </p>
                        <a href="#" class="inline-flex items-center space-x-2 text-brand-green font-bold hover:text-brand-tiger transition group">
                            <span>Join the next drive</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
                    <div class="w-full lg:w-1/2 reveal-left">
                        <div class="relative group rounded-3xl overflow-hidden shadow-2xl">
                            <img src="https://picsum.photos/seed/workshop/1000/700" alt="Educational Workshops" class="w-full h-[400px] object-cover transition-transform duration-1000 group-hover:scale-105">
                            <div class="absolute inset-0 bg-brand-green/20 group-hover:bg-transparent transition-colors duration-500"></div>
                            <div class="absolute bottom-6 left-6 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-lg font-bold text-brand-tiger tracking-wide shadow-lg">03</div>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/2 reveal-right">
                        <h4 class="text-brand-tiger font-bold tracking-widest uppercase mb-2">Education</h4>
                        <h2 class="text-4xl font-display font-black text-brand-charcoal mb-6">Wildlife Workshops</h2>
                        <p class="text-gray-600 text-lg leading-relaxed mb-8">
                            Knowledge is the first step to conservation. We host interactive seminars and school outreach programs led by wildlife experts, teaching the younger generation about the importance of protecting the Bengal Tiger.
                        </p>
                        <a href="#" class="inline-flex items-center space-x-2 text-brand-green font-bold hover:text-brand-tiger transition group">
                            <span>View seminar schedules</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row-reverse items-center gap-12 lg:gap-20">
                    <div class="w-full lg:w-1/2 reveal-right">
                        <div class="relative group rounded-3xl overflow-hidden shadow-2xl">
                            <img src="https://picsum.photos/seed/cleanup/1000/700" alt="Cleanup Drive" class="w-full h-[400px] object-cover transition-transform duration-1000 group-hover:scale-105">
                            <div class="absolute inset-0 bg-brand-green/20 group-hover:bg-transparent transition-colors duration-500"></div>
                            <div class="absolute bottom-6 right-6 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-lg font-bold text-brand-tiger tracking-wide shadow-lg">04</div>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/2 reveal-left">
                        <h4 class="text-brand-tiger font-bold tracking-widest uppercase mb-2">Community Action</h4>
                        <h2 class="text-4xl font-display font-black text-brand-charcoal mb-6">Trail Clean-up Days</h2>
                        <p class="text-gray-600 text-lg leading-relaxed mb-8">
                            We believe in leaving no trace. Following our events, and routinely throughout the year, our community gathers to clean running trails and local parks, ensuring our environment stays pristine.
                        </p>
                        <a href="#" class="inline-flex items-center space-x-2 text-brand-green font-bold hover:text-brand-tiger transition group">
                            <span>Become a volunteer</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>

            </div>

            <div class="text-center mt-24 reveal-up">
                <button id="load-more-btn" class="inline-flex items-center space-x-3 px-10 py-4 rounded-full bg-brand-tiger text-white font-bold tracking-wide shadow-[0_0_20px_rgba(249,115,22,0.4)] hover:bg-orange-500 hover:-translate-y-1 transition transform duration-300">
                    <span>Load More Activities</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                    </svg>
                </button>
            </div>

        </div>
    </section>

    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Setup Intersection Observer for scroll animations
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.15 // Triggers when 15% of the element is visible
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Add the reveal class to trigger the CSS transition
                        entry.target.classList.add('is-revealed');
                        // Stop observing once revealed so it doesn't animate out and in repeatedly
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            // Target all elements with reveal classes
            const revealElements = document.querySelectorAll('.reveal-left, .reveal-right, .reveal-up');
            revealElements.forEach(el => observer.observe(el));
        });
    </script>
</x-layouts.frontend>
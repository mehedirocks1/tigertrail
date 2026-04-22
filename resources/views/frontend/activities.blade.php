<x-layouts.frontend>
    <x-slot:title>Our Activities | Tiger Run Dhaka</x-slot:title>

    <style>
        /* Scroll Reveal Animations */
        .reveal-left { opacity: 0; transform: translateX(-60px); transition: all 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94); }
        .reveal-right { opacity: 0; transform: translateX(60px); transition: all 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94); }
        .reveal-up { opacity: 0; transform: translateY(60px); transition: all 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94); }
        
        .is-revealed { opacity: 1; transform: translate(0, 0); }

        /* Subtle floating animation for background blobs */
        @keyframes float {
            0% { transform: translateY(0px) scale(1); }
            50% { transform: translateY(-20px) scale(1.05); }
            100% { transform: translateY(0px) scale(1); }
        }
        .animate-float { animation: float 6s ease-in-out infinite; }
    </style>

    <section class="pt-32 pb-24 bg-brand-green relative overflow-hidden">
        <div class="absolute top-0 -left-20 w-96 h-96 bg-brand-tiger rounded-full mix-blend-multiply filter blur-[100px] opacity-30 animate-float"></div>
        <div class="absolute -bottom-20 right-10 w-[30rem] h-[30rem] bg-brand-gold rounded-full mix-blend-multiply filter blur-[100px] opacity-20 animate-float" style="animation-delay: 2s;"></div>
        
        <div class="container mx-auto px-6 relative z-10 text-center reveal-up">
            <h1 class="text-5xl md:text-7xl font-display font-black text-white mb-6 uppercase tracking-tight">
                Action Beyond <br/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-tiger to-orange-300">The Run</span>
            </h1>
            <p class="text-brand-cream/90 max-w-2xl mx-auto font-medium text-xl leading-relaxed">
                Tiger Run is more than just a marathon. It’s a movement. Discover the hands-on conservation and community activities we organize throughout the year.
            </p>
        </div>
    </section>

    <section class="py-24 bg-brand-cream relative z-10 overflow-hidden">
        <div class="container mx-auto px-6 max-w-7xl">
            
            <div class="space-y-40" id="activities-container">
                
                @forelse($activities as $activity)
                    @php
                        // ডাইনামিক ডান-বাম লজিক (জোড়-বিজোড় অনুযায়ী)
                        $isEven = $loop->even;
                        
                        $rowClass = $isEven ? 'lg:flex-row-reverse' : 'lg:flex-row';
                        $imageRevealClass = $isEven ? 'reveal-right' : 'reveal-left';
                        $textRevealClass = $isEven ? 'reveal-left' : 'reveal-right';
                        
                        // ইমেজের উপর নাম্বারের ডিজাইন পজিশন
                        $numberPosClass = $isEven 
                            ? 'right-0 rounded-tl-[2rem] shadow-[-5px_-5px_15px_rgba(0,0,0,0.05)]' 
                            : 'left-0 rounded-tr-[2rem] shadow-[5px_-5px_15px_rgba(0,0,0,0.05)]';

                        // 01, 02 ফরম্যাট
                        $serialNumber = str_pad($loop->iteration, 2, '0', STR_PAD_LEFT);
                    @endphp

                    <div class="flex flex-col {{ $rowClass }} items-center gap-12 lg:gap-24 group/section">
                        
                        <div class="w-full lg:w-[60%] {{ $imageRevealClass }}">
                            <div class="relative group rounded-[2rem] overflow-hidden shadow-2xl ring-4 ring-white/50 bg-white">
                                <img src="{{ asset('storage/' . $activity->image_path) }}" alt="{{ $activity->title }}" class="w-full h-[450px] object-cover transition-transform duration-1000 group-hover:scale-110">
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-brand-charcoal/80 via-transparent to-transparent opacity-60 group-hover:opacity-40 transition-opacity duration-500"></div>
                                
                                <div class="absolute bottom-0 {{ $numberPosClass }} bg-white/70 backdrop-blur-md px-8 py-4 font-black text-3xl text-brand-tiger tracking-wide">
                                    {{ $serialNumber }}
                                </div>
                            </div>
                        </div>

                        <div class="w-full lg:w-[40%] {{ $textRevealClass }}">
                            <span class="inline-block px-5 py-2 rounded-full bg-orange-100 text-brand-tiger text-sm font-bold tracking-widest uppercase mb-6 shadow-sm">
                                {{ $activity->category }}
                            </span>
                            
                            <h2 class="text-4xl md:text-5xl font-display font-black text-brand-charcoal mb-6 leading-tight group-hover/section:text-brand-tiger transition-colors duration-300">
                                {{ $activity->title }}
                            </h2>
                            
                            <p class="text-gray-600 text-lg leading-relaxed mb-10">
                                {{ $activity->description }}
                            </p>
                            
                            @if($activity->link_url)
                            <a href="{{ $activity->link_url }}" class="inline-flex items-center space-x-3 text-brand-green font-bold text-lg hover:text-brand-tiger transition group/link">
                                <span class="relative overflow-hidden">
                                    {{ $activity->link_text ?? 'Learn More' }}
                                    <span class="absolute bottom-0 left-0 w-full h-0.5 bg-brand-tiger transform -translate-x-full group-hover/link:translate-x-0 transition-transform duration-300"></span>
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transform group-hover/link:translate-x-2 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                            @endif
                        </div>
                    </div>

                @empty
                    <div class="text-center text-gray-500 py-12">
                        <p class="text-2xl font-display font-bold">No activities added yet.</p>
                    </div>
                @endforelse

            </div>

            @if($activities->count() > 0)
            <div class="text-center mt-32 reveal-up">
                <button id="load-more-btn" class="group relative inline-flex items-center justify-center space-x-3 px-12 py-5 rounded-full bg-brand-tiger text-white font-bold text-lg tracking-wide shadow-[0_10px_30px_rgba(249,115,22,0.4)] hover:shadow-[0_15px_40px_rgba(249,115,22,0.6)] hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                    <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:animate-[shimmer_1.5s_infinite]"></div>
                    <span>Load More Activities</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                    </svg>
                </button>
            </div>
            @endif

        </div>
    </section>

    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.2 // Slightly increased for a better feel
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-revealed');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            const revealElements = document.querySelectorAll('.reveal-left, .reveal-right, .reveal-up');
            revealElements.forEach(el => observer.observe(el));
        });
    </script>
</x-layouts.frontend>
<x-layouts.frontend>
    <x-slot:title>Tiger Run Dhaka 2026 | Save The Tiger</x-slot>

    @php
        // Safe categories parser to handle both Arrays and JSON strings
        $safeCategories = function ($event) {
            if (!$event || empty($event->categories)) return null;

            if (is_array($event->categories)) {
                return $event->categories;
            }

            if (is_string($event->categories)) {
                $decoded = json_decode($event->categories, true);
                return is_array($decoded) ? $decoded : [$event->categories];
            }

            return null;
        };

        $featuredCategories = $safeCategories($featuredEvent ?? null);
    @endphp

    <header class="relative h-screen flex items-center justify-center overflow-hidden bg-black">
        <div class="absolute inset-0 z-10 bg-gradient-to-b from-black/80 via-black/10 to-transparent h-[30%] pointer-events-none"></div>
        <div class="absolute inset-0 z-10 flex items-center justify-center pointer-events-none">
            <div class="w-full h-[60%] bg-[radial-gradient(ellipse_at_center,_rgba(0,0,0,0.5)_0%,_transparent_60%)]"></div>
        </div>

        <div class="absolute inset-0 z-0" id="hero-slider">
            <img src="{{ asset('slides/slide1.webp') }}" alt="Slide 1" class="slide absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 ease-in-out opacity-100">
            <img src="{{ asset('slides/slide2.webp') }}" alt="Slide 2" class="slide absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 ease-in-out opacity-0">
            <img src="{{ asset('slides/slide3.webp') }}" alt="Slide 3" class="slide absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 ease-in-out opacity-0">
            <img src="{{ asset('slides/slide4.webp') }}" alt="Slide 4" class="slide absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 ease-in-out opacity-0">
        </div>

        <div class="relative z-20 text-center px-4 w-full max-w-7xl mx-auto flex flex-col items-center animate-float">
            <div class="reveal inline-flex items-center gap-3 px-6 py-2.5 rounded-full border border-white/30 bg-black/40 backdrop-blur-md shadow-2xl mb-8 transform transition-transform cursor-default">
                <span class="w-2 h-2 rounded-full bg-brand-tiger animate-pulse shadow-[0_0_10px_#F97316]"></span>
                <span class="text-white font-bold tracking-[0.3em] uppercase text-xs md:text-sm">
                    {{ $featuredEvent ? $featuredEvent->title : 'Tiger Run Dhaka 2026' }}
                </span>
                <span class="w-2 h-2 rounded-full bg-brand-tiger animate-pulse shadow-[0_0_10px_#F97316]"></span>
            </div>

            <h1 class="reveal font-display font-black text-6xl md:text-[6rem] lg:text-[8.5rem] text-white leading-[1] md:leading-[1.05] tracking-tight drop-shadow-[0_4px_12px_rgba(0,0,0,0.8)] mb-6 uppercase">
                <span class="block text-white">Save the</span>
                <span class="block mt-1 relative inline-block">
                    <span class="relative text-transparent bg-clip-text bg-gradient-to-r from-orange-400 via-brand-tiger to-red-600 drop-shadow-[0_4px_12px_rgba(0,0,0,0.8)]">Tiger</span>
                </span>
                <span class="block mt-2 text-transparent bg-clip-text bg-gradient-to-b from-brand-green to-emerald-700 text-4xl md:text-6xl lg:text-[5.5rem] tracking-normal drop-shadow-[0_4px_12px_rgba(0,0,0,0.8)]">
                    Save Sundarbans
                </span>
            </h1>
            
            <p class="reveal text-white text-lg md:text-2xl lg:text-3xl max-w-4xl mx-auto font-medium tracking-wide drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)] mt-4">
                Bridging fitness, awareness, and conservation in the heart of Dhaka.
            </p>
        </div>

        <div class="absolute bottom-12 left-1/2 transform -translate-x-1/2 z-20 flex flex-col items-center gap-3">
            <span class="text-[10px] uppercase tracking-widest text-white/80 font-bold hidden md:block drop-shadow-md">Scroll To Explore</span>
            <a href="#upcoming-event" class="w-8 h-14 rounded-full border-2 border-white/60 flex justify-center p-1.5 hover:border-brand-tiger transition-colors duration-300 group bg-black/40 backdrop-blur-sm shadow-xl">
                <div class="w-1.5 h-3 bg-brand-tiger rounded-full animate-bounce group-hover:bg-orange-400 mt-1 shadow-[0_0_8px_#F97316]"></div>
            </a>
        </div>
    </header>

    {{-- UPCOMING FEATURED EVENT --}}
    <section id="upcoming-event" class="py-24 bg-brand-cream relative overflow-hidden">
        <div class="container mx-auto px-6 relative z-10">
            @if($featuredEvent)
                <div class="bg-white rounded-[2.5rem] md:rounded-[3rem] p-8 md:p-12 lg:p-16 shadow-[0_20px_60px_-15px_rgba(0,0,0,0.1)] border border-gray-100 flex flex-col lg:flex-row items-center gap-12 lg:gap-16 relative overflow-hidden text-left">
                    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMCwgMCwgMCwgMC4wMikiLz48L3N2Zz4=')] opacity-50 pointer-events-none"></div>

                    <div class="w-full lg:w-3/5 relative z-10">
                        <div class="flex flex-wrap items-center gap-3 mb-6">
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-brand-tiger/10 border border-brand-tiger/20">
                                <span class="flex h-2.5 w-2.5 relative">
                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-tiger opacity-75"></span>
                                  <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-brand-tiger"></span>
                                </span>
                                <span class="text-brand-tiger text-xs font-bold uppercase tracking-widest">
                                    Flagship Event
                                </span>
                            </div>
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-brand-green/10 border border-brand-green/20">
                                <svg class="w-4 h-4 text-brand-green" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span class="text-brand-green text-xs font-bold uppercase tracking-widest">Digital Time Trial Results</span>
                            </div>
                        </div>
                        
                        <h2 class="font-display text-5xl md:text-6xl lg:text-7xl font-black leading-tight mb-4 text-brand-green drop-shadow-sm">
                            {{ $featuredEvent->title }}
                        </h2>
                        
                        <p class="text-gray-600 text-lg md:text-xl leading-relaxed mb-8">
                            {{ $featuredEvent->description ?? 'Highlighting the urgent need to protect the Bengal Tiger and its habitat. Join runners, conservationists, students, and nature lovers to promote wildlife conservation through sport.' }}
                        </p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                            <div class="flex items-start gap-4 bg-gray-50 hover:bg-white p-5 rounded-2xl border border-gray-100 shadow-sm transition">
                                <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center shrink-0 text-brand-tiger border border-gray-100 shadow-sm">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider font-bold">Date</p>
                                    <p class="font-bold text-lg text-brand-charcoal">{{ $featuredEvent->event_date?->format('F d, Y') ?? 'TBA' }}</p>
                                    <p class="text-xs text-brand-tiger font-medium">{{ $featuredEvent->event_date?->format('l - g:i A') }}</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4 bg-gray-50 hover:bg-white p-5 rounded-2xl border border-gray-100 shadow-sm transition">
                                <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center shrink-0 text-brand-tiger border border-gray-100 shadow-sm">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider font-bold">Location</p>
                                    <p class="font-bold text-lg text-brand-charcoal">{{ $featuredEvent->location ?? 'Dhaka, BD' }}</p>
                                    <p class="text-xs text-gray-500 font-medium">{{ $featuredEvent->venue ?? 'Hatirjheel Circuit' }}</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4 bg-gray-50 hover:bg-white p-5 rounded-2xl border border-gray-100 shadow-sm transition md:col-span-2">
                                <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center shrink-0 text-brand-tiger border border-gray-100 shadow-sm">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider font-bold">Categories</p>
                                    <p class="font-bold text-lg text-brand-charcoal">
                                        @if($featuredCategories)
                                            {!! implode(' <span class="text-brand-tiger font-normal mx-2">|</span> ', $featuredCategories) !!}
                                        @else
                                            General Category
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider font-bold mb-3 text-left">Who Can Participate?</p>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-4 py-1.5 bg-white border border-gray-200 shadow-sm rounded-full text-sm font-medium text-gray-700">🏃 Runners & Enthusiasts</span>
                                <span class="px-4 py-1.5 bg-white border border-gray-200 shadow-sm rounded-full text-sm font-medium text-gray-700">🌱 Conservationists</span>
                                <span class="px-4 py-1.5 bg-white border border-gray-200 shadow-sm rounded-full text-sm font-medium text-gray-700">🎓 Students & Educators</span>
                                <span class="px-4 py-1.5 bg-white border border-gray-200 shadow-sm rounded-full text-sm font-medium text-gray-700">👨‍👩‍👧‍👦 Nature Lovers & Families</span>
                            </div>
                        </div>
                    </div>

                    <div class="w-full lg:w-2/5 flex flex-col items-center bg-brand-cream/80 p-8 md:p-10 rounded-[2rem] border border-brand-tiger/20 relative z-10 shadow-xl">
                        <h3 class="text-brand-green font-display font-bold text-xl mb-6 uppercase tracking-widest text-center">Registration Closes In</h3>
                        <div class="grid grid-cols-4 gap-2 md:gap-3 w-full mb-10 text-center" id="countdown">
                            <div class="bg-white rounded-xl p-3 border border-gray-200">
                                <div class="text-3xl md:text-4xl font-display font-black text-brand-tiger" id="days">00</div>
                                <div class="text-[10px] text-gray-500 uppercase font-bold">Days</div>
                            </div>
                            <div class="bg-white rounded-xl p-3 border border-gray-200">
                                <div class="text-3xl md:text-4xl font-display font-black text-brand-tiger" id="hours">00</div>
                                <div class="text-[10px] text-gray-500 uppercase font-bold">Hours</div>
                            </div>
                            <div class="bg-white rounded-xl p-3 border border-gray-200">
                                <div class="text-3xl md:text-4xl font-display font-black text-brand-tiger" id="minutes">00</div>
                                <div class="text-[10px] text-gray-500 uppercase font-bold">Mins</div>
                            </div>
                            <div class="bg-white rounded-xl p-3 border border-gray-200">
                                <div class="text-3xl md:text-4xl font-display font-black text-brand-tiger" id="seconds">00</div>
                                <div class="text-[10px] text-gray-500 uppercase font-bold">Secs</div>
                            </div>
                        </div>

                        <a href="{{ route('events.register.form') }}" class="group relative w-full flex justify-center py-5 px-4 text-2xl font-black rounded-xl text-white bg-gradient-to-r from-brand-tiger to-orange-500 overflow-hidden shadow-lg transition-all transform hover:-translate-y-1">
                            <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/30 to-transparent -translate-x-full group-hover:animate-[shimmer_1.5s_infinite]"></div>
                            <span class="relative z-10 uppercase tracking-widest">REGISTER NOW</span>
                        </a>
                        <p class="text-gray-600 text-sm mt-6 text-center italic font-medium leading-relaxed">"Everyone, regardless of fitness ability, can participate."</p>
                    </div>
                </div>
            @else
                {{-- NO FLAGSHIP EVENT PLACEHOLDER --}}
                <div class="bg-white rounded-[2.5rem] p-16 shadow-xl border border-gray-100 text-center">
                    <div class="w-20 h-20 bg-brand-tiger/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-brand-tiger" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <h2 class="font-display text-4xl font-bold text-brand-green mb-4">No Flagship Event Currently Scheduled</h2>
                    <p class="text-gray-600 text-lg max-w-xl mx-auto">We are planning our next big run for conservation! Please check our other upcoming events below.</p>
                </div>
            @endif
        </div>
    </section>

    {{-- OTHER EVENTS SECTION --}}
    @if(isset($otherEvents) && $otherEvents->count() > 0)
        <section id="other-events" class="py-20 bg-white relative overflow-hidden">
            <div class="container mx-auto px-6 relative z-10">
                <div class="text-center mb-12">
                    <h4 class="text-brand-tiger font-bold uppercase tracking-[0.2em] text-sm mb-2">Explore More</h4>
                    <h2 class="font-display text-4xl font-extrabold text-brand-green">Other Running Events</h2>
                    <div class="w-24 h-1.5 bg-brand-tiger mx-auto mt-4 rounded-full"></div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($otherEvents as $event)
                        @php $eventCats = $safeCategories($event); @endphp
                        <div class="group bg-brand-cream/30 rounded-3xl p-8 border border-gray-100 hover:border-brand-tiger/30 hover:bg-white hover:shadow-2xl transition-all duration-500 flex flex-col text-left">
                            <div class="flex justify-between items-start mb-6">
                                <div class="bg-white p-3 rounded-2xl shadow-sm border border-gray-50">
                                    <svg class="w-8 h-8 text-brand-tiger" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                                <span class="text-xs font-bold text-brand-green bg-brand-green/10 px-3 py-1 rounded-full uppercase">{{ $event->event_date?->format('M Y') ?? 'TBA' }}</span>
                            </div>
                            <h3 class="font-display text-2xl font-bold text-brand-green mb-3 group-hover:text-brand-tiger transition-colors">{{ $event->title }}</h3>
                            <div class="space-y-3 mb-8 flex-grow">
                                <div class="flex items-center gap-2 text-gray-600 text-sm">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                                    <span>{{ $event->venue ?? 'Dhaka' }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-gray-600 text-sm">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                    <span class="font-medium text-brand-charcoal">{{ $eventCats ? implode(', ', $eventCats) : 'General' }}</span>
                                </div>
                            </div>
                            <a href="{{ route('events.register.form') }}" class="inline-flex items-center justify-center gap-2 bg-brand-green text-white font-bold py-3 px-6 rounded-xl hover:bg-brand-dark transition-all transform group-hover:translate-y-[-2px]">
                                Register Now <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- EXPERIENCE SECTION --}}
    <section id="experience" class="py-24 bg-white relative overflow-hidden">
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-brand-green/5 rounded-full blur-[100px] translate-y-1/2 -translate-x-1/2"></div>
        <div class="container mx-auto px-6 grid md:grid-cols-2 gap-16 items-center">
            <div class="reveal space-y-6 text-left">
                <h4 class="text-brand-tiger font-bold uppercase tracking-[0.3em] text-sm opacity-90">About the Initiative</h4>
                <h2 class="font-display text-4xl md:text-5xl lg:text-6xl font-extrabold text-brand-green leading-tight">What Is Nature Trail?</h2>
                <div class="space-y-4">
                    <p class="text-gray-700 text-lg leading-relaxed"><strong>Nature Trail</strong> is a people-centered conservation platform that promotes the well-being of both humans and nature through awareness-driven activities, outdoor experiences, and community engagement.</p>
                    <p class="text-gray-700 text-lg leading-relaxed">Rooted in Bangladesh’s rich biodiversity, Nature Trail connects individuals with the natural world while inspiring responsible actions to protect ecosystems, wildlife, and natural resources for future generations.</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4">
                    <div class="group bg-brand-cream/40 p-5 rounded-2xl border border-brand-green/5 hover:border-brand-green/20 hover:bg-white transition-all duration-300">
                        <h5 class="font-bold text-brand-green text-lg mb-1">Biodiversity Focus</h5>
                        <p class="text-sm text-gray-600 leading-snug">Highlighting Bangladesh’s ecosystems and wildlife.</p>
                    </div>
                    <div class="group bg-brand-cream/40 p-5 rounded-2xl border border-brand-green/5 hover:border-brand-green/20 hover:bg-white transition-all duration-300">
                        <h5 class="font-bold text-brand-green text-lg mb-1">Human Well-Being</h5>
                        <p class="text-sm text-gray-600 leading-snug">Promoting physical and mental health through nature.</p>
                    </div>
                </div>
            </div>
            <div class="reveal relative">
                <div class="absolute -inset-4 bg-brand-gold/15 rounded-[2rem] transform rotate-3"></div>
                <img src="{{ asset('images/what.webp') }}" alt="Nature Trail" class="relative rounded-[2rem] shadow-2xl w-full h-[600px] object-cover border border-white/50">
            </div>
        </div>
    </section>

    {{-- WHY NATURE TRAIL --}}
    <section id="why" class="py-24 bg-brand-cream relative overflow-hidden text-left">
        <div class="container mx-auto px-6 grid md:grid-cols-2 gap-16 items-center">
            <div class="reveal relative">
                <div class="absolute -inset-4 bg-brand-tiger/10 rounded-[2.5rem] transform -rotate-2"></div>
                <div class="relative rounded-[2.5rem] shadow-2xl overflow-hidden border-[12px] border-white">
                    <img src="{{ asset('images/why.webp') }}" alt="Tiger" class="w-full h-[550px] object-cover transition-transform duration-[3s] hover:scale-105">
                </div>
            </div>
            <div class="reveal space-y-8">
                <h2 class="font-display text-4xl md:text-5xl font-extrabold text-brand-green leading-tight">Why Nature Trail?</h2>
                <p class="text-gray-600 text-lg leading-relaxed">Bangladesh is one of the world’s biodiversity-rich yet environmentally vulnerable countries. Rapid urbanization and climate change threaten ecological balance.</p>
                <div class="space-y-6">
                    @foreach(['Build a stronger connection between people and nature', 'Promote physical and mental health through activities', 'Raise awareness about biodiversity conservation'] as $reason)
                        <div class="flex items-start group">
                            <div class="w-12 h-12 rounded-xl bg-brand-tiger flex items-center justify-center text-white shadow-lg shrink-0"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747" /></svg></div>
                            <p class="ml-5 text-gray-700 font-bold text-lg group-hover:text-brand-green transition-colors">{{ $reason }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- REWARDS SECTION --}}
    <section id="rewards" class="py-24 bg-brand-cream border-t border-brand-green/10 overflow-hidden">
        <div class="container mx-auto px-6 text-center">
            <h4 class="text-brand-tiger font-bold uppercase tracking-widest mb-2">Rewards</h4>
            <h2 class="font-display text-4xl font-bold text-brand-green mb-16">Awards & Recognition</h2>
            <div class="relative w-full overflow-hidden">
                <div class="flex gap-6 animate-marquee hover:[animation-play-state:paused] py-4">
                    @php 
                        $rewards = [
                            ['img' => 'mainprize500x.jpg', 'title' => 'Prize Money', 'desc' => 'Top 3 Winners'],
                            ['img' => 'medal500px.jpg', 'title' => 'Finisher Medal', 'desc' => 'For All Finishers'],
                            ['img' => 'airticket500x.jpg', 'title' => 'Air Ticket', 'desc' => 'Grand Raffle Winner'],
                            ['img' => 'certificate500x.jpg', 'title' => 'Certificate', 'desc' => 'All Participants'],
                        ];
                    @endphp
                    @foreach(array_merge($rewards, $rewards) as $reward)
                        <div class="w-72 md:w-80 bg-white rounded-3xl shadow-xl p-8 text-center border-t-4 border-brand-tiger shrink-0">
                            <img src="{{ asset('marchant/' . $reward['img']) }}" class="w-full aspect-square object-contain mb-6 drop-shadow-lg">
                            <h3 class="font-display text-2xl font-bold text-gray-800 mb-2">{{ $reward['title'] }}</h3>
                            <p class="text-gray-600 text-sm">{{ $reward['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- KIT SECTION --}}
    <section class="py-24 bg-white overflow-hidden text-center">
        <div class="container mx-auto px-6">
            <h2 class="font-display text-4xl font-bold text-brand-green mb-12">Participant Race Kit</h2>
            <div class="flex gap-6 overflow-hidden py-4 animate-marquee-reverse">
                @php
                    $kits = [
                        ['img' => 'Tshirt800px.jpg', 'name' => 'Event T-Shirt', 'sub' => 'Premium Jersey'],
                        ['img' => 'cap800x.jpg', 'name' => 'Tiger Cap', 'sub' => 'Embroidered'],
                        ['img' => 'mug800px.jpg', 'name' => 'Commemorative Mug', 'sub' => 'Morning Brew'],
                        ['img' => 'bag800px.jpg', 'name' => 'Race Bag', 'sub' => 'Eco Drawstring'],
                        ['img' => 'bottle800px.jpg', 'name' => 'Sports Bottle', 'sub' => 'Stay Hydrated'],
                    ];
                @endphp
                @foreach(array_merge($kits, $kits) as $kit)
                    <div class="w-64 md:w-80 bg-gray-50 rounded-2xl p-6 border border-gray-100 shadow-sm shrink-0">
                        <img src="{{ asset('marchant/' . $kit['img']) }}" class="w-full aspect-square object-contain mb-4">
                        <h4 class="font-bold text-lg text-brand-green">{{ $kit['name'] }}</h4>
                        <p class="text-sm text-gray-500">{{ $kit['sub'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- MEMORIES & SCOREBOARD --}}
    <section class="py-20 bg-gray-900 text-center relative overflow-hidden">
        <div class="absolute inset-0 opacity-30 grayscale"><img src="{{ asset('bg1.jpg') }}" class="w-full h-full object-cover"></div>
        <div class="container mx-auto px-6 relative z-10">
            <h2 class="font-display text-5xl font-bold text-white mb-10">MEMORIES</h2>
            <div class="flex justify-center gap-6 overflow-x-auto pb-8">
                <div class="w-72 h-96 bg-gray-800 rounded-xl overflow-hidden shrink-0"><img src="{{ asset('g3.jpg') }}" class="w-full h-full object-cover"></div>
                <div class="w-80 h-[28rem] bg-gray-800 rounded-xl overflow-hidden border-4 border-brand-tiger transform scale-105 shrink-0 relative">
                    <img src="{{ asset('g1.jpg') }}" class="w-full h-full object-cover">
                    <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black text-white font-bold text-2xl uppercase">Champions</div>
                </div>
                <div class="w-72 h-96 bg-gray-800 rounded-xl overflow-hidden shrink-0"><img src="{{ asset('g2.jpg') }}" class="w-full h-full object-cover"></div>
            </div>
        </div>
    </section>

    {{-- SUGGESTIONS / CONTACT --}}
    <section id="suggestions" class="py-24 bg-white">
        <div class="container mx-auto px-6 max-w-4xl">
            <div class="bg-brand-green rounded-3xl p-12 shadow-2xl relative overflow-hidden text-left">
                <div class="absolute top-0 left-0 w-2 h-full bg-brand-tiger"></div>
                <div class="grid md:grid-cols-5 gap-12 items-center">
                    <div class="md:col-span-2 text-white">
                        <h2 class="font-display text-4xl font-bold mb-4">Get In Touch</h2>
                        <p class="text-gray-300">Have questions? Send us a message!</p>
                    </div>
                    <div class="md:col-span-3">
                        <form action="#" class="space-y-4">
                            <input type="text" placeholder="Name" class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-brand-tiger">
                            <input type="email" placeholder="Email" class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-brand-tiger">
                            <textarea rows="3" placeholder="Message" class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-brand-tiger"></textarea>
                            <button class="w-full bg-brand-tiger text-white font-bold py-4 rounded-lg hover:bg-orange-600 transition">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- VIDEO --}}
    <section class="py-20 bg-brand-green text-white">
        <div class="container mx-auto px-6 text-center max-w-4xl">
            <h2 class="font-display text-4xl font-bold mb-10">Relive the Experience</h2>
            <div class="aspect-video rounded-xl overflow-hidden border-4 border-brand-tiger/30 shadow-2xl">
                <iframe width="100%" height="100%" src="https://www.youtube.com/embed/W3yC5F047eU" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // --- COUNTDOWN LOGIC ---
            @if($featuredEvent && $featuredEvent->registration_deadline)
                const deadlineString = "{{ $featuredEvent->registration_deadline->toIso8601String() }}";
                const targetDate = new Date(deadlineString).getTime();

                const timer = setInterval(() => {
                    const now = new Date().getTime();
                    const distance = targetDate - now;

                    if (distance < 0) {
                        clearInterval(timer);
                        document.getElementById("countdown").innerHTML = "<div class='col-span-4 text-brand-tiger text-xl font-bold'>Registration Closed</div>";
                        return;
                    }

                    document.getElementById("days").innerText = Math.floor(distance / (1000 * 60 * 60 * 24)).toString().padStart(2, '0');
                    document.getElementById("hours").innerText = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)).toString().padStart(2, '0');
                    document.getElementById("minutes").innerText = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)).toString().padStart(2, '0');
                    document.getElementById("seconds").innerText = Math.floor((distance % (1000 * 60)) / 1000).toString().padStart(2, '0');
                }, 1000);
            @endif

            // --- HERO SLIDER ---
            let currentSlide = 0;
            const slides = document.querySelectorAll('.slide');
            setInterval(() => {
                slides[currentSlide].classList.remove('opacity-100');
                slides[currentSlide].classList.add('opacity-0');
                currentSlide = (currentSlide + 1) % slides.length;
                slides[currentSlide].classList.remove('opacity-0');
                slides[currentSlide].classList.add('opacity-100');
            }, 5000);
        });
    </script>
    <style>
        @keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
        .animate-marquee { display: flex; width: max-content; animation: marquee 30s linear infinite; }
        .animate-marquee-reverse { display: flex; width: max-content; animation: marquee 30s linear infinite reverse; }
    </style>
    @endpush
</x-layouts.frontend>
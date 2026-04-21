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
        
        <div class="absolute inset-0 z-0" id="hero-slider">
            @if(isset($slides) && $slides->count() > 0)
                @foreach($slides as $slide)
                    {{-- WRAP EVERYTHING IN THE SLIDE CONTAINER --}}
                    <div class="slide absolute inset-0 w-full h-full transition-opacity duration-1000 ease-in-out {{ $loop->first ? 'opacity-100 z-10' : 'opacity-0 z-0 pointer-events-none' }}">
                        
                        {{-- 1. Background Image --}}
                        <img src="{{ asset('storage/' . $slide->image_path) }}" 
                             alt="{{ $slide->title ?? 'Tiger Run Slide' }}" 
                             class="absolute inset-0 w-full h-full object-cover">
                        
                        {{-- 2. Darkening Overlays (Moved inside so they stay above the image) --}}
                        <div class="absolute inset-0 z-10 bg-gradient-to-b from-black/80 via-black/10 to-transparent h-[30%] pointer-events-none"></div>
                        <div class="absolute inset-0 z-10 flex items-center justify-center pointer-events-none">
                            <div class="w-full h-[60%] bg-[radial-gradient(ellipse_at_center,_rgba(0,0,0,0.5)_0%,_transparent_60%)]"></div>
                        </div>

                        {{-- 3. Dynamic Text Content --}}
                        <div class="absolute inset-0 z-20 flex flex-col items-center justify-center text-center px-4 w-full max-w-7xl mx-auto animate-float">
                            
                            {{-- Event Badge (Static) --}}
                            <div class="reveal inline-flex items-center gap-3 px-6 py-2.5 rounded-full border border-white/30 bg-black/40 backdrop-blur-md shadow-2xl mb-8 transform transition-transform cursor-default">
                                <span class="w-2 h-2 rounded-full bg-brand-tiger animate-pulse shadow-[0_0_10px_#F97316]"></span>
                                <span class="text-white font-bold tracking-[0.3em] uppercase text-xs md:text-sm">
                                    {{ $featuredEvent ? $featuredEvent->title : 'Create a Flagship Event' }}
                                </span>
                                <span class="w-2 h-2 rounded-full bg-brand-tiger animate-pulse shadow-[0_0_10px_#F97316]"></span>
                            </div>

                            {{-- Title Styling Logic: Splits the last word to make it Orange! --}}
                            @php
                                $titleText = $slide->title ?? 'Save the Tiger';
                                $titleWords = explode(' ', $titleText);
                                $lastWord = count($titleWords) > 1 ? array_pop($titleWords) : $titleText;
                                $firstPart = count($titleWords) > 0 && $lastWord !== $titleText ? implode(' ', $titleWords) : '';
                            @endphp

                            <h1 class="reveal font-display font-black text-6xl md:text-[6rem] lg:text-[8.5rem] text-white leading-[1] md:leading-[1.05] tracking-tight drop-shadow-[0_4px_12px_rgba(0,0,0,0.8)] mb-6 uppercase">
                                
                                {{-- White Part --}}
                                @if($firstPart)
                                    <span class="block text-white">{{ $firstPart }}</span>
                                @endif
                                
                                {{-- Orange Gradient Part (The last word) --}}
                                <span class="block {{ $firstPart ? 'mt-1' : '' }} relative inline-block">
                                    <span class="relative text-transparent bg-clip-text bg-gradient-to-r from-orange-400 via-brand-tiger to-red-600 drop-shadow-[0_4px_12px_rgba(0,0,0,0.8)]">
                                        {{ $lastWord }}
                                    </span>
                                </span>
                                
                                {{-- Green Subtitle --}}
                                @if($slide->subtitle)
                                <span class="block mt-2 text-transparent bg-clip-text bg-gradient-to-b from-brand-green to-emerald-700 text-4xl md:text-6xl lg:text-[5.5rem] tracking-normal drop-shadow-[0_4px_12px_rgba(0,0,0,0.8)]">
                                    {{ $slide->subtitle }}
                                </span>
                                @endif
                            </h1>
                            
                            {{-- Description --}}
                            @if($slide->description)
                            <p class="reveal text-white text-lg md:text-2xl lg:text-3xl max-w-4xl mx-auto font-medium tracking-wide drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)] mt-4">
                                {{ $slide->description }}
                            </p>
                            @endif

                        </div>
                    </div>
                @endforeach
            @else
                {{-- FALLBACK IF NO SLIDES ARE IN DATABASE --}}
                <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-gray-900 via-brand-green/20 to-gray-900 sliding-bg flex flex-col items-center justify-center">
                    
                    <div class="px-6 py-2 rounded-full border border-white/20 bg-black/40 backdrop-blur-md mb-8">
                        <span class="text-white/70 text-xs font-bold tracking-[0.2em] uppercase">Please upload slider images</span>
                    </div>

                    <h1 class="font-display font-black text-6xl md:text-[6rem] text-white leading-[1] uppercase text-center">
                        <span class="block text-white">Save the</span>
                        <span class="block mt-1 relative inline-block text-transparent bg-clip-text bg-gradient-to-r from-orange-400 via-brand-tiger to-red-600">
                            Tiger
                        </span>
                    </h1>
                </div>
            @endif
        </div>

        {{-- Scroll Down Arrow (Static, so it stays at the bottom always) --}}
        <div class="absolute bottom-12 left-1/2 transform -translate-x-1/2 z-30 flex flex-col items-center gap-3">
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
            <div class="reveal order-1 md:order-1 space-y-6">
                <div>
                    <h4 class="text-brand-tiger font-bold uppercase tracking-[0.3em] mb-3 text-sm opacity-90">
                        About the Initiative
                    </h4>
                    <h2 class="font-display text-4xl md:text-5xl lg:text-6xl font-extrabold text-brand-green leading-tight">
                        What Is Nature Trail?
                    </h2>
                </div>
                
                <div class="space-y-4">
                    <p class="text-gray-700 text-lg leading-relaxed">
                        <strong>Nature Trail</strong> is a people-centered conservation platform that promotes the well-being of both humans and nature through awareness-driven activities, outdoor experiences, and community engagement.
                    </p>
                    <p class="text-gray-700 text-lg leading-relaxed">
                        Rooted in Bangladesh’s rich biodiversity, Nature Trail connects individuals with the natural world while inspiring responsible actions to protect ecosystems, wildlife, and natural resources for future generations.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4">
                    <div class="group bg-brand-cream/40 p-5 rounded-2xl border border-brand-green/5 hover:border-brand-green/20 hover:bg-white hover:shadow-xl transition-all duration-300">
                        <div class="h-12 w-12 bg-brand-tiger/10 rounded-lg flex items-center justify-center text-brand-tiger mb-4 group-hover:scale-110 transition-transform">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-.778.099-1.533.284-2.253" />
                            </svg>
                        </div>
                        <h5 class="font-bold text-brand-green text-lg mb-1">Biodiversity Focus</h5>
                        <p class="text-sm text-gray-600 leading-snug">Highlighting Bangladesh’s ecosystems and wildlife.</p>
                    </div>

                    <div class="group bg-brand-cream/40 p-5 rounded-2xl border border-brand-green/5 hover:border-brand-green/20 hover:bg-white hover:shadow-xl transition-all duration-300">
                        <div class="h-12 w-12 bg-brand-tiger/10 rounded-lg flex items-center justify-center text-brand-tiger mb-4 group-hover:scale-110 transition-transform">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18.75a6 6 0 0 0 6-6v-1.5m-6 7.5a6 6 0 0 1-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 0 1-3-3V4.5a3 3 0 1 1 6 0v8.25a3 3 0 0 1-3 3Z" />
                            </svg>
                        </div>
                        <h5 class="font-bold text-brand-green text-lg mb-1">Awareness & Action</h5>
                        <p class="text-sm text-gray-600 leading-snug">Education-driven activities that inspire real change.</p>
                    </div>

                    <div class="group bg-brand-cream/40 p-5 rounded-2xl border border-brand-green/5 hover:border-brand-green/20 hover:bg-white hover:shadow-xl transition-all duration-300">
                        <div class="h-12 w-12 bg-brand-tiger/10 rounded-lg flex items-center justify-center text-brand-tiger mb-4 group-hover:scale-110 transition-transform">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                        </div>
                        <h5 class="font-bold text-brand-green text-lg mb-1">Human Well-Being</h5>
                        <p class="text-sm text-gray-600 leading-snug">Promoting physical and mental health through nature.</p>
                    </div>

                    <div class="group bg-brand-cream/40 p-5 rounded-2xl border border-brand-green/5 hover:border-brand-green/20 hover:bg-white hover:shadow-xl transition-all duration-300">
                        <div class="h-12 w-12 bg-brand-tiger/10 rounded-lg flex items-center justify-center text-brand-tiger mb-4 group-hover:scale-110 transition-transform">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                            </svg>
                        </div>
                        <h5 class="font-bold text-brand-green text-lg mb-1">Community Engagement</h5>
                        <p class="text-sm text-gray-600 leading-snug">Bringing people together for conservation causes.</p>
                    </div>
                </div>
            </div>

            <div class="reveal relative order-2 md:order-2">
                <div class="absolute -inset-4 bg-brand-gold/15 rounded-[2rem] transform rotate-3"></div>
                <div class="absolute inset-0 border-2 border-brand-green/5 rounded-[2rem] transform -rotate-2"></div>
                <img src="images/what.webp" alt="Lush green nature and conservation concept" class="relative rounded-[2rem] shadow-2xl hover:scale-[1.01] transition duration-700 w-full h-[600px] object-cover border border-white/50">

                <div class="absolute -bottom-6 -right-6 md:-right-10 p-6 bg-white rounded-2xl shadow-2xl border-l-8 border-brand-tiger z-10 max-w-[240px] transform hover:-translate-y-2 transition duration-300">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-2 h-2 rounded-full bg-brand-tiger animate-pulse"></div>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Our Motto</span>
                    </div>
                    <h5 class="font-extrabold text-brand-green text-lg mb-1 leading-tight">People • Nature • Conservation</h5>
                    <p class="text-xs text-gray-500 font-medium italic">Building awareness for a sustainable future</p>
                </div>
            </div>
        </div>
    </section>

    
   

    {{-- WHY NATURE TRAIL --}}
<section id="why" class="py-24 bg-brand-cream relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-brand-gold/15 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/2"></div>
        
        <div class="container mx-auto px-6 grid md:grid-cols-2 gap-16 items-center">
            <div class="reveal relative">
                <div class="absolute -inset-4 bg-brand-tiger/10 rounded-[2.5rem] transform -rotate-2"></div>
                
                <div class="relative rounded-[2.5rem] shadow-2xl overflow-hidden border-[12px] border-white">
                    <img src="images/why.webp" alt="Majestic Tiger Close-up" class="w-full h-[550px] object-cover transition-transform duration-[3s] hover:scale-105">
                    
                    <div class="absolute bottom-6 left-6 right-6 p-6 bg-white/95 backdrop-blur-sm rounded-2xl shadow-xl border-l-4 border-brand-tiger">
                        <h5 class="font-bold text-brand-tiger text-xs uppercase tracking-widest mb-1">Conservation Fact</h5>
                        <p class="text-gray-700 text-sm leading-relaxed font-medium">
                            Bangladesh is one of the world’s biodiversity-rich yet environmentally vulnerable countries.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="reveal space-y-8">
                <div class="space-y-2">
                    <h4 class="text-brand-green font-bold uppercase tracking-[0.2em] text-sm opacity-70">Our Purpose</h4>
                    <h2 class="font-display text-4xl md:text-5xl font-extrabold text-brand-green leading-tight">Why Nature Trail?</h2>
                </div>
                
                <p class="text-gray-600 text-lg leading-relaxed">
                    Bangladesh is one of the world’s biodiversity-rich yet environmentally vulnerable countries. Rapid urbanization, habitat loss, climate change, and declining wildlife populations threaten both ecological balance and human well-being.
                </p>

                <div class="space-y-6">
                    <div class="flex items-start group">
                        <div class="flex-shrink-0 mt-1">
                            <div class="w-12 h-12 rounded-xl bg-brand-tiger flex items-center justify-center text-white shadow-lg transition-transform group-hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-5">
                            <p class="text-gray-700 font-bold text-lg group-hover:text-brand-green transition-colors">Build a stronger connection between people and nature</p>
                        </div>
                    </div>

                    <div class="flex items-start group">
                        <div class="flex-shrink-0 mt-1">
                            <div class="w-12 h-12 rounded-xl bg-brand-tiger flex items-center justify-center text-white shadow-lg transition-transform group-hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-5">
                            <p class="text-gray-700 font-bold text-lg group-hover:text-brand-green transition-colors">Promote physical and mental health through nature-based activities</p>
                        </div>
                    </div>

                    <div class="flex items-start group">
                        <div class="flex-shrink-0 mt-1">
                            <div class="w-12 h-12 rounded-xl bg-brand-tiger flex items-center justify-center text-white shadow-lg transition-transform group-hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-5">
                            <p class="text-gray-700 font-bold text-lg group-hover:text-brand-green transition-colors">Raise awareness about biodiversity conservation in Bangladesh</p>
                        </div>
                    </div>

                    <div class="flex items-start group">
                        <div class="flex-shrink-0 mt-1">
                            <div class="w-12 h-12 rounded-xl bg-brand-tiger flex items-center justify-center text-white shadow-lg transition-transform group-hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-5">
                            <p class="text-gray-700 font-bold text-lg group-hover:text-brand-green transition-colors">Encourage collective responsibility for protecting wildlife and ecosystems</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


 {{-- REWARDS SECTION --}}
    <section id="rewards" class="py-24 bg-brand-cream border-t border-brand-green/10 overflow-hidden">
        <div class="container mx-auto px-6 text-center">
            <h4 class="text-brand-tiger font-bold uppercase tracking-widest mb-2">Rewards</h4>
            <h2 class="font-display text-4xl font-bold text-brand-green mb-16">Awards & Recognition</h2>
            
            <div class="relative w-full overflow-hidden">
                @php
                    // Pull active rewards if not passed from controller
                    $activeRewards = \App\Models\Reward::active()->get();
                    // Merge for marquee loop if we have items
                    $displayRewards = $activeRewards->count() > 0 ? $activeRewards->concat($activeRewards) : collect();
                @endphp

                @if($displayRewards->count() > 0)
                    <div class="flex gap-6 animate-marquee hover:[animation-play-state:paused] py-4">
                        @foreach($displayRewards as $reward)
                            <div class="w-72 md:w-80 bg-white rounded-3xl shadow-xl p-8 text-center border-t-4 border-brand-tiger shrink-0 flex flex-col justify-center items-center">
                                
                                @if($reward->image_path)
                                    <img src="{{ asset('storage/' . $reward->image_path) }}" 
                                         class="w-full aspect-square object-contain mb-6 drop-shadow-lg" 
                                         alt="{{ $reward->title }}">
                                @else
                                    {{-- Fallback for missing image --}}
                                    <div class="w-full aspect-square mb-6 bg-gray-100 rounded-2xl flex items-center justify-center border-2 border-dashed border-gray-300">
                                        <span class="text-gray-400 font-bold text-xs uppercase tracking-tighter">UPLOAD AT INDEX</span>
                                    </div>
                                @endif

                                <h3 class="font-display text-2xl font-bold text-gray-800 mb-2">{{ $reward->title }}</h3>
                                <p class="text-gray-600 text-sm">{{ $reward->description }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    {{-- State when no rewards are in the database at all --}}
                    <div class="py-12 bg-white/50 rounded-3xl border-2 border-dashed border-gray-200">
                        <p class="text-gray-400 font-medium">Rewards configuration pending...</p>
                    </div>
                @endif
            </div>
        </div>
    </section>


    
 {{-- KIT SECTION --}}
    <section class="py-24 bg-white overflow-hidden text-center">
        <div class="container mx-auto px-6">
            <h2 class="font-display text-4xl font-bold text-brand-green mb-12">Participant Race Kit</h2>
            
            <div class="relative w-full overflow-hidden">
                @php
                    $activeKits = \App\Models\RaceKit::active()->get();
                    $displayKits = $activeKits->count() > 0 ? $activeKits->concat($activeKits) : collect();
                @endphp

                @if($displayKits->count() > 0)
                    <div class="flex gap-6 overflow-hidden py-4 animate-marquee-reverse hover:[animation-play-state:paused]">
                        @foreach($displayKits as $kit)
                            <div class="w-64 md:w-80 bg-gray-50 rounded-2xl p-6 border border-gray-100 shadow-sm shrink-0 flex flex-col justify-center items-center">
                                @if($kit->image_path)
                                    <img src="{{ asset('storage/' . $kit->image_path) }}" 
                                         class="w-full aspect-square object-contain mb-4" 
                                         alt="{{ $kit->name }}">
                                @else
                                    <div class="w-full aspect-square mb-4 bg-gray-200 rounded-xl flex items-center justify-center border-2 border-dashed border-gray-300">
                                        <span class="text-gray-400 font-bold text-[10px] uppercase">UPLOAD AT INDEX</span>
                                    </div>
                                @endif
                                
                                <h4 class="font-bold text-lg text-brand-green">{{ $kit->name }}</h4>
                                <p class="text-sm text-gray-500">{{ $kit->subtitle }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    {{-- FALLBACK MESSAGE --}}
                    <div class="py-12 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
                        <p class="text-gray-400 font-medium">Race kit details are being finalized. Stay tuned!</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

{{-- MEMORIES SECTION --}}
    @php
        $memories = \App\Models\Memory::active()->get();
    @endphp

    <section class="py-24 bg-gray-900 text-center relative overflow-hidden">
        {{-- Background overlay --}}
        <div class="absolute inset-0 opacity-20 grayscale pointer-events-none">
            <img src="{{ asset('bg1.jpg') }}" class="w-full h-full object-cover">
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <h2 class="font-display text-5xl font-bold text-white mb-16 tracking-tighter">MEMORIES</h2>
            
            {{-- Swiper Container --}}
            <div class="swiper memory-swiper !pb-20">
                <div class="swiper-wrapper items-center">
                    @forelse($memories as $memory)
                        <div class="swiper-slide transition-all duration-500">
                            <div class="relative group aspect-[3/4] overflow-hidden rounded-2xl border-2 border-white/10 shadow-2xl transition-all duration-500 group-[.swiper-slide-active]:border-brand-tiger group-[.swiper-slide-active]:border-4">
                                
                                <img src="{{ asset('storage/' . $memory->image_path) }}" 
                                     class="w-full h-full object-cover grayscale group-[.swiper-slide-active]:grayscale-0 transition-all duration-700">
                                
                                {{-- Gradient Overlay for Title --}}
                                @if($memory->title)
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent opacity-0 group-[.swiper-slide-active]:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-6 text-left">
                                        <p class="text-brand-tiger font-bold text-xs uppercase tracking-widest mb-1">Highlight</p>
                                        <h3 class="text-white font-display text-2xl font-bold uppercase leading-none">{{ $memory->title }}</h3>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 italic">Capturing memories...</p>
                    @endforelse
                </div>
                
                {{-- Pagination dots --}}
                <div class="swiper-pagination !-bottom-2"></div>
            </div>
        </div>
    </section>

    <style>
        /* Optional: Hide scrollbar for cleaner look */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>



<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<style>
    .memory-swiper {
        width: 100%;
        padding-top: 50px;
        padding-bottom: 50px;
    }

    .memory-swiper .swiper-slide {
        width: 300px; /* Base width */
        height: auto;
        filter: blur(2px);
        transform: scale(0.8); /* Edge items: smallest */
        opacity: 0.5;
        transition: all 0.5s ease;
    }

    /* Side items: medium */
    .memory-swiper .swiper-slide-next,
    .memory-swiper .swiper-slide-prev {
        transform: scale(0.9);
        opacity: 0.8;
        filter: blur(1px);
        z-index: 10;
    }

    /* Middle item: Largest and clear */
    .memory-swiper .swiper-slide-active {
        transform: scale(1.1); /* Center item: biggest */
        filter: blur(0);
        opacity: 1;
        z-index: 20;
    }

    /* Style for the pagination dots */
    .swiper-pagination-bullet { background: white !important; opacity: 0.3; }
    .swiper-pagination-bullet-active { background: #F97316 !important; opacity: 1; width: 24px; border-radius: 4px; }
</style>




   {{-- Community Voices/Review Section --}}
    @php
        $testimonials = \App\Models\Testimonial::approved()->latest()->get();
        $colors = ['border-brand-green', 'border-brand-tiger', 'border-brand-gold'];
    @endphp

    <section id="reviews" class="py-24 bg-brand-cream relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-brand-tiger/5 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2"></div>

        <div class="container mx-auto px-6">
            <div class="text-center mb-16 reveal">
                <h4 class="text-brand-tiger font-bold uppercase tracking-widest mb-2 opacity-80">Community Voices</h4>
                <h2 class="font-display text-4xl md:text-5xl font-bold text-brand-green">What Our Runners Say</h2>
                <p class="max-w-2xl mx-auto mt-4 text-gray-600">
                    Join thousands of nature lovers who have stepped up for the Sundarbans.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @foreach($testimonials as $index => $testimonial)
                <div class="reveal glass-card p-8 rounded-2xl shadow-lg border-b-4 {{ $colors[$index % 3] }}">
                    <div class="flex text-brand-gold mb-4">
                        @for($i = 1; $i <= 5; $i++)
                            <span>{{ $i <= $testimonial->rating ? '★' : '☆' }}</span>
                        @endfor
                    </div>
                    
                    <p class="text-gray-700 italic mb-6">"{{ $testimonial->review }}"</p>
                    
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-brand-sand overflow-hidden border border-gray-100">
                            @if($testimonial->avatar_path)
                                <img src="{{ asset('storage/' . $testimonial->avatar_path) }}" alt="{{ $testimonial->name }}" class="w-full h-full object-cover">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($testimonial->name) }}&color=7F9CF5&background=EBF4FF" alt="{{ $testimonial->name }}" class="w-full h-full object-cover">
                            @endif
                        </div>
                        <div>
                            <h5 class="font-bold text-brand-green">{{ $testimonial->name }}</h5>
                            <p class="text-xs text-gray-500">{{ $testimonial->title }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            @if($testimonials->isEmpty())
                <div class="text-center py-12">
                    <p class="text-gray-400 italic">No reviews yet. Be the first to share your experience!</p>
                </div>
            @endif
        </div>
    </section>


  {{-- Brochure Section --}}
@php
    $brochure = \App\Models\Brochure::where('is_active', true)->latest()->first();
@endphp

@if($brochure)
<section class="py-24 bg-white">
    <div class="container mx-auto px-6 flex flex-col md:flex-row items-center gap-12 max-w-5xl">
        {{-- Image Side --}}
        <div class="w-full md:w-1/2 reveal relative">
            <div class="relative bg-gray-200 aspect-[3/4] rounded shadow-2xl overflow-hidden transform rotate-2 hover:rotate-0 transition duration-500 border border-gray-200">
                {{-- FIX 1: Use Storage URL for images --}}
                <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($brochure->image_path) }}" 
                     alt="Brochure Cover" 
                     class="w-full h-full object-cover grayscale hover:grayscale-0 transition duration-500">
                
                <div class="absolute inset-0 flex flex-col items-center justify-center bg-black/10 pointer-events-none">
                     <div class="w-16 h-16 bg-white/90 rounded-full flex items-center justify-center mb-4 shadow-lg">
                        <svg class="w-8 h-8 text-brand-green" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                     </div>
                </div>
            </div>
        </div>

        {{-- Content Side --}}
        <div class="w-full md:w-1/2 reveal">
            <h2 class="font-display text-4xl font-bold text-gray-900 mb-6 uppercase leading-tight">
                {{ $brochure->title }}
            </h2>
            <p class="text-gray-600 text-lg mb-8">
                {{ $brochure->description }}
            </p>
            
            {{-- FIX 2: Use Storage URL for PDF and ensure download attribute is clean --}}
            <a href="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($brochure->file_path) }}" 
               download
               class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-8 rounded-full uppercase tracking-wider shadow-lg transition transform hover:-translate-y-1">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Download Brochure
            </a>
        </div>
    </div>
</section>
@endif

{{-- Sponsors Section --}}
@php
    $allSponsors = \App\Models\Sponsor::active()->get()->groupBy('type');
    $titleSponsor = $allSponsors->get('title');
    $poweredBy = $allSponsors->get('powered_by');
    $organizers = $allSponsors->get('organizer');
@endphp

<section id="organizers" class="py-20 bg-white border-t border-gray-100">
    <div class="container mx-auto px-6">
        <div class="flex flex-col items-center space-y-16 text-center">
            
            {{-- TITLE SPONSOR - Height: 100px (h-24) --}}
            @if($titleSponsor)
                @foreach($titleSponsor as $sponsor)
                <div class="flex flex-col items-center transition duration-500">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-[0.3em] mb-6">Title Sponsor</span>
                    <div class="flex items-center justify-center">
                        <img src="{{ asset('storage/' . $sponsor->logo_path) }}" 
                             alt="{{ $sponsor->name }}" 
                             class="h-24 w-auto object-contain">
                    </div>
                </div>
                @endforeach
            @endif

            {{-- POWERED BY - Height: 64px (h-16) --}}
            @if($poweredBy)
                @foreach($poweredBy as $sponsor)
                <div class="flex flex-col items-center transition duration-500">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-[0.2em] mb-4">Powered by</span>
                    <img src="{{ asset('storage/' . $sponsor->logo_path) }}" 
                         alt="{{ $sponsor->name }}" 
                         class="h-16 w-auto object-contain">
                </div>
                @endforeach
            @endif

            {{-- ORGANIZERS - Height: 48px (h-12) --}}
            @if($organizers)
            <div class="w-full pt-10 border-t border-gray-100">
                <span class="block text-xs font-bold text-gray-400 uppercase tracking-[0.2em] mb-10">Organized By</span>
                <div class="flex flex-wrap justify-center items-center gap-12 md:gap-16">
                    @foreach($organizers as $sponsor)
                        <div class="flex flex-col items-center transition">
                            <img src="{{ asset('storage/' . $sponsor->logo_path) }}" 
                                 alt="{{ $sponsor->name }}" 
                                 class="h-12 w-auto object-contain">
                            <span class="text-[10px] font-bold text-gray-500 mt-2 uppercase tracking-wider">{{ $sponsor->name }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>
</section>

  {{-- SUGGESTIONS SECTION --}}
<section id="suggestions" class="py-24 bg-white">
    <div class="container mx-auto px-6 max-w-4xl">
        <div class="bg-brand-green rounded-3xl p-12 shadow-2xl relative overflow-hidden text-left">
            <div class="absolute top-0 left-0 w-2 h-full bg-brand-tiger"></div>
            <div class="grid md:grid-cols-5 gap-12 items-center">
                
                {{-- Text Content --}}
                <div class="md:col-span-2 text-white">
                    <h2 class="font-display text-4xl font-bold mb-4">Suggestions</h2>
                    <p class="text-gray-300">Share your thoughts or ideas to make Tiger Trail even better!</p>
                </div>

                {{-- Form Content --}}
                <div class="md:col-span-3">
                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="bg-white/20 border border-white/30 text-white p-4 rounded-lg mb-6 backdrop-blur-sm animate-pulse">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('suggestion.store') }}" method="POST" class="space-y-4">
                        @csrf
                        
                        {{-- Name & Phone in Grid --}}
                        <div class="grid md:grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <input type="text" name="name" value="{{ old('name') }}" placeholder="Full Name" required
                                    class="w-full bg-white/10 border @error('name') border-red-400 @else border-white/20 @enderror rounded-lg px-4 py-3 text-white placeholder:text-gray-400 focus:outline-none focus:border-brand-tiger transition">
                                @error('name') <p class="text-red-300 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="space-y-1">
                                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Phone (e.g. 017...)" required
                                    class="w-full bg-white/10 border @error('phone') border-red-400 @else border-white/20 @enderror rounded-lg px-4 py-3 text-white placeholder:text-gray-400 focus:outline-none focus:border-brand-tiger transition">
                                @error('phone') <p class="text-red-300 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="space-y-1">
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Email Address" required
                                class="w-full bg-white/10 border @error('email') border-red-400 @else border-white/20 @enderror rounded-lg px-4 py-3 text-white placeholder:text-gray-400 focus:outline-none focus:border-brand-tiger transition">
                            @error('email') <p class="text-red-300 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Message --}}
                        <div class="space-y-1">
                            <textarea name="message" rows="3" placeholder="Write your suggestion here..." required
                                class="w-full bg-white/10 border @error('message') border-red-400 @else border-white/20 @enderror rounded-lg px-4 py-3 text-white placeholder:text-gray-400 focus:outline-none focus:border-brand-tiger transition">{{ old('message') }}</textarea>
                            @error('message') <p class="text-red-300 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit" class="w-full bg-brand-tiger text-white font-bold py-4 rounded-lg hover:bg-orange-600 transition shadow-lg transform active:scale-95 duration-200">
                            Send Suggestion
                        </button>
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

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    new Swiper(".memory-swiper", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        loop: true,
        slidesPerView: "auto", // Allows the "5-card" look
        coverflowEffect: {
            rotate: 0,
            stretch: 0,
            depth: 100,
            modifier: 2.5, // Controls how much the side ones "shrink"
            slideShadows: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            320: { slidesPerView: 1.5, spaceBetween: 20 },
            768: { slidesPerView: 3, spaceBetween: 30 },
            1024: { slidesPerView: 5, spaceBetween: 40 }
        }
    });
</script>




    <style>
        @keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
        .animate-marquee { display: flex; width: max-content; animation: marquee 30s linear infinite; }
        .animate-marquee-reverse { display: flex; width: max-content; animation: marquee 30s linear infinite reverse; }
    </style>
    @endpush
</x-layouts.frontend>
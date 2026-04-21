<x-layouts.frontend>
    <x-slot:title>Gallery | Tiger Run Dhaka</x-slot:title>

    <section class="pt-32 pb-16 bg-brand-green relative overflow-hidden">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-brand-tiger rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float"></div>
        
        <div class="container mx-auto px-6 relative z-10 text-center">
            <h1 class="text-4xl md:text-5xl font-display font-black text-white mb-4 uppercase tracking-wider">
                Moments of <span class="text-brand-tiger">Glory</span>
            </h1>
            <p class="text-brand-sand max-w-2xl mx-auto font-medium text-lg">
                Relive the energy, passion, and spirit of our previous runs for conservation.
            </p>
        </div>
    </section>

    <section class="py-20 bg-brand-cream">
        <div class="container mx-auto px-6">
            
            {{-- DYNAMIC FILTER BUTTONS --}}
            <div class="flex flex-wrap justify-center gap-4 mb-12" id="gallery-filters">
                <button data-filter="all" class="filter-btn px-6 py-2.5 rounded-full bg-brand-tiger text-white font-semibold shadow-[0_0_15px_rgba(249,115,22,0.3)] transition transform hover:-translate-y-0.5">
                    All Photos
                </button>
                
                @if(isset($categories))
                    @foreach($categories as $category)
                        <button data-filter="{{ Str::slug($category) }}" class="filter-btn px-6 py-2.5 rounded-full bg-white text-brand-charcoal hover:bg-brand-tiger hover:text-white transition font-semibold shadow-sm border border-gray-200">
                            {{ $category }}
                        </button>
                    @endforeach
                @endif
            </div>

            {{-- DYNAMIC IMAGE GRID --}}
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6 auto-rows-[250px]" id="gallery-grid">
                
                @if(isset($images) && $images->count() > 0)
                    @foreach($images as $image)
                        @php
                            // Determine grid sizing based on database
                            $colClass = $image->col_span > 1 ? 'md:col-span-2' : '';
                            $rowClass = $image->row_span > 1 ? 'md:row-span-2' : '';
                            
                            // Adjust padding and text size if it's a large block to match your design
                            $isLarge = ($image->col_span > 1 || $image->row_span > 1);
                        @endphp

                        <div class="gallery-item relative group rounded-2xl overflow-hidden shadow-lg bg-gray-200 cursor-pointer {{ $colClass }} {{ $rowClass }}" 
                             data-category="{{ Str::slug($image->category) }}">
                            
                            <img src="{{ asset('storage/' . $image->image_path) }}" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                                 alt="{{ $image->title ?? 'Tiger Run Gallery Image' }}">
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                                
                                {{-- Dynamically switch padding and slide-up animations based on image size --}}
                                <div class="{{ $isLarge ? 'p-8 w-full transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300' : 'p-6' }}">
                                    @if($image->title)
                                        <h3 class="text-white font-display font-bold {{ $isLarge ? 'text-2xl mb-1' : 'text-lg' }}">
                                            {{ $image->title }}
                                        </h3>
                                    @endif
                                    
                                    @if($image->subtitle)
                                        <p class="text-brand-tiger {{ $isLarge ? 'font-medium' : 'text-sm font-medium' }}">
                                            {{ $image->subtitle }}
                                        </p>
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-span-full text-center text-gray-500 py-12 font-medium">
                        More memories coming soon!
                    </div>
                @endif

            </div>
            
            {{-- LOAD MORE BUTTON --}}
            @if(isset($images) && $images->count() > 0)
                <div class="text-center mt-16">
                    <button class="inline-flex items-center space-x-2 px-8 py-3 rounded-full border-2 border-brand-green text-brand-green hover:bg-brand-green hover:text-white transition font-bold tracking-wide">
                        <span>Load More Memories</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </div>
            @endif

        </div>
    </section>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterBtns = document.querySelectorAll('.filter-btn');
            const galleryItems = document.querySelectorAll('.gallery-item');

            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // 1. Reset all buttons to default white style
                    filterBtns.forEach(b => {
                        b.classList.remove('bg-brand-tiger', 'text-white', 'shadow-[0_0_15px_rgba(249,115,22,0.3)]');
                        b.classList.add('bg-white', 'text-brand-charcoal');
                    });
                    
                    // 2. Add active orange style to the clicked button
                    this.classList.remove('bg-white', 'text-brand-charcoal');
                    this.classList.add('bg-brand-tiger', 'text-white', 'shadow-[0_0_15px_rgba(249,115,22,0.3)]');

                    // 3. Filter the images based on data-category
                    const filterValue = this.getAttribute('data-filter');
                    
                    galleryItems.forEach(item => {
                        if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                            item.style.display = 'block';
                            // Optional: Add a tiny fade-in effect when they reappear
                            item.animate([{ opacity: 0 }, { opacity: 1 }], { duration: 400, fill: 'forwards' });
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>
    @endpush

</x-layouts.frontend>
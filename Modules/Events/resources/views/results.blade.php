<x-layouts.frontend>
    <main class="flex-grow pt-32 pb-24 relative overflow-hidden">
        
        <div class="absolute top-0 right-0 w-96 h-96 bg-brand-tiger/5 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-brand-green/5 rounded-full blur-[100px] translate-y-1/2 -translate-x-1/2 pointer-events-none"></div>

        <div class="container mx-auto px-4 md:px-6 relative z-10 max-w-6xl">
            
            <div class="text-center mb-16 reveal">
                <h4 class="text-brand-tiger font-bold uppercase tracking-[0.3em] mb-3 text-sm">Hall of Fame</h4>
                <h1 class="font-display text-4xl md:text-5xl lg:text-6xl font-extrabold text-brand-green leading-tight">
                    Race Results <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-green to-brand-tiger">Archive</span>
                </h1>
                <p class="text-gray-600 mt-4 max-w-2xl mx-auto text-lg">
                    Look up your official finish times and rankings from past Tiger Run events.
                </p>
            </div>

            <div class="reveal bg-white p-6 md:p-8 rounded-2xl shadow-lg border border-gray-100 mb-12">
                <form action="{{ route('events.results') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
                    
                    <div class="flex flex-col gap-2">
                        <label for="event_id" class="text-xs font-bold text-gray-500 uppercase tracking-wider">Event Name</label>
                        <select name="event_id" id="event_id" required class="w-full bg-gray-50 border border-gray-200 text-gray-800 text-sm rounded-lg focus:ring-brand-tiger focus:border-brand-tiger block p-3 outline-none transition cursor-pointer font-medium">
                            <option value="" disabled {{ !request('event_id') ? 'selected' : '' }}>Select an Event...</option>
                            @foreach($events as $event)
                                <option value="{{ $event->id }}" {{ request('event_id') == $event->id ? 'selected' : '' }}>
                                    {{ $event->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="category" class="text-xs font-bold text-gray-500 uppercase tracking-wider">Race Category</label>
                        <select name="category" id="category" class="w-full bg-gray-50 border border-gray-200 text-gray-800 text-sm rounded-lg focus:ring-brand-tiger focus:border-brand-tiger block p-3 outline-none transition cursor-pointer font-medium">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col gap-2 md:col-span-2">
                        <label for="search" class="text-xs font-bold text-gray-500 uppercase tracking-wider">Search Athlete</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" name="search" id="search" value="{{ request('search') }}" class="bg-gray-50 border border-gray-200 text-gray-800 text-sm rounded-lg focus:ring-brand-tiger focus:border-brand-tiger block w-full pl-10 p-3 outline-none transition" placeholder="Search by Name or BIB number...">
                            <button type="submit" class="text-white absolute right-2.5 bottom-2 bg-brand-tiger hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-md text-sm px-4 py-1.5 transition">Search</button>
                        </div>
                    </div>
                </form>
            </div>

            @if(request('event_id'))
                <div class="reveal bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                        <div>
                            <h3 class="font-display font-bold text-xl text-brand-green">Official Leaderboard</h3>
                            <p class="text-sm text-gray-500">
                                Showing results 
                                @if(request('category')) for <span class="font-semibold">{{ request('category') }}</span> @else for all categories @endif
                            </p>
                        </div>
                        <button class="flex items-center gap-2 text-sm text-brand-tiger font-semibold hover:text-orange-700 transition">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            Export CSV
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse whitespace-nowrap">
                            <thead class="bg-brand-green text-white">
                                <tr>
                                    <th class="p-4 font-semibold text-sm uppercase tracking-wide">Rank</th>
                                    <th class="p-4 font-semibold text-sm uppercase tracking-wide">BIB</th>
                                    <th class="p-4 font-semibold text-sm uppercase tracking-wide">Athlete</th>
                                    <th class="p-4 font-semibold text-sm uppercase tracking-wide">Category</th>
                                    <th class="p-4 font-semibold text-sm uppercase tracking-wide text-right">Net Time</th>
                                    <th class="p-4 font-semibold text-sm uppercase tracking-wide text-right hidden sm:table-cell">Pace</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-sm">
                                
                                @forelse($results as $result)
                                    @php
                                        // র‍্যাংক অনুযায়ী ডিজাইন
                                        $bgClass = 'bg-white hover:bg-gray-50';
                                        $rankTextColor = 'text-gray-500';
                                        $hasTrophy = false;

                                        if ($result->rank == 1) {
                                            $bgClass = 'bg-yellow-50 hover:bg-yellow-100';
                                            $rankTextColor = 'text-yellow-600';
                                            $hasTrophy = true;
                                        } elseif ($result->rank == 2) {
                                            $bgClass = 'bg-gray-50 hover:bg-gray-100';
                                            $rankTextColor = 'text-gray-400';
                                            $hasTrophy = true;
                                        } elseif ($result->rank == 3) {
                                            $bgClass = 'bg-orange-50 hover:bg-orange-100';
                                            $rankTextColor = 'text-orange-600';
                                            $hasTrophy = true;
                                        }
                                    @endphp

                                    <tr class="{{ $bgClass }} transition group">
                                        <td class="p-4 font-bold {{ $rankTextColor }} text-lg {{ $hasTrophy ? 'flex items-center gap-2' : 'pl-8' }}">
                                            @if($hasTrophy)
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 01.967.744L14.146 7.2 17.5 9.134a1 1 0 010 1.732l-3.354 1.935-1.18 4.455a1 1 0 01-1.933 0L9.854 12.8 6.5 10.866a1 1 0 010-1.732l3.354-1.935 1.18-4.455A1 1 0 0112 2z" clip-rule="evenodd"></path></svg>
                                            @endif
                                            {{ $result->rank }}
                                        </td>
                                        <td class="p-4 font-mono font-medium text-gray-500">{{ $result->bib_number }}</td>
                                        <td class="p-4">
                                            <div class="flex items-center gap-3">
                                                @if($result->photo_path)
                                                    <img src="{{ asset('storage/' . $result->photo_path) }}" alt="{{ $result->athlete_name }}" class="w-10 h-10 rounded-full object-cover border border-gray-200 shadow-sm">
                                                @else
                                                    <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center border border-gray-300 text-xl shadow-sm">
                                                        👤
                                                    </div>
                                                @endif
                                                <span class="font-bold text-gray-900">
                                                    {{ $result->athlete_name }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="p-4 text-gray-600 font-medium">{{ $result->category }}</td>
                                        <td class="p-4 font-mono font-bold text-brand-green text-right text-base">{{ $result->net_time }}</td>
                                        <td class="p-4 font-mono text-gray-500 text-right hidden sm:table-cell">{{ $result->pace }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="p-12 text-center text-gray-500 font-medium">
                                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 text-gray-400 mb-4">
                                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <p class="text-lg">No results found matching your search criteria.</p>
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                    
                    @if(isset($results) && $results->hasPages())
                        <div class="p-6 bg-white border-t border-gray-100">
                            {{ $results->appends(request()->query())->links() }}
                        </div>
                    @endif
                </div>
            @else
                <div class="reveal bg-white rounded-2xl shadow-sm border border-gray-200 p-16 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-brand-green/10 text-brand-green mb-6">
                        <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3 font-display">Select an Event</h3>
                    <p class="text-gray-500 max-w-md mx-auto text-lg">Please select an event from the dropdown above and click search to view the official race leaderboard.</p>
                </div>
            @endif

        </div>
    </main>
</x-layouts.frontend>
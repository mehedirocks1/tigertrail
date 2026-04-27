<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Tiger Run Dhaka 2026 | Save The Tiger' }}</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Montserrat:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            green: '#064E3B',
                            dark: '#022c22', 
                            tiger: '#F97316',
                            gold: '#FBBF24', 
                            cream: '#F9F9F7', 
                            sand: '#E6E2D3',
                            charcoal: '#1A202C',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Montserrat', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        @keyframes shimmer {
            100% { transform: translateX(100%); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .animate-float {
            animation: float 4s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-brand-cream text-brand-charcoal antialiased overflow-x-hidden selection:bg-brand-tiger selection:text-white flex flex-col min-h-screen">

    <nav id="navbar" class="fixed w-full z-50 top-0 py-6 transition-all duration-300">
        <div class="absolute inset-0 bg-gradient-to-b from-black/80 to-transparent -z-10 pointer-events-none transition-opacity duration-300" id="nav-gradient"></div>

        <div class="container mx-auto px-6 flex justify-between items-center">
            <a href="{{ url('/') }}" class="nav-text text-white font-display font-bold text-xl tracking-wider uppercase z-50 drop-shadow-md flex flex-col">
                <span>Nature<span class="text-brand-tiger">Trail</span></span>
                <span class="text-[10px] font-light normal-case opacity-90 text-gray-200 leading-none mt-1">Prokriti O Jibon</span>
            </a>
            
            <div class="hidden md:flex space-x-8 items-center">
                <a href="{{ url('/') }}" class="nav-text text-white hover:text-brand-tiger transition font-medium text-sm tracking-wide">Home</a>
                <a href="{{ route('activities.index') }}" class="nav-text text-white hover:text-brand-tiger transition font-medium text-sm tracking-wide">Activities</a>
                <a href="{{ route('gallery.index') }}" class="nav-text text-white hover:text-brand-tiger transition font-medium text-sm tracking-wide">Gallery</a>
                <a href="{{ route('events.results') }}" class="nav-text text-white hover:text-brand-tiger transition font-medium text-sm tracking-wide">Result Archive</a>
                <a href="{{ route('contact.index') }}" class="nav-text text-white hover:text-brand-tiger transition font-medium text-sm tracking-wide">Contact Us</a>
                
                <a href="{{ url('/events/register') }}" class="bg-brand-tiger text-white px-8 py-2.5 rounded-full font-bold hover:bg-orange-500 transition shadow-[0_0_15px_rgba(249,115,22,0.5)] transform hover:-translate-y-0.5">Register</a>
            </div>

            <button id="mobile-menu-btn" class="md:hidden text-brand-tiger z-50 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
        
        <div id="mobile-menu" class="fixed inset-0 bg-brand-green/98 backdrop-blur-xl transform translate-x-full transition-transform duration-300 flex flex-col justify-center items-center space-y-8 md:hidden z-40">
            <a href="{{ url('/') }}" class="text-2xl text-white font-display font-bold mobile-link">Home</a>
            <a href="{{ route('activities.index') }}" class="text-2xl text-white font-display font-bold mobile-link">Activities</a>
            <a href="{{ route('gallery.index') }}" class="text-2xl text-white font-display font-bold mobile-link">Gallery</a>
            <a href="{{ route('events.results') }}" class="text-2xl text-white font-display font-bold mobile-link">Result Archive</a>
            <a href="{{ route('contact.index') }}" class="text-2xl text-white font-display font-bold mobile-link">Contact Us</a>
            <a href="{{ url('/events/register') }}" class="text-2xl text-brand-tiger font-display font-black tracking-wider mobile-link mt-4 px-10 py-4 bg-brand-tiger rounded-full shadow-[0_0_20px_rgba(249,115,22,0.5)]">Register Now</a>
            
            <button id="close-menu" class="absolute top-6 right-6 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </nav>

    <main class="flex-grow">
        {{ $slot }}
    </main>

<footer class="bg-black text-gray-400 py-6 border-t border-gray-900">
    <div class="container mx-auto px-4 grid md:grid-cols-4 gap-6">
        <div class="md:col-span-2">
            <a href="{{ url('/') }}" class="text-white font-display font-bold text-xl uppercase mb-2 block">
                Tiger<span class="text-brand-tiger">Run</span>
            </a>
            <p class="mb-2">An initiative by <span class="text-white">Prokriti O Jibon Foundation</span>.</p>
            <p class="text-sm">Running for a greener tomorrow.</p>
        </div>

        <div>
            <h4 class="text-white font-bold uppercase text-sm mb-2">Quick Links</h4>
           <ul class="space-y-1">
        <li>
            <a href="{{ route('terms') }}" class="hover:text-brand-tiger">Terms & Conditions</a>
        </li>
        <li>
            <a href="{{ route('refund.policy') }}" class="hover:text-brand-tiger">Refund Policy</a>
        </li>
        <li>
            <a href="{{ route('privacy.policy') }}" class="hover:text-brand-tiger">Privacy Policy</a>
        </li>
        <li>
            <a href="{{ route('about.us') }}" class="hover:text-brand-tiger">About Us</a>
        </li>
    </ul>
        </div>

        <div>
            <h4 class="text-white font-bold uppercase text-sm mb-2">Contact</h4>
            <p>info@naturetrailpojf.org</p>
            <p>+880 1234 567 890</p>
        </div>
    </div>

    <!-- SSL -->
    <div class="px-4 mt-6">
        <a target="_blank" href="https://www.sslcommerz.com/" class="block max-w-xl mx-auto">
            <img class="w-full h-auto object-contain" src="https://securepay.sslcommerz.com/public/image/SSLCommerz-Pay-With-logo-All-Size-01.png" alt="SSLCommerz" />
        </a>
    </div>

    <!-- Bottom -->
    <div class="container mx-auto px-4 mt-4 pt-4 border-t border-gray-900 text-center text-xs">
        &copy; 2026 Tiger Run Dhaka. All rights reserved.
    </div>
</footer>

    <script src="{{ asset('main.js') }}" defer></script>
    
    @stack('scripts')
</body>
</html>
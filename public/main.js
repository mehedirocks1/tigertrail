// Slider Code
document.addEventListener('DOMContentLoaded', () => {
    const slides = document.querySelectorAll('.slide');
    let currentSlide = 0;
    const slideInterval = 5000; // Change slide every 5000ms (5 seconds)

    if (slides.length > 0) {
        setInterval(() => {
            // Fade out current slide
            slides[currentSlide].classList.remove('opacity-100');
            slides[currentSlide].classList.add('opacity-0');

            // Move to the next slide, loop back to start if at the end
            currentSlide = (currentSlide + 1) % slides.length;

            // Fade in new slide
            slides[currentSlide].classList.remove('opacity-0');
            slides[currentSlide].classList.add('opacity-100');
        }, slideInterval);
    }
});

// Navbar scroll effect
const navbar = document.getElementById('navbar');
const navGradient = document.getElementById('nav-gradient');
const mobileMenuBtn = document.getElementById('mobile-menu-btn');
const mobileMenu = document.getElementById('mobile-menu');
const closeMenu = document.getElementById('close-menu');
const mobileLinks = document.querySelectorAll('.mobile-link');

window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
        if(navGradient) navGradient.classList.add('opacity-0');
    } else {
        navbar.classList.remove('scrolled');
        if(navGradient) navGradient.classList.remove('opacity-0');
    }
});

// Mobile Menu Interactivity
mobileMenuBtn.addEventListener('click', () => {
    mobileMenu.classList.remove('translate-x-full');
});

const closeMobileMenu = () => {
    mobileMenu.classList.add('translate-x-full');
}

closeMenu.addEventListener('click', closeMobileMenu);
mobileLinks.forEach(link => link.addEventListener('click', closeMobileMenu));


// Intersection Observer for Reveal Animations
const revealElements = document.querySelectorAll('.reveal');

const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('active');
        }
    });
}, {
    threshold: 0.1,
    rootMargin: "0px 0px -50px 0px"
});

revealElements.forEach(el => revealObserver.observe(el));


// Number Counter Animation
const counters = document.querySelectorAll('[data-target]');
const counterObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
        if(entry.isIntersecting) {
            const counter = entry.target;
            const target = +counter.getAttribute('data-target');
            const increment = target / 50; // Speed
            
            const updateCounter = () => {
                const c = +counter.innerText;
                if(c < target) {
                    counter.innerText = Math.ceil(c + increment);
                    setTimeout(updateCounter, 20);
                } else {
                    counter.innerText = target;
                    if(target >= 1000) counter.innerText = "1.5k+"; 
                }
            };
            updateCounter();
            observer.unobserve(counter); // Run once
        }
    });
});

counters.forEach(counter => counterObserver.observe(counter));
import './bootstrap';

// Theme Management
function initTheme() {
    const themeToggleBtn = document.getElementById('theme-toggle');
    const themeToggleMobileBtn = document.getElementById('theme-toggle-mobile');
    const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
    const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
    const themeToggleDarkIconMobile = document.querySelector('.theme-toggle-dark-icon-mobile');
    const themeToggleLightIconMobile = document.querySelector('.theme-toggle-light-icon-mobile');

    // Set initial icon state
    function updateThemeIcons() {
        if (document.documentElement.classList.contains('dark')) {
            themeToggleLightIcon?.classList.remove('hidden');
            themeToggleDarkIcon?.classList.add('hidden');
            themeToggleLightIconMobile?.classList.remove('hidden');
            themeToggleDarkIconMobile?.classList.add('hidden');
        } else {
            themeToggleDarkIcon?.classList.remove('hidden');
            themeToggleLightIcon?.classList.add('hidden');
            themeToggleDarkIconMobile?.classList.remove('hidden');
            themeToggleLightIconMobile?.classList.add('hidden');
        }
    }

    // Toggle theme
    function toggleTheme() {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        }
        updateThemeIcons();
    }

    // Initialize icons
    updateThemeIcons();

    // Add event listeners
    themeToggleBtn?.addEventListener('click', toggleTheme);
    themeToggleMobileBtn?.addEventListener('click', toggleTheme);
}

// AstroTech Site Functionality
document.addEventListener('DOMContentLoaded', function() {
    // Initialize theme
    initTheme();
    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }
    
    // Smooth scrolling for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                const offsetTop = targetElement.offsetTop - 80;
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Intersection Observer for fade-in animations
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });
    
    const fadeElements = document.querySelectorAll('.fade-in');
    fadeElements.forEach(el => observer.observe(el));
    
    // Project filtering functionality
    const filterBtns = document.querySelectorAll('.filter-btn');
    const projectCards = document.querySelectorAll('.project-card');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const filter = this.dataset.filter;
            
            // Update active button
            filterBtns.forEach(b => {
                b.classList.remove('bg-primary-600', 'text-white');
                b.classList.add('bg-white', 'text-gray-700', 'border', 'border-gray-300');
            });
            
            this.classList.remove('bg-white', 'text-gray-700', 'border', 'border-gray-300');
            this.classList.add('bg-primary-600', 'text-white');
            
            // Filter projects
            projectCards.forEach(card => {
                if (filter === 'all' || card.dataset.type === filter) {
                    card.style.display = 'block';
                    card.classList.add('fade-in');
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
    
    // Contact form enhancement
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            
            submitBtn.textContent = 'Envoi en cours...';
            submitBtn.disabled = true;
            
            // Re-enable after a delay if needed
            setTimeout(() => {
                if (submitBtn.disabled) {
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
                }
            }, 10000);
        });
    }
});

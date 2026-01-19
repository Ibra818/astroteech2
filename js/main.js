// Main JavaScript for AstroTech

document.addEventListener('DOMContentLoaded', function() {
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
                const offsetTop = targetElement.offsetTop - 80; // Account for fixed navbar
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Contact form handling
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            handleContactForm();
        });
    }
    
    // Intersection Observer for fade-in animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);
    
    // Observe elements for fade-in animation
    const fadeElements = document.querySelectorAll('.fade-in');
    fadeElements.forEach(el => observer.observe(el));
    
    // Add fade-in classes to elements
    setTimeout(() => {
        const serviceCols = document.querySelectorAll('.grid .group');
        serviceCols.forEach((col, index) => {
            col.classList.add('fade-in');
            col.style.animationDelay = `${index * 0.2}s`;
        });
    }, 500);
    
    // Project filtering (for projects page)
    initProjectFiltering();
    
    // Admin panel functionality
    initAdminPanel();
});

function handleContactForm() {
    const form = document.getElementById('contact-form');
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;
    
    // Show loading state
    submitBtn.innerHTML = '<div class="loading"></div> Envoi en cours...';
    submitBtn.disabled = true;
    
    // Get form data
    const formData = new FormData(form);
    const data = {
        prenom: formData.get('prenom'),
        nom: formData.get('nom'),
        email: formData.get('email'),
        projet: formData.get('projet'),
        message: formData.get('message')
    };
    
    // Simulate form submission (replace with actual endpoint)
    setTimeout(() => {
        // Remove any existing messages
        const existingMessages = form.querySelectorAll('.message-success, .message-error');
        existingMessages.forEach(msg => msg.remove());
        
        // Show success message
        const successMessage = document.createElement('div');
        successMessage.className = 'message-success message-show';
        successMessage.textContent = 'Votre message a été envoyé avec succès ! Nous vous repondrons dans les plus brefs délais.';
        form.appendChild(successMessage);
        
        // Reset form
        form.reset();
        
        // Reset button
        submitBtn.textContent = originalText;
        submitBtn.disabled = false;
        
        // Hide success message after 5 seconds
        setTimeout(() => {
            successMessage.classList.remove('message-show');
            setTimeout(() => successMessage.remove(), 300);
        }, 5000);
        
        console.log('Form submitted:', data);
    }, 2000);
}

function initProjectFiltering() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const projectCards = document.querySelectorAll('.project-card');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const filter = this.dataset.filter;
            
            // Update active button
            filterBtns.forEach(b => b.classList.remove('active', 'bg-primary-600', 'text-white'));
            filterBtns.forEach(b => b.classList.add('bg-white', 'text-gray-700'));
            
            this.classList.remove('bg-white', 'text-gray-700');
            this.classList.add('active', 'bg-primary-600', 'text-white');
            
            // Filter projects
            projectCards.forEach(card => {
                if (filter === 'all' || card.dataset.type === filter) {
                    card.style.display = 'block';
                    card.classList.add('animate-fade-in-up');
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
}

function initAdminPanel() {
    // Check if user is admin (simple check for demo)
    const isAdmin = localStorage.getItem('isAdmin') === 'true';
    
    if (isAdmin) {
        showAdminElements();
    }
    
    // Admin login functionality
    const adminLoginBtn = document.getElementById('admin-login');
    if (adminLoginBtn) {
        adminLoginBtn.addEventListener('click', function() {
            const password = prompt('Mot de passe administrateur:');
            if (password === 'admin123') { // Simple demo password
                localStorage.setItem('isAdmin', 'true');
                showAdminElements();
                alert('Connexion administrateur réussie!');
            } else {
                alert('Mot de passe incorrect!');
            }
        });
    }
    
    // Admin logout functionality
    const adminLogoutBtn = document.getElementById('admin-logout');
    if (adminLogoutBtn) {
        adminLogoutBtn.addEventListener('click', function() {
            localStorage.removeItem('isAdmin');
            hideAdminElements();
            alert('Déconnexion réussie!');
        });
    }
}

function showAdminElements() {
    const adminElements = document.querySelectorAll('.admin-hidden');
    adminElements.forEach(el => el.classList.remove('admin-hidden'));
    
    const adminLoginBtn = document.getElementById('admin-login');
    const adminLogoutBtn = document.getElementById('admin-logout');
    
    if (adminLoginBtn) adminLoginBtn.style.display = 'none';
    if (adminLogoutBtn) adminLogoutBtn.style.display = 'inline-block';
}

function hideAdminElements() {
    const adminElements = document.querySelectorAll('.admin-panel, .admin-btn');
    adminElements.forEach(el => {
        if (!el.classList.contains('admin-hidden')) {
            el.classList.add('admin-hidden');
        }
    });
    
    const adminLoginBtn = document.getElementById('admin-login');
    const adminLogoutBtn = document.getElementById('admin-logout');
    
    if (adminLoginBtn) adminLoginBtn.style.display = 'inline-block';
    if (adminLogoutBtn) adminLogoutBtn.style.display = 'none';
}

// Project management functions (for admin)
function addProject(projectData) {
    const projects = getProjects();
    const newProject = {
        id: Date.now(),
        ...projectData,
        createdAt: new Date().toISOString()
    };
    
    projects.push(newProject);
    saveProjects(projects);
    return newProject;
}

function editProject(projectId, updatedData) {
    const projects = getProjects();
    const index = projects.findIndex(p => p.id === projectId);
    
    if (index !== -1) {
        projects[index] = { ...projects[index], ...updatedData };
        saveProjects(projects);
        return projects[index];
    }
    
    return null;
}

function deleteProject(projectId) {
    const projects = getProjects();
    const filteredProjects = projects.filter(p => p.id !== projectId);
    saveProjects(filteredProjects);
}

function getProjects() {
    const stored = localStorage.getItem('projects');
    if (stored) {
        return JSON.parse(stored);
    }
    
    // Default projects
    return [
        {
            id: 1,
            title: "E-commerce Platform",
            description: "Plateforme e-commerce moderne avec gestion des stocks et paiements sécurisés.",
            type: "web",
            image: "https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80",
            technologies: ["React", "Node.js", "PostgreSQL", "Stripe"],
            client: "RetailCorp",
            year: "2024"
        },
        {
            id: 2,
            title: "Fitness Tracker App",
            description: "Application mobile pour le suivi d'activités physiques avec synchronisation wearables.",
            type: "mobile",
            image: "https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80",
            technologies: ["Flutter", "Firebase", "HealthKit", "Google Fit"],
            client: "FitnessPro",
            year: "2024"
        },
        {
            id: 3,
            title: "Project Management Suite",
            description: "Suite logicielle complète pour la gestion de projets d'entreprise.",
            type: "desktop",
            image: "https://images.unsplash.com/photo-1611224923853-80b023f02d71?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80",
            technologies: ["Electron", "Vue.js", "SQLite", "Chart.js"],
            client: "TechCorp",
            year: "2023"
        }
    ];
}

function saveProjects(projects) {
    localStorage.setItem('projects', JSON.stringify(projects));
}

// Utility functions
function showMessage(message, type = 'success') {
    const messageDiv = document.createElement('div');
    messageDiv.className = `message-${type} message-show`;
    messageDiv.textContent = message;
    
    document.body.appendChild(messageDiv);
    
    setTimeout(() => {
        messageDiv.classList.remove('message-show');
        setTimeout(() => messageDiv.remove(), 300);
    }, 3000);
}

// Export functions for global access
window.AstroTech = {
    addProject,
    editProject,
    deleteProject,
    getProjects,
    showMessage
};

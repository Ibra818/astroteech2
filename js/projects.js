// Projects page specific functionality

document.addEventListener('DOMContentLoaded', function() {
    loadProjects();
    initProjectModals();
    
    // Update todo
    const todos = [
        {"id": "3", "content": "Développer la page projets avec organisation par type d'application", "status": "completed", "priority": "high"},
        {"id": "9", "content": "Créer les fichiers CSS et JS personnalisés", "status": "completed", "priority": "high"}
    ];
});

function loadProjects() {
    const projects = window.AstroTech.getProjects();
    const container = document.getElementById('projects-container');
    const noProjectsMsg = document.getElementById('no-projects');
    
    if (projects.length === 0) {
        container.innerHTML = '';
        noProjectsMsg.classList.remove('hidden');
        return;
    }
    
    noProjectsMsg.classList.add('hidden');
    container.innerHTML = projects.map(project => createProjectCard(project)).join('');
    
    // Add click handlers to project cards
    container.querySelectorAll('.project-card').forEach(card => {
        card.addEventListener('click', function() {
            const projectId = parseInt(this.dataset.id);
            showProjectModal(projectId);
        });
    });
}

function createProjectCard(project) {
    const typeColors = {
        web: 'badge-web',
        mobile: 'badge-mobile', 
        desktop: 'badge-desktop'
    };
    
    const typeLabels = {
        web: 'Web',
        mobile: 'Mobile',
        desktop: 'Desktop'
    };
    
    return `
        <div class="project-card hover-lift cursor-pointer bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all" data-id="${project.id}" data-type="${project.type}">
            <div class="relative">
                <img src="${project.image}" alt="${project.title}" class="w-full h-48 object-cover">
                <div class="absolute top-4 left-4">
                    <span class="inline-block ${typeColors[project.type]} text-white text-xs font-medium px-3 py-1 rounded-full">
                        ${typeLabels[project.type]}
                    </span>
                </div>
                <div class="admin-hidden absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity">
                    <button onclick="event.stopPropagation(); editProject(${project.id})" class="bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700 transition-colors mr-2" title="Modifier le projet">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </button>
                    <button onclick="event.stopPropagation(); confirmDeleteProject(${project.id})" class="bg-red-600 text-white p-2 rounded-lg hover:bg-red-700 transition-colors" title="Supprimer le projet">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="project-info p-6">
                <div class="flex justify-between items-start mb-3">
                    <h3 class="text-xl font-display font-semibold text-gray-900">${project.title}</h3>
                    <span class="text-sm text-gray-500">${project.year}</span>
                </div>
                <p class="text-gray-600 mb-4 line-clamp-2">${project.description}</p>
                <div class="flex flex-wrap gap-2 mb-4">
                    ${project.technologies.slice(0, 3).map(tech => 
                        `<span class="bg-gray-100 text-gray-700 text-xs font-medium px-2 py-1 rounded">${tech}</span>`
                    ).join('')}
                    ${project.technologies.length > 3 ? `<span class="text-xs text-gray-500">+${project.technologies.length - 3}</span>` : ''}
                </div>
                <div class="text-sm text-gray-500">
                    <strong>Client:</strong> ${project.client}
                </div>
            </div>
        </div>
    `;
}

function showProjectModal(projectId) {
    const projects = window.AstroTech.getProjects();
    const project = projects.find(p => p.id === projectId);
    
    if (!project) return;
    
    // Update modal content
    document.getElementById('modal-title').textContent = project.title;
    document.getElementById('modal-description').textContent = project.description;
    document.getElementById('modal-client').textContent = project.client;
    document.getElementById('modal-year').textContent = project.year;
    
    const modalImage = document.getElementById('modal-image');
    modalImage.src = project.image;
    modalImage.alt = project.title;
    
    // Update technologies
    const techContainer = document.getElementById('modal-technologies');
    techContainer.innerHTML = project.technologies.map(tech => 
        `<span class="bg-primary-100 text-primary-700 text-sm font-medium px-3 py-1 rounded-full">${tech}</span>`
    ).join('');
    
    // Set up admin buttons
    const editBtn = document.getElementById('edit-project-btn');
    const deleteBtn = document.getElementById('delete-project-btn');
    
    editBtn.onclick = () => {
        hideProjectModal();
        editProject(projectId);
    };
    
    deleteBtn.onclick = () => {
        hideProjectModal();
        confirmDeleteProject(projectId);
    };
    
    // Show modal
    document.getElementById('project-modal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function hideProjectModal() {
    document.getElementById('project-modal').classList.add('hidden');
    document.body.style.overflow = '';
}

function showProjectForm(project = null) {
    const modal = document.getElementById('project-form-modal');
    const form = document.getElementById('project-form');
    const title = document.getElementById('form-modal-title');
    
    if (project) {
        title.textContent = 'Modifier le projet';
        form.elements.title.value = project.title;
        form.elements.description.value = project.description;
        form.elements.type.value = project.type;
        form.elements.client.value = project.client;
        form.elements.year.value = project.year;
        form.elements.image.value = project.image;
        form.elements.technologies.value = project.technologies.join(', ');
        form.dataset.projectId = project.id;
    } else {
        title.textContent = 'Ajouter un projet';
        form.reset();
        form.elements.year.value = new Date().getFullYear();
        delete form.dataset.projectId;
    }
    
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function hideProjectForm() {
    document.getElementById('project-form-modal').classList.add('hidden');
    document.body.style.overflow = '';
}

function editProject(projectId) {
    const projects = window.AstroTech.getProjects();
    const project = projects.find(p => p.id === projectId);
    if (project) {
        showProjectForm(project);
    }
}

function confirmDeleteProject(projectId) {
    const projects = window.AstroTech.getProjects();
    const project = projects.find(p => p.id === projectId);
    
    if (project && confirm(`Êtes-vous sûr de vouloir supprimer le projet "${project.title}" ?`)) {
        window.AstroTech.deleteProject(projectId);
        loadProjects();
        window.AstroTech.showMessage('Projet supprimé avec succès', 'success');
    }
}

function initProjectModals() {
    // Close modals
    document.getElementById('close-modal').onclick = hideProjectModal;
    document.getElementById('close-form-modal').onclick = hideProjectForm;
    document.getElementById('cancel-form').onclick = hideProjectForm;
    
    // Close modal when clicking outside
    document.getElementById('project-modal').onclick = function(e) {
        if (e.target === this) hideProjectModal();
    };
    
    document.getElementById('project-form-modal').onclick = function(e) {
        if (e.target === this) hideProjectForm();
    };
    
    // Add project button
    document.getElementById('add-project-btn').onclick = () => showProjectForm();
    
    // Project form submission
    document.getElementById('project-form').onsubmit = function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const projectData = {
            title: formData.get('title'),
            description: formData.get('description'),
            type: formData.get('type'),
            client: formData.get('client'),
            year: formData.get('year'),
            image: formData.get('image'),
            technologies: formData.get('technologies').split(',').map(t => t.trim()).filter(t => t)
        };
        
        if (this.dataset.projectId) {
            // Edit existing project
            const projectId = parseInt(this.dataset.projectId);
            window.AstroTech.editProject(projectId, projectData);
            window.AstroTech.showMessage('Projet modifié avec succès', 'success');
        } else {
            // Add new project
            window.AstroTech.addProject(projectData);
            window.AstroTech.showMessage('Projet ajouté avec succès', 'success');
        }
        
        loadProjects();
        hideProjectForm();
    };
}

// Make functions globally available
window.editProject = editProject;
window.confirmDeleteProject = confirmDeleteProject;

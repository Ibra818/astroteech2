// Admin panel functionality

document.addEventListener('DOMContentLoaded', function() {
    checkAdminAuth();
    initLogin();
    initAdminDashboard();
});

function checkAdminAuth() {
    const isLoggedIn = localStorage.getItem('adminLoggedIn') === 'true';
    const loginScreen = document.getElementById('login-screen');
    const dashboard = document.getElementById('admin-dashboard');
    
    if (isLoggedIn) {
        loginScreen.classList.add('hidden');
        dashboard.classList.remove('hidden');
        loadDashboardData();
    } else {
        loginScreen.classList.remove('hidden');
        dashboard.classList.add('hidden');
    }
}

function initLogin() {
    const loginForm = document.getElementById('login-form');
    const loginError = document.getElementById('login-error');
    
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        
        // Simple authentication (in production, use proper authentication)
        if (username === 'admin' && password === 'admin123') {
            localStorage.setItem('adminLoggedIn', 'true');
            localStorage.setItem('isAdmin', 'true');
            loginError.classList.add('hidden');
            checkAdminAuth();
        } else {
            loginError.classList.remove('hidden');
            setTimeout(() => {
                loginError.classList.add('hidden');
            }, 3000);
        }
    });
}

function initAdminDashboard() {
    // Logout functionality
    document.getElementById('logout-btn').addEventListener('click', function() {
        if (confirm('Êtes-vous sûr de vouloir vous déconnecter ?')) {
            logout();
        }
    });
    
    // Add new project button
    document.getElementById('add-new-project').addEventListener('click', function() {
        window.open('projets.html', '_blank');
    });
    
    // View public site button
    document.getElementById('view-public-site').addEventListener('click', function() {
        window.open('index.html', '_blank');
    });
}

function logout() {
    localStorage.removeItem('adminLoggedIn');
    localStorage.removeItem('isAdmin');
    checkAdminAuth();
    window.AstroTech.showMessage('Déconnexion réussie', 'success');
}

function loadDashboardData() {
    const projects = window.AstroTech.getProjects();
    
    // Update statistics
    document.getElementById('total-projects').textContent = projects.length;
    
    const webProjects = projects.filter(p => p.type === 'web').length;
    const mobileProjects = projects.filter(p => p.type === 'mobile').length;
    const desktopProjects = projects.filter(p => p.type === 'desktop').length;
    
    document.getElementById('web-projects').textContent = webProjects;
    document.getElementById('mobile-projects').textContent = mobileProjects;
    
    // Update desktop projects card
    const desktopCard = document.querySelector('#mobile-projects').closest('.bg-white');
    desktopCard.querySelector('.text-gray-500').textContent = 'Apps Desktop';
    desktopCard.querySelector('#mobile-projects').textContent = desktopProjects;
    desktopCard.querySelector('#mobile-projects').id = 'desktop-projects';
    
    // Load projects table
    loadProjectsTable(projects);
}

function loadProjectsTable(projects) {
    const tableBody = document.getElementById('projects-table-body');
    
    if (projects.length === 0) {
        tableBody.innerHTML = `
            <tr>
                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p class="text-lg font-medium mb-2">Aucun projet trouvé</p>
                    <p class="text-sm">Commencez par ajouter votre premier projet.</p>
                </td>
            </tr>
        `;
        return;
    }
    
    tableBody.innerHTML = projects.map(project => createProjectRow(project)).join('');
}

function createProjectRow(project) {
    const typeLabels = {
        web: { label: 'Web', color: 'bg-blue-100 text-blue-800' },
        mobile: { label: 'Mobile', color: 'bg-purple-100 text-purple-800' },
        desktop: { label: 'Desktop', color: 'bg-green-100 text-green-800' }
    };
    
    const typeInfo = typeLabels[project.type] || { label: project.type, color: 'bg-gray-100 text-gray-800' };
    
    return `
        <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="flex-shrink-0 h-12 w-12">
                        <img class="h-12 w-12 rounded-lg object-cover" src="${project.image}" alt="${project.title}">
                    </div>
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">${project.title}</div>
                        <div class="text-sm text-gray-500">${project.description.substring(0, 50)}...</div>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${typeInfo.color}">
                    ${typeInfo.label}
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                ${project.client}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                ${project.year}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <div class="flex space-x-2">
                    <button onclick="editProjectAdmin(${project.id})" 
                            class="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50" 
                            title="Modifier">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </button>
                    <button onclick="viewProject(${project.id})" 
                            class="text-green-600 hover:text-green-900 p-1 rounded hover:bg-green-50" 
                            title="Voir">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                    <button onclick="deleteProjectAdmin(${project.id})" 
                            class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50" 
                            title="Supprimer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
            </td>
        </tr>
    `;
}

// Admin-specific project management functions
function editProjectAdmin(projectId) {
    const projects = window.AstroTech.getProjects();
    const project = projects.find(p => p.id === projectId);
    
    if (!project) {
        window.AstroTech.showMessage('Projet non trouvé', 'error');
        return;
    }
    
    // Create inline edit form
    showEditModal(project);
}

function showEditModal(project) {
    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4';
    modal.innerHTML = `
        <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6 sm:p-8">
                <div class="flex justify-between items-start mb-6">
                    <h3 class="text-2xl font-display font-bold text-gray-900">Modifier le projet</h3>
                    <button onclick="this.closest('.fixed').remove()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <form id="edit-project-form" class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Titre du projet</label>
                        <input type="text" name="title" value="${project.title}" required 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea name="description" rows="4" required 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500">${project.description}</textarea>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                            <select name="type" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500">
                                <option value="web" ${project.type === 'web' ? 'selected' : ''}>Application Web</option>
                                <option value="mobile" ${project.type === 'mobile' ? 'selected' : ''}>Application Mobile</option>
                                <option value="desktop" ${project.type === 'desktop' ? 'selected' : ''}>Application Desktop</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Client</label>
                            <input type="text" name="client" value="${project.client}" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Année</label>
                            <input type="number" name="year" value="${project.year}" min="2020" max="2030" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">URL de l'image</label>
                            <input type="url" name="image" value="${project.image}" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Technologies (séparées par des virgules)</label>
                        <input type="text" name="technologies" value="${project.technologies.join(', ')}" required 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500">
                    </div>
                    
                    <div class="flex gap-4">
                        <button type="submit" class="bg-primary-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-primary-700 transition-colors">
                            Sauvegarder
                        </button>
                        <button type="button" onclick="this.closest('.fixed').remove()" class="border border-gray-300 text-gray-700 px-6 py-3 rounded-lg font-medium hover:bg-gray-50 transition-colors">
                            Annuler
                        </button>
                    </div>
                </form>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    
    // Handle form submission
    modal.querySelector('#edit-project-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const updatedData = {
            title: formData.get('title'),
            description: formData.get('description'),
            type: formData.get('type'),
            client: formData.get('client'),
            year: formData.get('year'),
            image: formData.get('image'),
            technologies: formData.get('technologies').split(',').map(t => t.trim()).filter(t => t)
        };
        
        window.AstroTech.editProject(project.id, updatedData);
        window.AstroTech.showMessage('Projet modifié avec succès', 'success');
        loadDashboardData();
        modal.remove();
    });
}

function viewProject(projectId) {
    window.open(`projets.html#project-${projectId}`, '_blank');
}

function deleteProjectAdmin(projectId) {
    const projects = window.AstroTech.getProjects();
    const project = projects.find(p => p.id === projectId);
    
    if (project && confirm(`Êtes-vous sûr de vouloir supprimer le projet "${project.title}" ?\n\nCette action est irréversible.`)) {
        window.AstroTech.deleteProject(projectId);
        window.AstroTech.showMessage('Projet supprimé avec succès', 'success');
        loadDashboardData();
    }
}

// Auto-refresh dashboard data every 30 seconds
setInterval(() => {
    if (!document.getElementById('admin-dashboard').classList.contains('hidden')) {
        loadDashboardData();
    }
}, 30000);

// Make functions globally available
window.editProjectAdmin = editProjectAdmin;
window.viewProject = viewProject;
window.deleteProjectAdmin = deleteProjectAdmin;

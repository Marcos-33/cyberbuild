/**
 * Main JavaScript - Cyberbuild
 * Funciones generales de la aplicación
 */

// Búsqueda en tablas
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('busqueda');
    if (searchInput) {
        searchInput.addEventListener('keydown', function() {
            filterTable();
        });
    }
});

function filterTable() {
    const input = document.getElementById('busqueda');
    if (!input) return;
    
    const filter = input.value.toLowerCase();
    const table = document.getElementById('tabla');
    if (!table) return;
    
    const rows = table.getElementsByTagName('tr');
    
    for (let i = 1; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td');
        let found = false;
        
        for (let j = 0; j < cells.length; j++) {
            if (cells[j].textContent.toLowerCase().includes(filter)) {
                found = true;
                break;
            }
        }
        
        rows[i].style.display = found ? '' : 'none';
    }
}

// Drag and drop para archivos
function setupDragAndDrop() {
    const dropArea = document.getElementById('drop-area');
    if (!dropArea) return;
    
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false);
    });
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, highlight, false);
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, unhighlight, false);
    });
    
    function highlight(e) {
        dropArea.classList.add('hover');
    }
    
    function unhighlight(e) {
        dropArea.classList.remove('hover');
    }
    
    dropArea.addEventListener('drop', handleDrop, false);
    
    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleFiles(files);
    }
    
    function handleFiles(files) {
        const fileInput = document.getElementById('fileInput');
        if (fileInput) {
            fileInput.files = files;
        }
    }
    
    dropArea.addEventListener('click', function() {
        const fileInput = document.getElementById('fileInput');
        if (fileInput) {
            fileInput.click();
        }
    });
}

// Inicializar drag and drop
setupDragAndDrop();

// Validación de formularios
function validateForm(formId) {
    const form = document.getElementById(formId);
    if (!form) return true;
    
    const inputs = form.querySelectorAll('[required]');
    let isValid = true;
    
    inputs.forEach(input => {
        if (!input.value.trim()) {
            input.classList.add('error');
            isValid = false;
        } else {
            input.classList.remove('error');
        }
    });
    
    return isValid;
}

// Confirmación antes de eliminar
function confirmDelete(message = '¿Está seguro?') {
    return confirm(message);
}

// Formato de fecha
function formatDate(dateString) {
    const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
    return new Date(dateString).toLocaleDateString('es-ES', options);
}

// Logout con confirmación
function confirmLogout() {
    return confirm('¿Deseas cerrar sesión?');
}

// Toast/Alert mejorado
function showAlert(message, type = 'info') {
    const types = ['success', 'error', 'warning', 'info'];
    const typeClass = types.includes(type) ? type : 'info';
    
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${typeClass}`;
    alertDiv.textContent = message;
    alertDiv.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        background: ${getAlertColor(typeClass)};
        color: white;
        border-radius: 8px;
        z-index: 1000;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    `;
    
    document.body.appendChild(alertDiv);
    
    setTimeout(() => {
        alertDiv.remove();
    }, 3000);
}

function getAlertColor(type) {
    const colors = {
        'success': '#10b981',
        'error': '#ef4444',
        'warning': '#f59e0b',
        'info': '#3b82f6'
    };
    return colors[type] || colors['info'];
}

// Utilidades
window.formatDate = formatDate;
window.showAlert = showAlert;
window.confirmDelete = confirmDelete;
window.confirmLogout = confirmLogout;
window.validateForm = validateForm;

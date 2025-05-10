document.addEventListener('DOMContentLoaded', function() {
    // Inicializar componentes
    initializeSidebar();
    initializeDropdowns();
    initializeDateTime();

    // Verificar y aplicar preferencias de usuario (si existen)
    checkUserPreferences();
});

/**
 * Inicializar funcionalidad del sidebar
 */
function initializeSidebar() {
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');

    // Botón de toggle para el sidebar
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            document.body.classList.toggle('sidebar-collapsed');

            // Guardar preferencia del usuario
            const isSidebarCollapsed = document.body.classList.contains('sidebar-collapsed');
            localStorage.setItem('sidebarCollapsed', isSidebarCollapsed);
        });
    }

    // En pantallas pequeñas, hacer el sidebar responsive
    if (window.innerWidth < 992) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('open');
            mainContent.classList.toggle('sidebar-open');
        });

        // Cerrar sidebar al hacer clic fuera de él en pantallas pequeñas
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.sidebar') &&
                !event.target.closest('#sidebar-toggle') &&
                sidebar.classList.contains('open')) {
                sidebar.classList.remove('open');
                mainContent.classList.remove('sidebar-open');
            }
        });
    }

    // Highlight para el link activo
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-link');

    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (href && currentPath.includes(href.replace(/^https?:\/\/[^\/]+/, ''))) {
            link.classList.add('active');

            // Si el link está en un dropdown, abrir ese dropdown
            const parentDropdown = link.closest('.dropdown-container');
            if (parentDropdown) {
                parentDropdown.classList.add('open');
                const dropdownMenu = parentDropdown.querySelector('.dropdown-menu');
                if (dropdownMenu) {
                    dropdownMenu.style.display = 'block';
                }
            }
        }
    });
}

/**
 * Inicializar menús desplegables
 */
function initializeDropdowns() {
    const dropdowns = document.querySelectorAll('.dropdown-container');

    dropdowns.forEach(dropdown => {
        const toggle = dropdown.querySelector('.dropdown-toggle');
        const menu = dropdown.querySelector('.dropdown-menu');

        // Asegurar que el menú está oculto por defecto
        if (menu) {
            menu.style.display = 'none';
        }

        if (toggle) {
            toggle.addEventListener('click', function(event) {
                event.preventDefault();

                // Cerrar otros dropdowns
                dropdowns.forEach(otherDropdown => {
                    if (otherDropdown !== dropdown) {
                        otherDropdown.classList.remove('open');
                        const otherMenu = otherDropdown.querySelector('.dropdown-menu');
                        if (otherMenu) {
                            otherMenu.style.display = 'none';
                        }
                    }
                });

                // Toggle del dropdown actual
                dropdown.classList.toggle('open');
                if (menu) {
                    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
                }
            });
        }
    });

    // En modo colapsado, mostrar dropdown al hacer hover
    if (document.body.classList.contains('sidebar-collapsed')) {
        dropdowns.forEach(dropdown => {
            dropdown.addEventListener('mouseenter', function() {
                const menu = dropdown.querySelector('.dropdown-menu');
                if (menu) {
                    menu.style.display = 'block';
                }
            });

            dropdown.addEventListener('mouseleave', function() {
                const menu = dropdown.querySelector('.dropdown-menu');
                if (menu) {
                    menu.style.display = 'none';
                }
            });
        });
    }

    // Cerrar dropdowns al hacer clic fuera
    document.addEventListener('click', function(event) {
        if (!event.target.closest('.dropdown-container')) {
            dropdowns.forEach(dropdown => {
                dropdown.classList.remove('open');
                const menu = dropdown.querySelector('.dropdown-menu');
                if (menu) {
                    menu.style.display = 'none';
                }
            });
        }
    });
}

/**
 * Inicializar y actualizar fecha y hora
 */
function initializeDateTime() {
    updateDateTime();
    setInterval(updateDateTime, 1000);
}

/**
 * Actualizar fecha y hora en tiempo real
 */
function updateDateTime() {
    const now = new Date();

    // Obtener componentes de la hora
    let hours = now.getHours();
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');
    const ampm = hours >= 12 ? 'PM' : 'AM';

    // Convertir a formato 12 horas
    hours = hours % 12;
    hours = hours ? hours : 12;

    // Obtener componentes de la fecha
    const day = String(now.getDate()).padStart(2, '0');
    const monthNames = [
        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
    ];
    const month = monthNames[now.getMonth()];
    const year = now.getFullYear();

    // Obtener el día de la semana
    const weekdayNames = [
        'Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'
    ];
    const weekday = weekdayNames[now.getDay()];

    // Crear formato HTML para fecha y hora
    const dateHtml = `
        <div class="date-part">
            <span class="weekday">${weekday}</span>,
            <span class="dia">${day}</span> de
            <span class="mes">${month}</span> de
            <span class="año">${year}</span>
        </div>
    `;

    const timeHtml = `
        <div class="time-part">
            <span class="hora">${hours}</span>:
            <span class="minuto">${minutes}</span>:
            <span class="segundo">${seconds}</span>
            <span class="am-pm">${ampm}</span>
        </div>
    `;

    // Actualizar el elemento en el DOM
    const dateTimeElement = document.getElementById('fecha-hora-actual');
    if (dateTimeElement) {
        dateTimeElement.innerHTML = dateHtml + timeHtml;
    }
}

/**
 * Verificar y aplicar preferencias del usuario guardadas en localStorage
 */
function checkUserPreferences() {
    // Verificar preferencia de sidebar colapsado
    const isSidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
    if (isSidebarCollapsed) {
        document.body.classList.add('sidebar-collapsed');
    } else {
        document.body.classList.remove('sidebar-collapsed');
    }
}

/**
 * Reiniciar las preferencias guardadas
 */
function resetUserPreferences() {
    localStorage.removeItem('sidebarCollapsed');
    document.body.classList.remove('sidebar-collapsed');
}

/**
 * Función para mostrar notificaciones usando SweetAlert
 * @param {string} title - Título de la notificación
 * @param {string} message - Mensaje de la notificación
 * @param {string} type - Tipo de notificación (success, error, warning, info)
 */
function showNotification(title, message, type = 'info') {
    Swal.fire({
        title: title,
        text: message,
        icon: type,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });
}

/**
 * Confirmar acción usando SweetAlert
 * @param {string} title - Título del diálogo de confirmación
 * @param {string} message - Mensaje de confirmación
 * @param {function} confirmCallback - Función a ejecutar si se confirma
 */
function confirmAction(title, message, confirmCallback) {
    Swal.fire({
        title: title,
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#39A900',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed && typeof confirmCallback === 'function') {
            confirmCallback();
        }
    });
}

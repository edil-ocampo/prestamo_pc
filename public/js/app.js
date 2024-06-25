document.addEventListener('DOMContentLoaded', function () {
    const dropdowns = document.querySelectorAll('.dropdown-container');

    dropdowns.forEach(dropdown => {
        const toggle = dropdown.querySelector('.nav-link');
        const menu = dropdown.querySelector('.dropdown-menu');

        // Ensure the dropdown menu is hidden by default
        menu.style.display = 'none';

        toggle.addEventListener('click', function (event) {
            event.preventDefault();
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
            
            // Toggle the 'open' class for icon rotation
            dropdown.classList.toggle('open');
        });
    });

    // Close the dropdowns if clicked outside
    document.addEventListener('click', function (event) {
        if (!event.target.closest('.dropdown-container')) {
            dropdowns.forEach(dropdown => {
                dropdown.querySelector('.dropdown-menu').style.display = 'none';
                dropdown.classList.remove('open');
            });
        }
    });
});



function mostrarFechaHora() {
    var ahora = new Date();
    var horas = ahora.getHours();
    var minutos = ahora.getMinutes();
    var segundos = ahora.getSeconds();
    var am_pm = horas >= 12 ? 'PM' : 'AM';

    // Convertir horas a formato de 12 horas
    horas = horas % 12;
    horas = horas ? horas : 12; // La medianoche debe ser 12
    minutos = minutos < 10 ? '0' + minutos : minutos;
    segundos = segundos < 10 ? '0' + segundos : segundos;

    var horaActual = `<span class="hora">${horas}</span>:<span class="minuto">${minutos}</span>:<span class="segundo">${segundos}</span> <span class="am-pm">${am_pm}</span>`;

    var dia = ahora.getDate();
    var mes = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'][ahora.getMonth()];
    var año = ahora.getFullYear();

    var fechaActual = `<span class="dia">${dia}</span>/<span class="mes">${mes}</span>/<span class="año">${año}</span>`;

    document.getElementById('fecha-hora-actual').innerHTML = `${fechaActual} - ${horaActual}`;
}

// Llamar a la función inicialmente
mostrarFechaHora();

// Actualizar la fecha y hora cada segundo (1000 milisegundos = 1 segundo)
setInterval(mostrarFechaHora, 1000);
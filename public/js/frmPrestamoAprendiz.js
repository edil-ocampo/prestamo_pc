document.addEventListener("DOMContentLoaded", function() {
    // Constante para identificar el ID del checkbox de portátil
    const PORTATIL_ID = 1;

    // Elementos del DOM
    const checkboxes = document.querySelectorAll('input[name="componente[]"]');
    const serialField = document.getElementById('serialField');
    const serialInput = document.getElementById('serial');

    // Inicializar el estado del campo de serial
    if (serialField) {
        serialField.style.display = 'none';
    }

    /**
     * Función para mostrar u ocultar el campo de serial según la selección
     */
    function toggleSerialField() {
        // Verificar si el checkbox del portátil está seleccionado
        let isPortatilChecked = false;

        checkboxes.forEach(checkbox => {
            if (parseInt(checkbox.value) === PORTATIL_ID && checkbox.checked) {
                isPortatilChecked = true;
            }
        });

        // Mostrar u ocultar el campo de serial
        if (serialField) {
            if (isPortatilChecked) {
                serialField.style.display = 'block';
                if (serialInput) serialInput.setAttribute('required', 'required');

                // Animación suave para mostrar el campo
                serialField.style.opacity = '0';
                setTimeout(() => {
                    serialField.style.transition = 'opacity 0.3s ease';
                    serialField.style.opacity = '1';
                }, 10);
            } else {
                // Animación suave para ocultar el campo
                serialField.style.transition = 'opacity 0.3s ease';
                serialField.style.opacity = '0';

                setTimeout(() => {
                    serialField.style.display = 'none';
                    if (serialInput) serialInput.removeAttribute('required');
                }, 300);
            }
        }
    }

    // Solución para el problema de no poder seleccionar checkboxes
    checkboxes.forEach(checkbox => {
        // Asegurarse de que cada checkbox tenga su label correctamente asociada
        const checkboxId = checkbox.id;
        const label = document.querySelector(`label[for="${checkboxId}"]`);

        if (label) {
            // Añadir evento de clic a la etiqueta para asegurar compatibilidad móvil
            label.addEventListener('click', function(e) {
                // Prevenir comportamiento por defecto para evitar doble clic
                e.preventDefault();

                // Cambiar estado manualmente
                checkbox.checked = !checkbox.checked;

                // Disparar el evento change manualmente para activar toggleSerialField
                const event = new Event('change', { bubbles: true });
                checkbox.dispatchEvent(event);
            });
        }

        // Añadir el evento de cambio a cada checkbox
        checkbox.addEventListener('change', function(e) {
            console.log('Checkbox changed:', this.id, 'New state:', this.checked);
            toggleSerialField();
        });

        // Solución para problemas de propagación de eventos
        checkbox.addEventListener('click', function(e) {
            // Asegurarse de que el clic funcione correctamente
            e.stopPropagation();
        });
    });

    // Ejecutar la verificación inicial
    toggleSerialField();

    // Validar el formulario antes de enviar
    const form = document.querySelector('.formulario-prestamo');

    if (form) {
        form.addEventListener('submit', function(e) {
            // Verificar si al menos un checkbox está seleccionado
            let atLeastOneChecked = false;
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    atLeastOneChecked = true;
                }
            });

            if (!atLeastOneChecked) {
                e.preventDefault();
                alert('Debe seleccionar al menos un elemento para el préstamo.');
            }
        });
    }

    // Depuración para verificar si todos los elementos están correctamente seleccionados
    console.log('Total de checkboxes:', checkboxes.length);
    console.log('Serial field encontrado:', serialField !== null);
    console.log('Serial input encontrado:', serialInput !== null);
});

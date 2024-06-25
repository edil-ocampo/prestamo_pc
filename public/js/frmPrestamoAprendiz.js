document.addEventListener("DOMContentLoaded", function() {
    const portatilValue = 1;
    const checkboxes = document.querySelectorAll('input[name="componente[]"]');
    const serialField = document.getElementById('serialField');
    
    function toggleSerialField() {
        let isPortatilChecked = false;
        checkboxes.forEach(checkbox => {
            if (checkbox.value == portatilValue && checkbox.checked) {
                isPortatilChecked = true;
            }
        });
        serialField.style.display = isPortatilChecked ? 'block' : 'none';
    }

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', toggleSerialField);
    });

    toggleSerialField();
});



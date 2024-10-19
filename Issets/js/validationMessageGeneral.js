// Función para inicializar la validación de cualquier campo
function initializeValidation(inputElement, errorMessage) {
    let errorId  = inputElement.getAttribute('data-error-target');
    console.log(errorId);

    let errorElement = document.getElementById(errorId);
    console.log(errorElement);

    const value = inputElement.tagName === 'P' ? inputElement.innerHTML.trim() : inputElement.value.trim();
    
    if (value === '' || (inputElement.tagName === 'SELECT' && inputElement.value === '')) {
        if (errorElement) {
            errorElement.style.display = 'block';
            errorElement.textContent = errorMessage;
        } else {
            console.error('No se encontró un elemento hermano para mostrar el mensaje de error.');
        }
        return false;
    } else {
        if (errorElement) {
            errorElement.style.display = 'none';
        }
        return true;
    }
}

// Función principal para validar el formulario que recibe los campos y sus mensajes
function validateForm(fields) {
    // Agregar el evento DOMContentLoaded
    document.addEventListener('DOMContentLoaded', () => {
        // Recorrer los campos y añadir eventos de validación
        for (const [fieldId, errorMessage] of Object.entries(fields)) {
            const fieldElement = document.getElementById(fieldId);

            // Asegurar que el campo existe antes de agregar los eventos
            if (fieldElement) {
                fieldElement.addEventListener('input', () => initializeValidation(fieldElement, errorMessage));
                fieldElement.addEventListener('change', () => initializeValidation(fieldElement, errorMessage));
            }
        }
    });

    // Obtener el formulario y los campos
    const form = document.querySelector('form');
    let isValid = true;

    // Validar cada campo al enviar el formulario
    for (const [fieldId, errorMessage] of Object.entries(fields)) {
        const fieldElement = document.getElementById(fieldId);

        if (fieldElement) {
            // Validar el campo actual
            isValid = initializeValidation(fieldElement, errorMessage) && isValid;
        }
    }

    // Si todos los campos son válidos, enviar el formulario
    if (isValid) {
        form.submit();
    }
}

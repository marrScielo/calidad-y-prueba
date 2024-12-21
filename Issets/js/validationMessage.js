// Función para inicializar la validación de un formulario
function initializeValidation(inputElement, errorMessage) {
    let errorElement = inputElement.nextElementSibling;

    const value = inputElement.tagName === 'P' ? inputElement.innerHTML.trim() : inputElement.value.trim();

    if (value === '' || (inputElement.tagName === 'SELECT' && inputElement.value === '')) {
        if (errorElement) {
            errorElement.classList.add('show'); // Muestra el mensaje
            errorElement.textContent = errorMessage;
        }
        return false;
    } else {
        if (errorElement) {
            errorElement.classList.remove('show'); // Oculta el mensaje
        }
        return true;
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('.form__blog');
    const topic = document.querySelector('#topic');
    const specialty = document.querySelector('#specialty');
    const descriptionElement = document.querySelector('#description');
    const image = document.querySelector('#image');
    const icon = document.querySelector('#arrowIcon');

    // Validación del formulario al enviar
    form.addEventListener('submit', (e) => {
        e.preventDefault(); // Previene el envío del formulario para pruebas

        let isValid = true;

        isValid = initializeValidation(topic, 'Por favor, llene el campo de tema') && isValid;
        isValid = initializeValidation(specialty, 'Por favor, seleccione una especialidad') && isValid;
        isValid = initializeValidation(descriptionElement, 'Por favor, ingrese una descripción') && isValid;
        isValid = initializeValidation(image, 'Por favor, ingrese url válida donde esta la imagen') && isValid;

        if (isValid) {
            form.submit(); // Envía el formulario si todos los campos son válidos
        }
    });

    // Validación en tiempo real
    topic.addEventListener('input', () => initializeValidation(topic, 'Por favor, llene el campo de tema'));
    specialty.addEventListener('change', () => initializeValidation(specialty, 'Por favor, seleccione una especialidad'));
    image.addEventListener('input', () => initializeValidation(image, 'Por favor, ingrese url válida donde esta la imagen'));

    // Rotación del ícono
    specialty.addEventListener('click', () => {
        if (icon.classList.contains('rotated')) {
            icon.classList.remove('rotated');
        } else {
            icon.classList.add('rotated');
        }
    });

    
});

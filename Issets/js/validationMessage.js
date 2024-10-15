// Función para inicializar la validación de un formulario
function initializeValidation(inputElement, errorMessage) {
    let errorElement = inputElement.nextElementSibling;
    
    const value = inputElement.tagName === 'P' ? inputElement.innerHTML.trim() : inputElement.value.trim();
    
    if (value === '' || (inputElement.tagName === 'SELECT' && inputElement.value === '')) {
        if (errorElement) {
            errorElement.style.display = 'block';
            errorElement.textContent = errorMessage;
        } else {
            console.error('No se encontró un elemento hermano para mostrar el mensaje de error.');
            console.log(inputElement);
        }
        return false;
    } else {
        if (errorElement) {
            errorElement.style.display = 'none';
        }
        return true;
    }
}

document.addEventListener('DOMContentLoaded', (event) => {
    event.preventDefault();
    const form = document.querySelector('.form__blog');

    const topic = document.querySelector('#topic');
    const specialty = document.querySelector('#specialty');
    const descriptionElement = document.querySelector('#description');
    const image = document.querySelector('#image');

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

    // Agregar eventos de entrada para eliminar mensajes de error cuando el usuario corrija el campo
    topic.addEventListener('input', () => initializeValidation(topic, 'Por favor, llene el campo de tema'));
    specialty.addEventListener('change', () => initializeValidation(specialty, 'Por favor, seleccione una especialidad'));
    // descriptionElement.addEventListener('input', () => initializeValidation(descriptionElement, 'Por favor, ingrese una descripción'));
    image.addEventListener('input', () => initializeValidation(image, 'Por favor, ingrese url válida donde esta la imagen'));
});
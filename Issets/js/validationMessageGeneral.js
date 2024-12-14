// Función para inicializar la validación de cualquier campo
function initializeValidation(inputElement, errorMessage) {
    let errorId = inputElement.getAttribute('data-error-target')
    let errorElement = document.getElementById(errorId)

    const value =
        inputElement.tagName === 'P'
            ? inputElement.innerHTML.trim()
            : inputElement.value.trim()

    // Validación específica para el campo de Email
    if (inputElement.id === 'Email') {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/ // Expresión regular para validar email
        if (value !== '' && !emailPattern.test(value)) {
            if (errorElement) {
                errorElement.style.display = 'block'
                errorElement.textContent = 'Email inválido'
            }
            return false
        }
    }

    // Validación específica para el campo de Teléfono
    if (inputElement.id === 'TelefonoContacto') {
        if (value !== '' && value.length !== 9) {
            if (errorElement) {
                errorElement.style.display = 'block'
                errorElement.textContent = 'El teléfono debe tener 9 dígitos'
            }
            return false
        }
    }

    // Validación general para campos vacíos
    if (
        value === '' ||
        (inputElement.tagName === 'SELECT' && inputElement.value === '')
    ) {
        if (errorElement) {
            errorElement.style.display = 'block'
            errorElement.textContent = errorMessage
        } else {
            console.error(
                'No se encontró un elemento hermano para mostrar el mensaje de error.'
            )
        }
        return false
    } else {
        if (errorElement) {
            errorElement.style.display = 'none'
        }
        return true
    }
}

// Función para inicializar los eventos de validación
function initializeValidationEvents(fields) {
    for (const [fieldId, errorMessage] of Object.entries(fields)) {
        const fieldElement = document.getElementById(fieldId)
        if (fieldElement) {
            fieldElement.addEventListener('input', () =>
                initializeValidation(fieldElement, errorMessage)
            )
            fieldElement.addEventListener('change', () =>
                initializeValidation(fieldElement, errorMessage)
            )
        }
    }
}

// Función principal para validar el formulario que recibe los campos y sus mensajes
function validateForm(fields) {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () =>
            initializeValidationEvents(fields)
        )
    } else {
        initializeValidationEvents(fields)
    }

    let isValid = true

    for (const [fieldId, errorMessage] of Object.entries(fields)) {
        const fieldElement = document.getElementById(fieldId)

        if (fieldElement) {
            isValid =
                initializeValidation(fieldElement, errorMessage) && isValid
        }
    }

    return isValid
}

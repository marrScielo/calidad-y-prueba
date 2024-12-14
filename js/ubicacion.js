$(document).ready(function () {
    // Carga dinámica de provincias al seleccionar un departamento
    // $('#Departamento').change(function (event) {
    //     event.preventDefault();
    //     var departamentoId = $(this).val();
    //     obtenerProvincias(departamentoId);
    // });

    // // Carga dinámica de distritos al seleccionar una provincia
    // $('#Provincia').change(function (event) {
    //     event.preventDefault();
    //     var provinciaId = $(this).val();
    //     obtenerDistritos(provinciaId);
    // });

    // Función para obtener las provincias mediante AJAX
    // function obtenerProvincias(departamentoId) {
    //     $.ajax({
    //         url: '../Crud/Fetch/obtenerProvincias.php',
    //         method: 'POST',
    //         data: { departamentoId: departamentoId },
    //         dataType: 'json',
    //         success: function (provincias) {
    //             var selectProvincia = $('#Provincia');
    //             selectProvincia.empty();
    //             selectProvincia.append('<option value="">Seleccionar</option>');

    //             $.each(provincias, function (key, provincia) {
    //                 selectProvincia.append('<option value="' + provincia.id + '">' + provincia.name + '</option>');
    //             });
    //         },
    //         error: function (xhr, status, error) {
    //             console.error('Error al obtener las provincias:', error);
    //         }
    //     });
    // }

    // Función para obtener los distritos mediante AJAX
    // function obtenerDistritos(provinciaId) {
    //     $.ajax({
    //         url: '../Crud/Fetch/obtenerDistritos.php',
    //         method: 'POST',
    //         data: { provinciaId: provinciaId },
    //         dataType: 'json',
    //         success: function (distritos) {
    //             var selectDistrito = $('#Distrito');
    //             selectDistrito.empty();
    //             selectDistrito.append('<option value="">Seleccionar</option>');

    //             $.each(distritos, function (key, distrito) {
    //                 selectDistrito.append('<option value="' + distrito.id + '">' + distrito.name + '</option>');
    //             });
    //         },
    //         error: function (xhr, status, error) {
    //             console.error('Error al obtener los distritos:', error);
    //         }
    //     });
    // }

    // Mostrar notificación si el formulario se envió correctamente
    window.addEventListener('DOMContentLoaded', (event) => {
        const notification = document.getElementById('notification')
        const notificationText = document.getElementById('notification-text')

        const urlParams = new URLSearchParams(window.location.search)
        const enviado = urlParams.get('enviado')

        if (enviado === 'true') {
            notification.style.display = 'block'
            notificationText.textContent = 'Enviado Correctamente ✔️'
            history.replaceState(null, null, window.location.pathname)
        }
    })

    // Validar DNI: solo permite 8 dígitos numéricos
    $('input#Dni').keypress(function (event) {
        if (event.which < 48 || event.which > 57 || this.value.length === 8) {
            return false
        }
    })

    // Validar Teléfono: solo permite 9 dígitos numéricos y que empiece con 9
    // Función para validar el input de teléfono
    function validatePhoneInput(selector) {
        $(selector).keypress(function (event) {
            var keyCode = event.which
            var inputValue = String.fromCharCode(keyCode)
            console.log(inputValue)

            // Validar que solo se permitan números y que la longitud no exceda 9
            if (keyCode < 48 || keyCode > 57 || this.value.length === 9) {
                return false
            }

            // Validar que el primer dígito sea 9
            if (this.value.length === 0 && inputValue !== '9') {
                return false
            }
        })
    }

    // Aplicar la validación a ambos inputs
    validatePhoneInput('input#Telefono')
    validatePhoneInput('input#TelefonoContacto')

    // Verificar DNI en tiempo real y deshabilitar campos si ya existe
    $('#Dni').on('keyup', function () {
        var Dni = $('#Dni').val()
        var longitudDni = $('#Dni').val().length

        if (longitudDni >= 3) {
            var dataString = 'Dni=' + Dni

            $.ajax({
                url: '../Crud/Fetch/vereficardni.php',
                type: 'GET',
                data: dataString,
                dataType: 'JSON',
                success: function (datos) {
                    if (datos.success == 1) {
                        $('#respuesta')
                            .html(datos.message)
                            .css('display', 'block')
                        $('input').attr('disabled', true)
                        $('input#Dni').attr('disabled', false)
                        $('#submitButton').attr('disabled', true)
                    } else {
                        $('#respuesta')
                            .html(datos.message)
                            .css('display', 'block')
                        $('input').attr('disabled', false)
                        $('#submitButton').attr('disabled', false)
                    }
                }
            })
        }
    })

    // Verificar Teléfono en tiempo real y deshabilitar campos si ya existe
    $('#Telefono').on('keyup', function () {
        var Telefono = $('#Telefono').val()
        var longitudTelefono = $('#Telefono').val().length

        if (longitudTelefono >= 3) {
            var dataString = 'Telefono=' + Telefono

            $.ajax({
                url: '../Crud/Fetch/vereficarcelular.php',
                type: 'GET',
                data: dataString,
                dataType: 'JSON',
                success: function (datos) {
                    if (datos.success == 1) {
                        $('#respuesta2').html(datos.message)
                        $('input').attr('disabled', true)
                        $('input#Telefono').attr('disabled', false)
                        $('#submitButton').attr('disabled', true)
                    } else {
                        $('#respuesta2').html(datos.message)
                        $('input').attr('disabled', false)
                        $('#submitButton').attr('disabled', false)
                    }
                }
            })
        }
    })

    // Verificar Email en tiempo real y deshabilitar campos si ya existe
    $('#Email').on('keyup', function () {
        var Email = $('#Email').val()
        var longitudEmail = $('#Email').val().length

        if (longitudEmail >= 3) {
            var dataString = 'Email=' + Email

            $.ajax({
                url: '../Crud/Fetch/vereficaremail.php',
                type: 'GET',
                data: dataString,
                dataType: 'JSON',
                success: function (datos) {
                    if (datos.success == 1) {
                        $('#respuesta3').html(datos.message)
                        $('input').attr('disabled', true)
                        $('input#Email').attr('disabled', false)
                        $('#submitButton').attr('disabled', true)
                    } else {
                        $('#respuesta3').html(datos.message)
                        $('input').attr('disabled', false)
                        $('#submitButton').attr('disabled', false)
                    }
                }
            })
        }
    })

    // Calcular la edad según la fecha de nacimiento al cambiar la fecha
    $('#FechaNacimiento').on('change', function () {
        calcularEdad()
    })

    // Función para calcular la edad y mostrarla en el campo correspondiente
    function calcularEdad() {
        var fechaNacimiento = $('#FechaNacimiento').val()
        var fechaActual = new Date()
        var edad =
            fechaActual.getFullYear() - new Date(fechaNacimiento).getFullYear()

        if (
            fechaActual.getMonth() < new Date(fechaNacimiento).getMonth() ||
            (fechaActual.getMonth() === new Date(fechaNacimiento).getMonth() &&
                fechaActual.getDate() < new Date(fechaNacimiento).getDate())
        ) {
            edad--
        }
        $('#Edad').val(edad)
    }
})

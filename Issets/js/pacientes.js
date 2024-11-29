const $modalDeletePaciente = document.getElementById('modalDeletePaciente')
const $closeModalDeletePaciente = document.getElementById(
    'closeModalDeletePaciente'
)
const $modalEditPaciente = document.getElementById('modalEditarPaciente')
const $tableContainerPaciente = document.querySelector('.recent-citas')
const $closeModalEditPaciente = document.getElementById(
    'closeModalEditPaciente'
)
const $btnCancelDeletePaciente = document.getElementById(
    'btnCancelDeletePaciente'
)
const $btnCancelEditPaciente = document.getElementById('btnCancelEditPaciente')

updateEventButtonListeners()
$closeModalDeletePaciente.addEventListener('click', function () {
    $modalDeletePaciente.classList.remove('active')
})
$btnCancelEditPaciente.addEventListener('click', closeModalEditPaciente)

$closeModalEditPaciente.addEventListener('click', closeModalEditPaciente)
function closeModalEditPaciente() {
    $modalEditPaciente.classList.remove('active')
}
$btnCancelDeletePaciente.addEventListener('click', function () {
    $modalDeletePaciente.classList.remove('active')
})

const showInfoLinks = document.querySelectorAll('.show-info')
const additionalColumns = document.querySelectorAll('.additional-column')
const containerpacientetabla = document.querySelector(
    '.container-paciente-tabla'
)
const modalNewAppointment = document.querySelector('#modalNewAppointment')
const patientDetails = document.querySelector('.patient-details')
const buttonAgregar = document.querySelector('.button_1')
let currentPatientId = null // Variable para rastrear el paciente actual
const buttonsCitas = document.querySelectorAll('.buttoncita')
const btnCloseModalNewAppointment = document.querySelector(
    '#btnCloseModalNewAppointment'
)
const cerrarModalCreateCita = () => {
    modalNewAppointment.classList.remove('active')
    containerpacientetabla.classList.remove('active')
}
document
    .getElementById('checkboxPrincipal')
    .addEventListener('change', function () {
        var checkboxes = document.querySelectorAll('.checkbox')
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = this.checked
        }
    })

$(document).ready(function () {
    $('#myInput').on('keyup', function () {
        var value = $(this).val().toLowerCase()
        $('#myTable tr').filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        })
    })
})

// Agrega un evento de clic al botón "Eliminar Seleccionados"
document
    .getElementById('eliminarSeleccionados')
    .addEventListener('click', function () {
        var checkboxes = document.querySelectorAll('.checkbox:checked') // Obtén todos los checkboxes marcados
        var idsAEliminar = []

        // Recorre los checkboxes seleccionados y obtén sus valores (IDs)
        checkboxes.forEach(function (checkbox) {
            idsAEliminar.push(checkbox.value)
        })

        // Verifica si se han seleccionado checkboxes
        if (idsAEliminar.length > 0) {
            // Realiza la solicitud para eliminar registros desde la base de datos
            eliminarRegistros(idsAEliminar)
        } else {
            alert('Por favor, selecciona al menos un paciente para eliminar.')
        }
    })

//ELIMINAR PACIENTE
async function getAppointmentById(id) {
    return fetch(`../Crud/Paciente/pacienteService.php?idPaciente=${id}`)
        .then((response) => {
            if (!response.ok) {
                throw new Error('Error al obtener la cita.')
            }
            const data = response.json()
            return data
        })
        .catch((error) => console.error('Error:', error))
}

function updateDeleteAppointmentModal(appointment) {
    console.log(appointment['IdPaciente'])
    document.querySelector(
        '#buttonDeletePacienteById'
    ).href = `../Crud/Paciente/eliminarPaciente.php?id=${appointment['Dni']}`
    document.querySelector(
        '#namePaciente'
    ).textContent = `${appointment.NomPaciente} ${appointment.ApPaterno} ${appointment.ApMaterno}`
    $modalDeletePaciente.classList.add('active')
}

function updateEventButtonListeners() {
    const appointmentsRowButtons = document.querySelectorAll(
        '.appointmentTable__buttons'
    )
    appointmentsRowButtons.forEach((row) => {
        row.addEventListener('click', async function (event) {
            const idRow = row.parentElement.id.split('-')[1]
            const response = await getAppointmentById(idRow)
            // Usar closest() para verificar si se hizo clic en el botón o dentro de él
            if (event.target.closest('.appointmentTuple__button--edit')) {
                updateEditPacienteModal(response)
            } else if (
                event.target.closest('.appointmentTuple__button--delete')
            ) {
                $modalDeletePaciente.classList.add('active')
                updateDeleteAppointmentModal(response)
            }
        })
    })
}
function calcularEdad(fechaNacimiento) {
    const hoy = new Date()
    const fechaNac = new Date(fechaNacimiento)
    let edad = hoy.getFullYear() - fechaNac.getFullYear()
    const mesActual = hoy.getMonth() + 1
    const mesNacimiento = fechaNac.getMonth() + 1

    if (
        mesActual < mesNacimiento ||
        (mesActual === mesNacimiento && hoy.getDate() < fechaNac.getDate())
    ) {
        edad--
    }

    return edad
}

//actualizar modal de editar paciente
function updateEditPacienteModal(appointment) {
    $modalEditPaciente.querySelector(
        '#pacientetTitle'
    ).textContent = `Modificar datos de ${appointment.NomPaciente}`
    $modalEditPaciente.querySelector('#idCita').value = appointment.IdPaciente
    $modalEditPaciente.querySelector('#IdPaciente').value =
        appointment.IdPaciente
    $modalEditPaciente.querySelector('#NomPaciente').value =
        appointment.NomPaciente
    $modalEditPaciente.querySelector('#Dni').value = appointment.Dni
    $modalEditPaciente.querySelector('#ApPaterno').value = appointment.ApPaterno
    $modalEditPaciente.querySelector('#ApMaterno').value = appointment.ApMaterno
    $modalEditPaciente.querySelector('#FechaNacimiento').value =
        appointment.FechaNacimiento
    //calcular automatico
    $modalEditPaciente.querySelector('#Edad').value = calcularEdad(
        appointment.FechaNacimiento
    )
    $modalEditPaciente.querySelector('#GradoInstruccion').value =
        appointment.GradoInstruccion
    $modalEditPaciente.querySelector('#Ocupacion').value = appointment.Ocupacion
    $modalEditPaciente.querySelector('#EstadoCivil').value =
        appointment.EstadoCivil
    $modalEditPaciente.querySelector('#Genero').value = appointment.Genero
    $modalEditPaciente.querySelector('#Telefono').value = appointment.Telefono
    $modalEditPaciente.querySelector('#Email').value = appointment.Email
    $modalEditPaciente.querySelector('#Direccion').value = appointment.Direccion
    $modalEditPaciente.querySelector('#AntecedentesMedicos').value =
        appointment.AntecedentesMedicos
    $modalEditPaciente.querySelector('#MedicamentosPrescritos').value =
        appointment.MedicamentosPrescritos
    $modalEditPaciente.querySelector('#IdPsicologo').value =
        appointment.IdPsicologo
    $modalEditPaciente.querySelector('#IdProvincia').value =
        appointment.IdProvincia
    $modalEditPaciente.querySelector('#IdDistrito').value =
        appointment.IdDistrito
    $modalEditPaciente.querySelector('#IdDepartamento').value =
        appointment.IdDepartamento

    $modalEditPaciente.classList.add('active')
    $tableContainerPaciente.classList.add('active')
    cerrarModalCreateCita()
}

// Función para eliminar registros desde la base de datos
function eliminarRegistros(idsAEliminar) {
    // Realiza una solicitud AJAX para enviar los IDs a tu script de eliminación en el servidor
    var xhr = new XMLHttpRequest()
    xhr.open('POST', '../Crud/Fetch/eliminar_registros.php', true)
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')

    // Define lo que hacer cuando la solicitud se complete
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Recarga la página o actualiza la tabla después de eliminar
            location.reload()
        } else {
            console.error('Error en la solicitud: ' + xhr.statusText)
        }
    }

    // Envia la solicitud con los IDs a eliminar
    xhr.send('ids=' + JSON.stringify(idsAEliminar))
}

var checkboxes = document.querySelectorAll('.checkbox')
var botonEliminar = document.getElementById('eliminarSeleccionados')

checkboxes.forEach(function (checkbox) {
    checkbox.addEventListener('change', function () {
        var almenosUnCheckboxSeleccionado = false

        checkboxes.forEach(function (cb) {
            if (cb.checked) {
                almenosUnCheckboxSeleccionado = true
                return
            }
        })

        if (almenosUnCheckboxSeleccionado) {
            botonEliminar.style.display = 'flex'
        } else {
            botonEliminar.style.display = 'none'
        }
    })
})

var checkboxPrincipal = document.getElementById('checkboxPrincipal')
var botonEliminar = document.getElementById('eliminarSeleccionados')

checkboxPrincipal.addEventListener('change', function () {
    if (checkboxPrincipal.checked) {
        botonEliminar.style.display = 'flex'
    } else {
        botonEliminar.style.display = 'none'
    }
})

showInfoLinks.forEach((link) => {
    link.addEventListener('click', () => {
        // Obtener el ID del paciente desde el atributo data
        modalNewAppointment.classList.remove('active')
        const patientId = link.getAttribute('data-patient-id')

        // Ocultar las columnas adicionales
        additionalColumns.forEach((column) => {
            column.classList.add('hidden')
            containerpacientetabla.classList.add('active')
        })

        // Obtener todos los botones dentro de la tabla
        const allButtons = document.querySelectorAll('.button_1')

        // Mostrar todos los botones
        allButtons.forEach((button) => {
            button.style.display = 'block'
        })

        // Restaurar el contenido de los botones si es necesario
        allButtons.forEach((button) => {
            button.innerHTML = `
            <div class="butt">
                <span class="material-symbols-sharp">add</span>Crear Cita
            </div>
            `
        })

        // Obtener los datos del paciente
        const codigo = link.getAttribute('data-codigo')
        const dni = link.getAttribute('data-dni')
        const genero = link.getAttribute('data-genero')
        const edad = link.getAttribute('data-edad')
        const estadocivil = link.getAttribute('data-estadocivil')
        const nombres = link.getAttribute('data-nombres')
        const email = link.getAttribute('data-email')
        const celular = link.getAttribute('data-celular')

        // Obtener los datos del área familiar
        const nombreMadre = link.getAttribute('data-nombre-madre')
        const estadoMadre = link.getAttribute('data-estado-madre')
        const nombrePadre = link.getAttribute('data-nombre-padre')
        const estadoPadre = link.getAttribute('data-estado-padre')
        const cantHermanos = link.getAttribute('data-cant-hermanos')
        const antecedentesFamiliares = link.getAttribute(
            'data-antecedentes-familiares'
        )

        const FechaInicioCita = link.getAttribute('FechaInicioCita')

        console.log(`Enlace ${codigo}`)
        // Crear el contenido de los detalles del paciente
        const patientInfoHTML = `
            <div style="display:grid; flex-direction:row; gap:10px;">
                <div class="checkout-informationPac">
                    <div class="input-group3">
                        <a class="cerrar">
                            <span style="color:#52BF92 ; font-size:47px;cursor: pointer;" class="material-symbols-sharp">arrow_circle_left</span>
                        </a>
                        <div class="Letras" >
                            <p class="visual">${nombres}</p>
                            <div class="input-group_1">
                                <p class="arriba" for="#">Última cita: </p>
                                <h2 class="arriba">${
                                    FechaInicioCita || 'Aun no hay cita'
                                }</h2>
                            </div>
                        </div>                            
                        <p class="arriba ids" for="#">ID: ${codigo}</p>
                    </div>
                    
                </div>
                <div style="display:flex; flex-direction:row; gap:10px;">
                <!-------MI CAMBIO ------>
                    <div class="checkout-informationPac">
                    <p class="arriba">Datos específicos: </p>
                        <div class="input-group4">
                            <p class="abajo" for="Genero">Género</p>
                            <p class="arriba">${genero}</p>
                        </div>
                        <div class="input-group4">
                            <p class="abajo" for="Genero">Edad</p>
                            <p class="arriba">${edad}</p>
                        </div>
                        <div class="input-group4">
                            <p class="abajo" for="#">Estado civil</p>
                            <p class="arriba">${estadocivil}</p>
                        </div>
                    </div>
                <!-------FIN DE MI CAMBIO ------>

                    <div class="checkout-informationPac">
                    <p class="arriba">Información de contacto: </p>
                        <div class="input-group4">
                            <p class="abajo" for="Genero">Celular</p>
                            <p class="arriba">${celular}</p>  
                        </div>
                        <div class="input-group4">
                            <p class="abajo" for="#">Correo</p>
                        <p class="arriba">${email}</p>
                        </div>
                        <div class="input-group4">
                            <p class="abajo" for="#">DNI</p>
                        <p class="arriba">${dni}</p>
                        </div>
                    </div>
                <!------ Linea de separacion entre mi display flex y grid ---->
                </div>

                <div style="display:flex; flex-direction:row; gap:10px;">
                    <div class="checkout-informationPac">
                        <p class="arriba">Información personal: </p>
                        <div class="input-group4">
                            <p class="abajo" for="Genero">Nombres y apellidos</p>
                            <p class="arriba">${nombres}</p>
                        </div>
                        <div class="input-group4">
                            <p class="abajo" for="#">Correo</p>
                            <p class="arriba">${email}</p>
                        </div>
                        <div class="input-group4">
                            <p class="abajo" for="#">DNI</p>
                            <p class="arriba">${dni}</p>
                        </div>
                    </div>
                    <div class="checkout-informationPac">
                        <p class="arriba">Información familiar: </p>
                        <div class="input-group4">
                            <p class="abajo" for="Genero">Nombre de la madre</p>
                            <p class="arriba">${
                                nombreMadre || 'No hay registros'
                            }</p>
                        </div>
                        <div class="input-group4">
                            <p class="abajo" for="#">Estado de la madre</p>
                            <p class="arriba">${
                                estadoMadre || 'No hay registros'
                            }</p>
                        </div>
                        <div class="input-group4">
                            <p class="abajo" for="#">Nombre del padre</p>
                            <p class="arriba">${
                                nombrePadre || 'No hay registros'
                            }</p>
                        </div>
                        <div class="input-group4">
                            <p class="abajo" for="#">Estado del padre</p>
                            <p class="arriba">${
                                estadoPadre || 'No hay registros'
                            }</p>
                        </div>
                        <div class="input-group4">
                            <p class="abajo" for="#">Cantidad de hermanos</p>
                            <p class="arriba">${
                                cantHermanos || 'No hay registros'
                            }</p>
                        </div>
                        <div class="input-group4">
                            <p class="abajo" for="#">Antecedentes familiares</p>
                            <p class="arriba">${
                                antecedentesFamiliares || 'No hay registros'
                            }</p>
                        </div>
                    </div>
                    <!----Linea de separacion entre el formulario y los botones ---->
                </div>    
            </div>
            `

        // Mostrar la información en el elemento .patient-details
        patientDetails.innerHTML = patientInfoHTML

        // Mostrar el cuadro de detalles
        patientDetails.style.display = 'block'

        currentPatientId = patientId // Actualizar el ID del paciente actual

        // Selecciona todos los elementos con la clase "cerrar"
        const elementosCerrar = document.querySelectorAll('.cerrar')

        // Agrega un controlador de eventos de clic a cada elemento de cierre
        elementosCerrar.forEach((elementoCerrar) => {
            elementoCerrar.addEventListener('click', () => {
                // Restaurar las columnas ocultas
                additionalColumns.forEach((column) => {
                    column.classList.remove('hidden')
                })

                // Quitar la clase 'active' del contenedor
                containerpacientetabla.classList.remove('active')

                // Ocultar el cuadro de detalles
                patientDetails.style.display = 'none'
                // Mostrar todos los botones
                allButtons.forEach((button) => {
                    button.style.display = 'none'
                })
                currentPatientId = null // Restablecer el ID del paciente actual
            })
        })
    })
})

buttonsCitas.forEach((button) => {
    button.addEventListener('click', () => {
        const idSelected = button.getAttribute('data-patient-id')
        const codeSelected = button.getAttribute('data-patient-code')
        console.log('click', idSelected)
        console.log('click code', codeSelected)
        closeModalEditPaciente()
        modalNewAppointment.classList.add('active')
        // containerpacientetabla.classList.add('active')
        document.querySelector('#IdPaciente').value = idSelected
        document.querySelector('#codigopac').value = codeSelected
        // get info paciente
        const data = fetch(
            `../Crud/Paciente/pacienteService.php?idPaciente=${idSelected}`
        )
            .then((response) => response.json())
            .then((data) => {
                console.log(data)
                modalNewAppointment.querySelector('#Paciente').value =
                    data.NomPaciente +
                    ' ' +
                    data.ApMaterno +
                    ' ' +
                    data.ApPaterno
                modalNewAppointment.querySelector('#NomPaciente').value =
                    data.NomPaciente
                modalNewAppointment.querySelector('#IdPaciente').value =
                    data.IdPaciente
            })
    })
})

btnCloseModalNewAppointment.addEventListener('click', cerrarModalCreateCita)

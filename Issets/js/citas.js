let currentAppointmentSelectedId = null
// Elementos del DOM
const $appointmentsTable = document.getElementById('appointmentsTable')
const $tableContainer = document.querySelector('.recent-citas')
const $inputSearchForName = document.getElementById('searchForName')
const $inputSearchForCode = document.getElementById('searchForCode')
const $inputSearchForDateStart = document.getElementById('searchForDateStart')
const $inputSearchForDateEnd = document.getElementById('searchForDateEnd')
let $appointmentsRowButtons = document.querySelectorAll(
    '.appointmentTable__buttons'
)
const idPsicologo = document.getElementById('idPsicologo').textContent
const $modalEditAppointment = document.getElementById('modalEditAppointment')
const $closeModalEditAppointment = document.getElementById(
    'closeModalEditAppointment'
)
const $btnCancelEditAppointment = document.getElementById(
    'btnCancelEditAppointment'
)
const $btnCancelDeleteAppointment = document.getElementById(
    'btnCancelDeleteAppointment'
)
const $modalDeleteAppointment = document.getElementById(
    'modalDeleteAppointment'
)
const $closeModalDeleteAppointment = document.getElementById(
    'closeModalDeleteAppointment'
)
const checkboxes = document.querySelectorAll('.checkbox')
const checkboxPrincipal = document.getElementById('checkboxPrincipal')
const botonEliminar = document.getElementById('eliminarSeleccionados')

// Eventos

$closeModalEditAppointment.addEventListener('click', closeModalEditAppointment)
$closeModalDeleteAppointment.addEventListener('click', function () {
    $modalDeleteAppointment.classList.remove('active')
})
$btnCancelDeleteAppointment.addEventListener('click', function () {
    $modalDeleteAppointment.classList.remove('active')
})
$btnCancelEditAppointment.addEventListener('click', function () {
    $modalEditAppointment.classList.remove('active')
})
$inputSearchForName.addEventListener('input', searchAppointments)
$inputSearchForCode.addEventListener('input', searchAppointments)
$inputSearchForDateStart.addEventListener('change', searchAppointments)
$inputSearchForDateEnd.addEventListener('change', searchAppointments)
updateEventButtonListeners()
async function searchAppointments() {
    const name = $inputSearchForName.value.trim() || null
    const code = $inputSearchForCode.value.trim() || null
    const dateStart = formatDateTime($inputSearchForDateStart.value) || null
    const dateEnd = formatDateTime($inputSearchForDateEnd.value) || null
    const params = new URLSearchParams()
    params.append('idPsicologo', idPsicologo)

    if (name) params.append('NomPaciente', name)
    if (code) params.append('codigo', code)
    if (dateStart && dateEnd) {
        params.append('dateStart', dateStart)
        params.append('dateEnd', dateEnd)
        console.log('Cambios en la fecha')
        console.log(params.toString())
    }

    await fetch(`../Crud/Cita/citaServices.php?${params.toString()}`)
        .then((response) => {
            if (!response.ok) {
                throw new Error('Error al realizar la búsqueda.')
            }
            return response.json()
        })
        .then((data) => {
            const { citas } = data
            console.log(data)
            $appointmentsTable.innerHTML = ''
            if (citas.length === 0) {
                $appointmentsTable.innerHTML =
                    '<tr><td colspan="8">No se encontraron citas.</td></tr>'
                return
            }

            citas.forEach((appointment) => {
                $appointmentsTable.innerHTML +=
                    createAppointmentRow(appointment)
            })
        })
        .catch((error) => console.error('Error:', error))
    updateEventButtonListeners()
}
async function getAppointmentById(id) {
    return fetch(
        `../Crud/Cita/citaServices.php?idPsicologo=${idPsicologo}&IdCita=${id}`
    )
        .then((response) => {
            if (!response.ok) {
                throw new Error('Error al obtener la cita.')
            }
            const data = response.json()
            return data
        })
        .catch((error) => console.error('Error:', error))
}
function createAppointmentRow(appointment) {
    return `
        <tr class="appointmentTuple">
            <td><input type="checkbox" class="checkbox"></td>
            <td>${appointment.NomPaciente}</td>
            <td>${appointment.codigopac}</td>
            <td>${appointment.MotivoCita}</td>
            <td>${appointment.EstadoCita}</td>
            <td>${appointment.FechaInicioCita}</td>
            <td style="color:#4CAF50">${appointment.Duracioncita}</td>
            <td id="appointmentId-${appointment.IdCita}">
                <div class="appointmentTable__buttons">
                    <button class="appointmentTuple__button appointmentTuple__button--edit btnm">
                        <span class="material-symbols-outlined" translate="no">edit</span>
                        <p>Editar</p>
                    </button>
                    <button class="appointmentTuple__button appointmentTuple__button--delete btne">
                        <span class="material-symbols-outlined" translate="no">delete</span>
                        <p>Eliminar</p>
                    </button>
                </div>
            </td>
        </tr>
    `
}
function updateEventButtonListeners() {
    $appointmentsRowButtons = document.querySelectorAll(
        '.appointmentTable__buttons'
    )
    $appointmentsRowButtons.forEach((row) => {
        row.addEventListener('click', async function (event) {
            const idRow = row.parentElement.id.split('-')[1]
            currentAppointmentSelectedId = idRow
            console.log('Id de la cita seleccionada:', idRow)

            const { citas: dataAppointment } = await getAppointmentById(idRow)
            // Usar closest() para verificar si se hizo clic en el botón o dentro de él
            if (event.target.closest('.appointmentTuple__button--edit')) {
                updateEditAppointmentModal(dataAppointment[0])
            } else if (
                event.target.closest('.appointmentTuple__button--delete')
            ) {
                $modalDeleteAppointment.classList.add('active')
                updateDeleteAppointmentModal(dataAppointment[0])
                console.log('Eliminar cita con id:', idRow)
            }
        })
    })
}
function formatDateTime(inputDate) {
    if (!inputDate) return null

    const date = new Date(inputDate)

    const year = date.getFullYear()
    const month = String(date.getMonth() + 1).padStart(2, '0') // Los meses empiezan en 0, por eso se suma 1
    const day = String(date.getDate()).padStart(2, '0')

    const hours = String(date.getHours()).padStart(2, '0')
    const minutes = String(date.getMinutes()).padStart(2, '0')
    const seconds = String(date.getSeconds()).padStart(2, '0')

    // Formatear la fecha en "YYYY-MM-DD HH:MM:SS"
    return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`
}

function updateEditAppointmentModal(appointment) {
    $modalEditAppointment.querySelector('#appointmentId').value =
        appointment.IdCita
    $modalEditAppointment.querySelector(
        '#appointmentTitle'
    ).textContent = `Editar cita de ${appointment.NomPaciente}`
    $modalEditAppointment.querySelector('#appointmentType').value =
        appointment.TipoCita
    $modalEditAppointment.querySelector('#startDate').value =
        appointment.FechaInicioCita.split(' ')[0] // select
    $modalEditAppointment.querySelector('#startTime').value =
        appointment.FechaInicioCita.split(' ')[1] // select
    $modalEditAppointment.querySelector('#duration').value =
        appointment.Duracioncita
    $modalEditAppointment.querySelector('#appointmentStatus').value =
        appointment.EstadoCita
    $modalEditAppointment.querySelector('#appointmentReason').value =
        appointment.MotivoCita
    $modalEditAppointment.classList.add('active')
    $tableContainer.classList.add('active')
}
function updateDeleteAppointmentModal(appointment) {
    document.querySelector(
        '#buttonDeleteAppointmentById'
    ).href = `../Crud/Cita/eliminarCita.php?id=${appointment.IdCita}`
    document.querySelector(
        '#nameUser'
    ).textContent = `${appointment.NomPaciente}`
    console.log($modalDeleteAppointment)
    $modalDeleteAppointment.classList.add('active')
}
function closeModalEditAppointment() {
    $modalEditAppointment.classList.remove('active')
}

// ------------------------------------------------
//          CODIGO ANTERIOR
// ------------------------------------------------
botonEliminar.addEventListener('click', function () {
    var checkboxes = document.querySelectorAll('.checkbox:checked')
    var idsAEliminar = []

    checkboxes.forEach(function (checkbox) {
        idsAEliminar.push(checkbox.value)
    })

    // Verifica si se han seleccionado checkboxes
    if (idsAEliminar.length > 0) {
        eliminarRegistros(idsAEliminar)
    } else {
        alert('Por favor, selecciona al menos un paciente para eliminar.')
    }
})

function eliminarRegistros(idsAEliminar) {
    var xhr = new XMLHttpRequest()
    xhr.open('POST', '../Crud/Fetch/eliminar_citas.php', true)
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')

    xhr.onload = function () {
        if (xhr.status === 200) {
            // Recarga la página o actualiza la tabla después de eliminar
            location.reload()
        } else {
            console.error('Error en la solicitud: ' + xhr.statusText)
        }
    }
    xhr.send('ids=' + JSON.stringify(idsAEliminar))
}

checkboxes.forEach(function (checkbox) {
    checkbox.addEventListener('change', function () {
        var almenosUnCheckboxSeleccionado = false

        checkboxes.forEach(function (cb) {
            if (cb.checked) {
                almenosUnCheckboxSeleccionado = true
            }
        })

        if (almenosUnCheckboxSeleccionado) {
            botonEliminar.style.display = 'flex'
        } else {
            botonEliminar.style.display = 'none'
        }
    })
})

checkboxPrincipal.addEventListener('change', function () {
    if (checkboxPrincipal.checked) {
        botonEliminar.style.display = 'flex'
    } else {
        botonEliminar.style.display = 'none'
    }
    var checkboxes = document.querySelectorAll('.checkbox')
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = this.checked
    }
})

let currentAppointmentSelectedId = null
const $appointmentsTable = document.getElementById('appointmentsTable')
const $inputSearchForName = document.getElementById('searchForName')
const $inputSearchForCode = document.getElementById('searchForCode')
const $inputSearchForDateStart = document.getElementById('searchForDateStart')
const $inputSearchForDateEnd = document.getElementById('searchForDateEnd')
const $appointmentsRowButtons = document.querySelectorAll(
    '.appointmentTable__buttons'
)
const idPsicologo = document.getElementById('idPsicologo').textContent
const $modalEditAppointment = document.getElementById('modalEditAppointment')
const checkboxes = document.querySelectorAll('.checkbox')
const checkboxPrincipal = document.getElementById('checkboxPrincipal')
const botonEliminar = document.getElementById('eliminarSeleccionados')
function searchAppointments() {
    const name = $inputSearchForName.value.trim() || null
    const code = $inputSearchForCode.value.trim() || null
    const dateStart = formatDateTime($inputSearchForDateStart.value) || null
    const dateEnd = formatDateTime($inputSearchForDateEnd.value) || null
    console.log('Buscando citas por fecha: ' + dateStart + ' ' + dateEnd)
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

    fetch(`../Crud/Cita/citaServices.php?${params.toString()}`)
        .then((response) => {
            if (!response.ok) {
                throw new Error('Error al realizar la búsqueda.')
            }
            return response.json()
        })
        .then((data) => {
            $appointmentsTable.innerHTML = ''
            if (data.length === 0) {
                $appointmentsTable.innerHTML =
                    '<tr><td colspan="8">No se encontraron citas.</td></tr>'
                return
            }

            data.forEach((appointment) => {
                $appointmentsTable.innerHTML +=
                    createAppointmentRow(appointment)
            })
        })
        .catch((error) => console.error('Error:', error))
}

$inputSearchForName.addEventListener('input', searchAppointments)
$inputSearchForCode.addEventListener('input', searchAppointments)
$inputSearchForDateStart.addEventListener('change', searchAppointments)
$inputSearchForDateEnd.addEventListener('change', searchAppointments)
$appointmentsRowButtons.forEach((row) => {
    row.addEventListener('click', async function (event) {
        const idRow = row.parentElement.id.split('-')[1]
        currentAppointmentSelectedId = idRow
        console.log('Id de la cita seleccionada:', idRow)
        const $buttonEdit = row.querySelector('.appointmentTuple__button--edit')
        const $buttonDelete = row.querySelector(
            '.appointmentTuple__button--delete'
        )
        // Usar closest() para verificar si se hizo clic en el botón o dentro de él
        if (event.target.closest('.appointmentTuple__button--edit')) {
            const dataAppointment = await getAppointmentById(idRow)
            console.log(dataAppointment)
            updateAppointmentModal(dataAppointment[0])
        } else if (event.target.closest('.appointmentTuple__button--delete')) {
            // Aquí puedes agregar lo que quieres hacer para el botón de eliminar
            console.log('Eliminar cita con id:', idRow)
        }
    })
})
function getAppointmentById(id) {
    return fetch(
        `../Crud/Cita/citaServices.php?idPsicologo=${idPsicologo}&IdCita=${id}`
    )
        .then((response) => {
            if (!response.ok) {
                throw new Error('Error al obtener la cita.')
            }
            return response.json()
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
            <td>${appointment.Duracioncita}</td>
            <td id="appointmentId-${appointment.IdCita}">
                <div class="appointmentTable__buttons">
                    <button class="appointmentTuple__button appointmentTuple__button--edit">
                        <span class="material-symbols-outlined">edit</span>
                    </button>
                    <button class="appointmentTuple__button appointmentTuple__button--delete">
                        <span class="material-symbols-outlined">delete</span>
                    </button>
                </div>
            </td>
        </tr>
    `
}
function formatDateTime(inputDate) {
    if (!inputDate) return null

    // Crear un nuevo objeto Date a partir del valor del input (que es YYYY-MM-DD)
    const date = new Date(inputDate)

    // Obtener las partes de la fecha y hora
    const year = date.getFullYear()
    const month = String(date.getMonth() + 1).padStart(2, '0') // Los meses empiezan en 0, por eso se suma 1
    const day = String(date.getDate()).padStart(2, '0')

    // Obtener la hora actual (o puedes asignar una hora fija como 00:00:00 si lo prefieres)
    const hours = String(date.getHours()).padStart(2, '0')
    const minutes = String(date.getMinutes()).padStart(2, '0')
    const seconds = String(date.getSeconds()).padStart(2, '0')

    // Formatear la fecha en "YYYY-MM-DD HH:MM:SS"
    return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`
}

function updateAppointmentModal(appointment) {
    $modalEditAppointment.querySelector('#appointmentId').value =
        appointment.IdCita
    $modalEditAppointment.querySelector(
        '#appointmentTitle'
    ).textContent = `Editar cita de ${appointment.NomPaciente}`
    $modalEditAppointment.querySelector('#appointmentType').value =
        appointment.TipoCita
    $modalEditAppointment.querySelector('#startDate').value =
        appointment.FechaInicioCita
    // select
    $modalEditAppointment.querySelector('#duration').value =
        appointment.Duracioncita
    $modalEditAppointment.classList.add('active')
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

const $appointmentsTable = document.getElementById('appointmentsTable')
const checkboxes = document.querySelectorAll('.checkbox')
const checkboxPrincipal = document.getElementById('checkboxPrincipal')
const botonEliminar = document.getElementById('eliminarSeleccionados')
const $inputSearchForName = document.getElementById('searchForName')
const $inputSearchForCode = document.getElementById('searchForCode')
const $inputSearchForDateStart = document.getElementById('searchForDateStart')
const $inputSearchForDateEnd = document.getElementById('searchForDateEnd')
function searchAppointments() {
    const idPsicologo = document.getElementById('idPsicologo').textContent

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
        // addd in this format 2023-11-11 13:59:00
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

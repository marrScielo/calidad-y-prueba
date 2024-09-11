const checkboxes = document.querySelectorAll('.checkbox')
const checkboxPrincipal = document.getElementById('checkboxPrincipal')
const botonEliminar = document.getElementById('eliminarSeleccionados')
const $inputSearchForName = document.getElementById('searchForName')

$inputSearchForName.addEventListener('input', function () {
    var searchValue = $inputSearchForName.value
    const idPsicologo = document.getElementById('idPsicologo').textContent
    console.log(searchValue)
    console.log(idPsicologo)
    if (searchValue.length > 0) {
        fetch(
            `../Crud/Cita/citaServices.php?idPsicologo=${idPsicologo}&NomPaciente=${searchValue}`
        )
            .then((response) => response.json())
            .then((data) => {
                console.log(data)
            })
            .catch((error) => console.error('Error:', error))
    }
})

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

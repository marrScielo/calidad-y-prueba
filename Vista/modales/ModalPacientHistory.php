<div class="patient-details" id="patient-details">
    <div style="display:grid; flex-direction:row; gap:10px;position:relative;">
        <span class="close" id="closeModal" onclick="closePatientDetails()">&times;</span>
        <div class="top-group">
            <div class="name">
                <h2 class="visual2">${nombres}</h2>
                <p class="arriba">${edad} años | DNI: ${dni}</p>
                <p class="arriba">Celular: ${celular} | Código: ${codigo} </p>

                <button type="button" class="green-button" id="butto">Ver Historial Medico</button>
            </div>
            <div class="date">
                <h6>${fechaFormateadaDM } </h6>
                <p>Ultima Atención</p>
            </div>
        </div>
        <div class="ci-input-group" style="display: none;">
            <h2 class="arriba" for="#">Enfermedad </h2>
            <p class="abajo">Id Enfermedad: ${enfermedad || 'Aun no hay enfermedad'}</p>
        </div>
        <div class="ci-input-group">
            <h1 for="#">ÚLTIMA ATENCIÓN </h1>
        </div>
        <div class="ci-input-group">
            <h2 class="arriba" for="#">Diagnóstico </h2>
            <p class="abajo">${diagnostico || 'Aun no hay diagnóstico'}</p>
        </div>
        <div class="ci-input-group">
            <h2 class="arriba" for="#">Observación </h2>
            <p class="abajo">${observacion || 'Aun no hay observacion'}</p>
        </div>
        <div class="ci-input-group">
            <h2 class="arriba" for="#">Ultimos Objetivos </h2>
            <p class="abajo">${objetivo || 'Aun no hay objetivos'}</p>
        </div>
        <div class="ci-input-group">
            <h2 class="arriba" for="#">Fecha Atención </h2>
            <p class="abajo">${fechaFormateada || 'Aun no hay previa atención'}</p>
        </div>

        <br>
        <textarea id="notaTextarea2">${nota  || 'Aun no comentarios'}</textarea>
        <br>
        <button styler=" cursor: pointer;" id="actualizarBtn">Actualizar</button>

        <button style=" cursor: pointer;" id="addNotaBtn">Editar Nota</button>

        <div class="BUT">
            <a href="RegAtencionPaciente.php" class="green-button" id="button2">Atención Paciente</a>
        </div>



    </div>
    <form id="patientForm" style="display:none;">
        <label for="patientId">Ingrese el ID del paciente:</label>
        <input type="text" id="patientId" name="patientId" required>
        <button type="button" id="showAllPatientsButton">Mostrar Detalles del Paciente</button>
    </form>
</div>

<script>
patientId = 4
const patient = document.querySelector(`[data-patient-id="${patientId}"]`);
// Obtener los datos del paciente
const nombres = patient.getAttribute('data-nombres');
const edad = patient.getAttribute('data-edad');
const dni = patient.getAttribute('data-dni');
const celular = patient.getAttribute('data-celular');
const codigo = patient.getAttribute('data-codigo');
const enfermedad = patient.getAttribute('data-enfermedad');
const diagnostico = patient.getAttribute('data-diagnostico');
const observacion = patient.getAttribute('data-observacion');
const FechaInicioCita = patient.getAttribute('data-FechaInicioCita');
const nota = patient.getAttribute('data-nota');
const objetivo = patient.getAttribute('data-objetivo');
</script>
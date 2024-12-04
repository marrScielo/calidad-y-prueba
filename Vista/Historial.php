<?php
session_start();
if (isset($_SESSION['NombrePsicologo'])) {
?>
    <?php
    require_once '../conexion/conexion.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['patientId']) && isset($_POST['observacion']) && isset($_POST['diagnostico']) && isset($_POST['tratamiento']) && isset($_POST['objetivos'])) {
        // Obtener los valores del formulario
        $patientId = $_POST['patientId'];
        $diagnostico = $_POST['diagnostico'];
        $tratamiento = $_POST['tratamiento'];
        $observacion = $_POST['observacion'];
        $objetivos = $_POST['objetivos'];

        // Realizar la actualización en la base de datos
        $sql = "UPDATE atencionpaciente 
            SET Observacion = :observacion, 
                Diagnostico = :diagnostico, 
                Tratamiento = :tratamiento, 
                UltimosObjetivos = :objetivos 
            WHERE IdAtencion = :patientId";

        try {
            $con = new conexion();
            $conn = $con->getPDO();
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':patientId', $patientId, PDO::PARAM_INT);
            $stmt->bindParam(':observacion', $observacion, PDO::PARAM_STR);
            $stmt->bindParam(':diagnostico', $diagnostico, PDO::PARAM_STR);
            $stmt->bindParam(':tratamiento', $tratamiento, PDO::PARAM_STR);
            $stmt->bindParam(':objetivos', $objetivos, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            echo json_encode(['error' => 'Error en la conexión: ' . $e->getMessage()]);
        }
    }


    // NUEVO CODIGO : PARA IMPLEMENTAR ACTUALIZACION DE LA NOTA
    // **********************************************************************************

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['dni']) && isset($_POST['nota'])) {
            $dni = $_POST['dni'];
            $nota = $_POST['nota'];
            $con = new conexion();
            $conn = $con->getPDO();
            $stmt = $conn->prepare("UPDATE paciente SET nota = :nota WHERE Dni = :dni");
            $stmt->bindParam(':dni', $dni, PDO::PARAM_INT);
            $stmt->bindParam(':nota', $nota, PDO::PARAM_STR);
            $stmt->execute();
            echo "Nota actualizada";
            exit;
        }
    }

    $nota = "";
    if (isset($_GET['dni'])) {
        $dni = $_GET['dni'];
        $con = new conexion();
        $conn = $con->getPDO();
        $stmt = $conn->prepare("SELECT nota FROM paciente WHERE Dni = :dni");
        $stmt->bindParam(':dni', $dni, PDO::PARAM_INT);
        $stmt->execute();
        $nota = $stmt->fetchColumn();
    }

    // ***************************************************************************************************

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../Issets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,1,0" />
        <link rel="stylesheet" href="../Issets/css/main.css">
        <link rel="stylesheet" href="./css/index.css">
        <link rel="stylesheet" href="../Issets/css/historial.css">
        <link rel="icon" href="../img/favicon.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <title>Datos de Paciente</title>
    </head>
    <style>
        @media (max-width: 900px) {
            .animate_animated {
                overflow: auto;
            }

            .center-divs {
                min-width: 800px;
            }
        }

        /* Estilo para el modal principal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 999;
            backdrop-filter: blur(5px);
            justify-content: center;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.1);
            ;
        }

        .green-button {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            position: relative;
            /* Añade esta línea para que la posición absoluta de la 'x' sea relativa al modal */
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            width: 70%;
            max-width: 80%;
            box-shadow: 0 2rem 3rem var(--color-light);
            border-radius: 20px;
            position: relative;
            /* Añade esta línea para que la posición absoluta de la 'x' sea relativa al modal */
        }

        .modal-content-detail {
            position: relative;
            /* Añade esta línea para que la posición absoluta de la 'x' sea relativa al modal */
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            width: 70%;
            max-width: 600px;
            box-shadow: 0 2rem 3rem var(--color-light);
            border-radius: 20px;
            position: relative;

        }

        .modal-content h2 {
            color: #52C291;
        }

        .modal-content-detail h2 {
            color: #52C291;
        }

        /* Estilo para el botón de cerrar el modal (la 'x') */
        .close {
            color: #000;
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
            z-index: 1;
            /* Añade esta línea para que la 'x' esté por encima del contenido del modal */
        }

        /* Estilo para el botón de cerrar el modal (la 'x') cuando se pasa el ratón sobre él */
        .close:hover {
            color: red;
        }

        /* Estilo para resaltar el título de cada paciente */
        .patient-div p:first-child {
            font-weight: bold;
        }

        /* Agrega estilos a la tabla */
        .table-container {
            background-color: var(--color-white);
            /*box-shadow: var(--box-shadow);*/
            border-radius: 30px;
            grid-row: 1;
            padding: 1rem 0rem 1.5rem 0rem;
            overflow: auto;
            /* Agrega desplazamiento si la tabla es larga */
        }

        /* Estilos para la tabla */
        table {
            width: 100%;
            /* border-spacing: 0.5rem; */
        }

        /* Estilos para las celdas de la tabla */
        td {
            text-align: center;
        }

        /* Estilos para el botón "Ver Detalles" dentro del modal de historial */
        .ver-detalles-button,
        .actualizar-nota-button,
        .button_update_note,
        #addNotaBtn,
        #actualizarBtn {
            width: 130px;
            height: 30px;
            border-radius: 30px;
            font-size: 10.2px;
            background-color: #52C291;
            color: white;
            justify-content: flex-end;

            /* Transición suave para el color de fondo */
        }

        .button_update_note {
            margin-top: 10px;
        }

        .ver-detalles-button:hover,
        .actualizar-nota-button:hover,
        .button_update_note {
            color: var(--color-dark);
            font-weight: 700;
            cursor: pointer;
            background-color: var(--color-white);
            border: 1.5px solid var(--color-primary);
            transition: all 0.5s ease-in-out;
        }


        #notaTextArea {
            height: 100px;
        }

        /* Resto de tu estilo para el modal */
        /* ... */


        /** ************ NUEVOS DISEÑOS PARA EL BLOC */
        #notaTextarea2 {
            display: none;
            /* Oculto por defecto */
            width: 100%;
            height: 100px;
        }

        #actualizarBtn {
            display: none;
            /* Oculto por defecto */
        }
    </style>

    <body translate="no">
        <?php
        require_once("../Controlador/Paciente/ControllerPaciente.php");
        $Pac = new usernameControlerPaciente();
        $patients = $Pac->showCompletoAtencion($_SESSION['IdPsicologo']);
        ?>
        <div class="container">
            <?php
            require_once '../Issets/views/Menu.php';
            ?>
            <!----------- end of aside -------->
            <main class="animate_animated animate_fadeIn">
                <div class="center-divs">
                    <h4 style="color: #49c691;">Historial de Pacientes</h4>
                    <?php
                    require_once '../Issets/views/Info.php';
                    ?>
                </div>
                <div class="recent-updates">
                    <div class="input-buscador">
                        <span id="search-icon"><i class="fas fa-search"></i></span>
                        <input type="text" id="searchPacienteName" placeholder="Buscar Paciente" class="input" required>
                    </div>
                    <a class="button-arriba" style="padding:10px 30px;" href="RegAtencionPaciente.php">
                        <i id="search-icon" class="fas fa-plus-circle add-icon" style="margin-right: 10px;"></i>Agregar Atencion
                    </a>
                </div>
                <!-- Encabezado de la tabla -->

                <div class="container-paciente-tabla" translate="no">
                    <div class="container-table">
                        <table>
                            <thead class="table-head">
                                <tr>
                                    <th>Paciente</th>
                                    <th>Fecha de Próxima Cita</th>
                                    <th>Diagnostico</th>
                                </tr>
                            </thead>
                            <tbody id="tableNomPaciente" class="table-body">
                                <?php foreach ($patients as $index => $patient) :
                                ?>
                                    <tr style="cursor:pointer" class="show-info">
                                        <td>
                                            <a
                                                data-patient-id="<?= $patient['IdPaciente'] ?>"
                                                data-nombres="<?= $patient['NomPaciente'] ?> <?= $patient['ApPaterno'] ?> <?= $patient['ApMaterno'] ?>"
                                                data-edad="<?= $patient['Edad'] ?>"
                                                data-dni="<?= $patient['Dni'] ?>"
                                                data-celular="<?= $patient['Telefono'] ?>"
                                                data-codigo="<?= $patient['codigopac'] ?>"
                                                data-diagnostico="<?= $patient['Diagnostico'] ?>"
                                                data-enfermedad="<?= $patient['IdEnfermedad'] ?>"
                                                data-observacion="<?= $patient['Observacion'] ?>"
                                                data-FechaInicioCita="<?= $patient['FechaRegistro'] ?>"
                                                data-nota="<?= $patient['nota'] ?>"
                                                data-objetivo="<?= $patient['UltimosObjetivos'] ?>">
                                                <p style="cursor: pointer;" class="nombre-paciente">
                                                    <?= $patient['NomPaciente'] ?> <?= $patient['ApPaterno'] ?></p>
                                            </a>
                                        </td>
                                        <td><?= isset($patient['FechaRegistro']) ? substr($patient['FechaRegistro'], 0, 10) : 'Fecha de próx cita' ?>
                                        </td>
                                        <td><?= isset($patient['Diagnostico']) ? $patient['Diagnostico'] : 'Diagnostico' ?></td>
                                        <td class="additional-column" style="display: none;"
                                            data-patient-id="<?= $patient[0] ?>"></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>

                    <div class="patient-details" id="patient-details">
                        <div style="display:grid; flex-direction:row; gap:10px;position:relative;" id="info-pacient">
                            <span class="close" id="closeModal" onclick="closePatientDetails()">&times;</span>
                            <div class="top-group">
                                <div class="name">
                                    <h2 class="visual2" id="patient-name">${nombres}</h2>
                                    <!-- <p id="patient-info"></p> -->
                                    <p class="arriba" id="patient-age-dni">${edad} años | DNI: ${dni}</p>
                                    <p class="arriba" id="patient-phone">${celular} | Código: ${codigo}</p>
                                    <p class="arriba" id="patient-id">${celular} | Código: ${codigo}</p>
                                    <button type="button" class="green-button" id="view-medical-history-btn">Ver Historial
                                        Medico</button>
                                </div>
                                <div class="date">
                                    <h6 id="last-appointment-date">${fechaFormateadaDM}</h6>
                                    <p>Última Atención</p>
                                </div>
                            </div>
                            <div class="ci-input-group" style="display: none;">
                                <h2 class="arriba" for="disease-info">Enfermedad</h2>
                                <p class="abajo" id="disease-id">${enfermedad || 'Aun no hay enfermedad'}</p>
                            </div>
                            <!-- Aquí se mostrarán los detalles de la ultima atencion del paciente -->

                            <div class="component-ultima-atencion">
                                <div class="ci-input-group">
                                    <h1 for="last-attention">ÚLTIMA ATENCIÓN</h1>
                                </div>
                                <div class="ci-input-group">
                                    <h2 class="arriba" for="diagnosis-info">Diagnóstico</h2>
                                    <p class="abajo" id="diagnosis">${diagnostico || 'Aun no hay diagnóstico'}</p>
                                </div>
                                <div class="ci-input-group">
                                    <h2 class="arriba" for="observation-info">Observación</h2>
                                    <p class="abajo" id="observation">${observacion || 'Aun no hay observación'}</p>
                                </div>
                                <div class="ci-input-group">
                                    <h2 class="arriba" for="objectives-info">Últimos Objetivos</h2>
                                    <p class="abajo" id="objectives">${objetivo || 'Aun no hay objetivos'}</p>
                                </div>
                                <div class="ci-input-group">
                                    <h2 class="arriba" for="appointment-date-info">Fecha Atención</h2>
                                    <p class="abajo" id="appointment-date">${fechaFormateada || 'Aun no hay previa atención'}</p>
                                </div>
                                <div class="ci-input-group">
                                    <textarea id="notes-textarea">${nota || 'Aun no hay comentarios'}</textarea>
                                </div>
                                <div>
                                    <button style="cursor: pointer;" id="update-btn">Actualizar</button>
                                    <button style="cursor: pointer;" id="edit-note-btn">Editar Nota</button>
                                </div>

                            </div>

                            <!-- Aquí se mostrarán que el paciente no cuenta con atenciones-->
                            <h1 id="no-attention-message" style="display: none; margin-top: 50px">Este paciente no cuenta con atenciones anteriores</h1>

                            <div class="BUT">
                                <a class="green-button" id="patient-attention-btn">Agegar atención</a>
                            </div>

                            <!-- Aquí se mostrarán los detalles del paciente -->
                            <form id="patientForm" style="display:none;">
                                <label for="patientId">Ingrese el ID del paciente:</label>
                                <input type="text" id="patientId" name="patientId" required>
                                <button type="button" id="showAllPatientsButton">Mostrar Detalles del Paciente</button>
                            </form>
                        </div>
                    </div>

                    <div class=" modal" id="patientModal">
                        <div class="modal-content">
                            <span class="close" id="closeModal" onclick="closePatientModal()">&times;</span>
                            <h2 class="modal-title">Historial de Atenciones </h2>
                            <div class="modal-body">
                                <!-- Aquí se mostrarán los detalles del paciente -->
                            </div>
                        </div>
                    </div>
                    <div class="modal" id="historyModal">
                        <div class="modal-content-detail">
                            <span class="close" id="closeHistoryModal" onclick="closeHistoryModal()">&times;</span>
                            <h2 class="modal-title">Detalles del Historial del Paciente</h2>
                            <div class="modal-body" id="historyModalBody">
                                <!-- Aquí se mostrarán los detalles del historial del paciente -->
                            </div>
                        </div>
                    </div>

            </main>

        </div>
        <script src="../Issets/js/dashboard.js"></script>
        <script>
            const detailsContainer = document.querySelector('.details');
            const infoPacient = document.querySelector('#info-pacient');
            const tableRows = document.querySelectorAll('table tr');
            tableRows.forEach(function(row) {

            });

            const showInfoLinks = document.querySelectorAll('.show-info');
            const additionalColumns = document.querySelectorAll('.additional-column');
            const containerPacienteTabla = document.querySelector('.container-paciente-tabla');
            const patientDetails = document.querySelector('.patient-details');
            let currentPatientId = null; // Variable para rastrear el paciente actual





            showInfoLinks.forEach(link => {
                link.addEventListener('click', function() {

                    // Obtener el ID del paciente desde el atributo data
                    const patientId = link.querySelector("td a").getAttribute('data-patient-id');

                    console.log(patientId);



                    // Ocultar las columnas adicionales
                    additionalColumns.forEach(column => {
                        column.classList.add('hidden');
                        containerPacienteTabla.classList.add('active');
                    });

                    // Obtener los datos del paciente
                    const id = link.querySelector("td a").getAttribute('data-patient-id');
                    const nombres = link.querySelector("td a").getAttribute('data-nombres');
                    const edad = link.querySelector("td a").getAttribute('data-edad');
                    const dni = link.querySelector("td a").getAttribute('data-dni');
                    const celular = link.querySelector("td a").getAttribute('data-celular');
                    const codigo = link.querySelector("td a").getAttribute('data-codigo');
                    const diagnostico = link.querySelector("td a").getAttribute('data-diagnostico');
                    const enfermedad = link.querySelector("td a").getAttribute('data-enfermedad');
                    const observacion = link.querySelector("td a").getAttribute('data-observacion');
                    const FechaInicioCita = link.querySelector("td a").getAttribute('data-FechaInicioCita');
                    const nota = link.querySelector("td a").getAttribute('data-nota');
                    const objetivo = link.querySelector("td a").getAttribute('data-objetivo');
                    // Formatear la fecha en español
                    const opcionesFecha = {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    };
                    const fechaFormateada = FechaInicioCita ? new Date(FechaInicioCita).toLocaleDateString(
                        'es-ES', opcionesFecha) : 'Aún no hay cita';

                    let fechaFormateadaDM = '--/--';
                    if (FechaInicioCita) {
                        const fecha = new Date(FechaInicioCita);
                        const dia = String(fecha.getDate()).padStart(2, '0');
                        const mes = String(fecha.getMonth() + 1).padStart(2,
                            '0'); // getMonth() devuelve un número entre 0 y 11, por lo que sumamos 1
                        fechaFormateadaDM = `${dia}/${mes}`;
                    }

                    const enfermedadId = link.getAttribute('data-enfermedad');
                    // Asignar los datos a los elementos del DOM
                    infoPacient.querySelector('#patient-name').textContent = nombres;
                    // infoPacient.querySelector('#patient-info').textContent = `${edad} años | DNI: ${dni}`;
                    infoPacient.querySelector('#patient-age-dni').textContent = `${edad} años | DNI: ${dni}`;
                    infoPacient.querySelector('#patient-phone').textContent = `Celular: ${celular}`;
                    infoPacient.querySelector('#patient-id').textContent = `Código: ${codigo}`;
                    infoPacient.querySelector('#disease-id').textContent = enfermedad ||
                        'Aun no hay enfermedad';
                    infoPacient.querySelector('#diagnosis').textContent = diagnostico ||
                        'Aun no hay diagnóstico';
                    infoPacient.querySelector('#observation').textContent = observacion ||
                        'Aun no hay observación';
                    infoPacient.querySelector('#objectives').textContent = objetivo || 'Aun no hay objetivos';
                    infoPacient.querySelector('#appointment-date').textContent = fechaFormateada ||
                        'Aun no hay previa atención';
                    infoPacient.querySelector('#notes-textarea').textContent = nota || 'Aun no hay comentarios';
                    infoPacient.querySelector('#last-appointment-date').textContent = fechaFormateadaDM;

                    // Condicional para ocultar el elemento si no hay atenciones anteriores
                    const ultimaAtencionComponent = document.querySelector('.component-ultima-atencion');
                    const noAttentionMessage = document.getElementById('no-attention-message');
                    if (!FechaInicioCita) {
                        ultimaAtencionComponent.style.display = 'none';
                        noAttentionMessage.style.display = 'block';
                    } else {
                        ultimaAtencionComponent.style.display = 'block';
                        noAttentionMessage.style.display = 'none';
                    }

                    patientDetails.style.display = 'block';
                    currentPatientId = patientId;

                    document.getElementById('edit-note-btn').addEventListener('click', function() {
                        const textarea2 = document.getElementById('notaTextarea2');
                        const actualizarBtn = document.getElementById('actualizarBtn');
                        const addNotaBtn = document.getElementById('addNotaBtn');

                        textarea2.style.display = 'block';
                        actualizarBtn.style.display = 'block';
                        addNotaBtn.style.display = 'none';

                        // Aquí obtendremos el campo nota de la base de datos
                        fetch('?dni=' + dni)
                            .then(response => response.text())
                            .then(data => {
                                textarea.value = data;
                            });
                    });

                    document.getElementById('update-btn').addEventListener('click', function() {
                        const nota = document.getElementById('notaTextarea2').value;
                        const addNotaBtn = document.getElementById('addNotaBtn');


                        fetch('', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded'
                                },
                                body: 'dni=' + dni + '&nota=' + encodeURIComponent(nota)
                            })
                            .then(response => response.text())
                            .then(data => {
                                alert('Nota actualizada');
                                // Ocultar textarea y botón actualizar
                                document.getElementById('notaTextarea2').style.display = 'none';
                                document.getElementById('actualizarBtn').style.display = 'none';
                                addNotaBtn.style.display = 'block';
                            });



                    });

                    // Ir a Registro de Atencion
                    document.getElementById('patient-attention-btn').addEventListener('click', function() {
                        window.location.href = 'RegAtencionPaciente.php?id=' + patientId;
                    });

                    // **************************************************************************************************

                    document.querySelector("#view-medical-history-btn").addEventListener('click', function() {
                        var patientModal = document.getElementById('patientModal');
                        var modalBody = document.querySelector('.modal-body');
                        var patientId = document.getElementById('patientId').value;

                        // Centra el modal al abrir
                        patientModal.style.display = 'flex';
                        modalBody.innerHTML = ''; // Limpiar el contenido anterior
                        patientModal.style.top = '50%';
                        patientModal.style.left = '50%';
                        patientModal.style.transform = 'translate(-50%, -50%)';

                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', '../Crud/Fetch/fetch_historial.php', true);
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                        xhr.onload = function() {
                            if (xhr.status === 200) {
                                var response = JSON.parse(xhr.responseText);

                                if ('error' in response) {
                                    modalBody.innerHTML = '<p>' + response.error + '</p>';
                                } else {

                                    //* Limpiar el contenido del modalBody antes de agregar un nuevo patient-div

                                    modalBody.innerHTML = '';

                                    var patientDiv = document.createElement('div');
                                    patientDiv.className = 'patient-div';
                                    var tableContainer = document.createElement('div');
                                    tableContainer.className = 'table-container';
                                    var table = document.createElement('table');

                                    // Agregar subtítulos a la tabla
                                    var headerRow = table.createTHead().insertRow(0);
                                    var headers = ['#', 'Paciente', 'Fecha De Atencion', 'Enfermedad', 'Actualizar', 'Acciones'];
                                    headers.forEach(function(headerText) {
                                        var th = document.createElement('th');
                                        th.appendChild(document.createTextNode(headerText));
                                        headerRow.appendChild(th);
                                    });

                                    // Agregar datos a la tabla
                                    response.patientDetails.forEach(function(registro, index) {
                                        var row = table.insertRow();
                                        var cell0 = row.insertCell(0);
                                        var cell1 = row.insertCell(1);
                                        var cell2 = row.insertCell(2);
                                        var cell3 = row.insertCell(3);
                                        cell0.innerHTML = index + 1;
                                        cell1.innerHTML = `${registro.NomPaciente} ${registro.ApPaterno}`;
                                        cell2.innerHTML = registro.FechaRegistro;
                                        cell3.innerHTML = registro.Clasificacion;

                                        // Crear botón "Actualizar Enfermedad"
                                        var cell4 = row.insertCell(4);
                                        var button = document.createElement('button');
                                        button.className = 'ver-detalles-button';
                                        button.innerHTML = 'Actualizar Enfermedad';
                                        button.onclick = function() {
                                            var historyModal = document.getElementById('historyModal');
                                            historyModal.style.display = 'flex';
                                            var historyModalBody = document.getElementById('historyModalBody');
                                            historyModalBody.innerHTML = `
                            <p>Motivo de la Cita: ${registro.MotivoCita || 'N/A'}</p>
                            <p>Tipo de Cita: ${registro.TipoCita || 'N/A'}</p>
                            <p>Duración de la Cita: ${registro.DuracionCita || 'N/A'}</p>
                            <p>Canal de la Cita: ${registro.CanalCita || 'N/A'}</p>
                        `;
                                        };
                                        cell4.appendChild(button);

                                        // Crear botón "Actualizar Nota" en la columna acciones
                                        var cell5 = row.insertCell(5);
                                        var actualizarNotaButton = document.createElement('button');
                                        actualizarNotaButton.className = 'actualizar-nota-button';
                                        actualizarNotaButton.innerHTML = 'Actualizar Notas';
                                        actualizarNotaButton.onclick = function() {
                                            var historyModal = document.getElementById('historyModal');
                                            historyModal.style.display = 'flex';
                                            var historyModalBody = document.getElementById('historyModalBody');
                                            historyModalBody.innerHTML = `
                            <form action="Historial.php" method="POST">
                                <input type="hidden" name="patientId" value="${registro.IdAtencion}" />
                                <p>Diagnostico: </p>
                                <textarea name="diagnostico" id="notaTextArea">${registro.Diagnostico}</textarea>
                                <p>Tratamiento: </p>
                                <textarea name="tratamiento" id="notaTextArea">${registro.Tratamiento}</textarea>
                                <p>Observacion: </p>
                                <textarea name="observacion" id="notaTextArea">${registro.Observacion}</textarea>
                                <p>Objetivos Alcanzados: </p>
                                <textarea name="objetivos" id="notaTextArea">${registro.UltimosObjetivos}</textarea>
                                <input type="submit" value="Actualizar Nota" class="button_update_note">
                            </form>
                        `;
                                        };
                                        cell5.appendChild(actualizarNotaButton);
                                    });

                                    tableContainer.appendChild(table);
                                    patientDiv.appendChild(tableContainer);
                                    modalBody.appendChild(patientDiv);
                                }
                            } else {
                                console.error('Error al realizar la búsqueda del paciente.');
                            }
                        };

                        xhr.send('patientId=' + encodeURIComponent(patientId));
                    });

                    function closePatientModal() {
                        var patientModal = document.getElementById('patientModal');
                        patientModal.style.display = 'none';
                    }
                    // Update the value of the input field
                    document.getElementById('patientId').value = currentPatientId || '';
                });
            });

            function closeHistoryModal() {
                var historyModal = document.getElementById('historyModal');
                historyModal.style.display = 'none';
            }

            // Función para cerrar el modal fuera del bloque anterior
            function closePatientModal() {
                var patientModal = document.getElementById('patientModal');
                patientModal.style.display = 'none';
            }

            function closePatientDetails() {
                containerPacienteTabla.classList.remove('active');
                patientDetails.style.display = 'none';
                tableRows.forEach(row => {
                    row.classList.remove('selected');
                });


            }
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#searchPacienteName').on('keyup', function() {
                    var value = $(this).val().toLowerCase();
                    $('#tableNomPaciente tr').filter(function() {
                        // No se filtra la fila del encabezado
                        if ($(this).find('td:eq(1)').length > 0) {
                            $(this).toggle($(this).find('td:eq(0)').text().toLowerCase().indexOf(value) > -1);
                        }
                    });
                });
            });
        </script>


    </body>

    </html>
<?php
} else {
    header("Location: ../index.php");
}
?>
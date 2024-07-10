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
            $conn = $con->conexion();
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
    ?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../Issets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,1,0" />
        <link rel="stylesheet" href="../Issets/css/historial.css">
        <link rel="stylesheet" href="../Issets/css/main.css">
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

            .container-paciente-tabla {
                min-width: 800px;
            }

            .recent-updates {
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
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
            z-index: 1;
            /* Añade esta línea para que la 'x' aparezca sobre el contenido del modal */
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
            margin-top: 0.5rem;
            border-spacing: 0.5rem;
        }

        /* Estilos para las celdas de la tabla */
        td {
            text-align: center;
        }

        /* Estilos para el botón "Ver Detalles" dentro del modal de historial */
        .ver-detalles-button,
        .actualizar-nota-button,
        .button_update_note {
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
    </style>

    <body>
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
                <div class="recent-updates" style="display:flex; flex-direction: row; gap:20px; align-items: center; padding: 10px 0px 0px 10px">
                    <div class="input-buscador">
                        <span id="search-icon"><i class="fas fa-search"></i></span>
                        <input type="text" id="myInput" placeholder="Buscar Paciente" class="input" required>
                    </div>
                    <a class="button-arriba" style="padding:10px 30px; font-size:10px;" href="RegAtencionPaciente.php">
                        <i id="search-icon" class="fas fa-plus-circle add-icon" style="margin-right: 10px;"></i>Agregar Paciente
                    </a>
                </div>

                <div class="container-paciente-tabla">
                    <div class="before-details">
                        <table>
                            <?php foreach ($patients as $index => $patient) : ?>
                                <tbody>
                                    <tr <?php if ($index === 0) echo 'class="primera-fila"'; ?>>
                                        <td>
                                            <a style="cursor:pointer" class="show-info" data-patient-id="<?= $patient['IdPaciente'] ?>" data-nombres="<?= $patient['NomPaciente'] ?> <?= $patient['ApPaterno'] ?> <?= $patient['ApMaterno'] ?>" data-edad="<?= $patient['Edad'] ?>" data-diagnostico="<?= $patient['Diagnostico'] ?>" data-tratamiento="<?= $patient['Tratamiento'] ?>" data-medicamentosprescritos="<?= $patient['MedicamentosPrescritos'] ?>" data-FechaInicioCita="<?= $patient['FechaInicioCita'] ?>">
                                                <p style="cursor: pointer;" class="nombre-paciente"><?= $patient['NomPaciente'] ?> <?= $patient['ApPaterno'] ?></p>
                                                <p><?= isset($patient['Diagnostico']) ? $patient['Diagnostico'] : 'Diagnostico' ?> / <?= isset($patient['MotivoConsulta']) ? $patient['MotivoConsulta'] : 'Motivo de Consulta' ?></p>
                                            </a>
                                        </td>
                                        <td><?= isset($patient['FechaInicioCita']) ? substr($patient['FechaInicioCita'], 0, 10) : 'Fecha de próx cita' ?></td>
                                        <td class="additional-column" data-patient-id="<?= $patient[0] ?>"></td>
                                    </tr>
                                </tbody>
                            <?php endforeach; ?>

                        </table>
                    </div>
                    <div class="patient-details">

                    </div>
                </div>

                <div class="modal" id="patientModal">
                    <div class="modal-content">
                        <span class="close" id="closeModal" onclick="closePatientModal()">&times;</span>
                        <h2 class="modal-title">Detalles del Paciente</h2>
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

            // Agrega un event listener al nombre del paciente
            const nombrePaciente = document.querySelector('.nombre-paciente');
            nombrePaciente.addEventListener('click', function() {
                // Agrega una clase "open" al contenedor de detalles
                detailsContainer.classList.add('open');
            });

            // Agrega un event listener a todas las filas de la tabla
            var tableRows = document.querySelectorAll('table tr');
            tableRows.forEach(function(row) {
                // Encuentra el primer TD dentro de la fila
                var firstColumn = row.querySelector('td:first-child');

                // Verifica si se encontró el primer TD
                if (firstColumn) {
                    firstColumn.addEventListener('click', function() {
                        // Remueve la clase 'selected' de todas las filas
                        tableRows.forEach(function(r) {
                            r.classList.remove('selected');

                            // Cambia el color del texto del contenido de las palabras de la fila actual a su color original
                            var textElements = r.querySelectorAll('*');
                            textElements.forEach(function(el) {
                                el.style.color = 'black'; // Cambia 'black' al color original deseado
                            });
                        });

                        // Agrega la clase 'selected' a la fila actual
                        row.classList.add('selected');

                        // Cambia el color del texto del contenido de las palabras de la fila actual a blanco
                        var textElements = row.querySelectorAll('*');
                        textElements.forEach(function(el) {
                            el.style.color = 'white';
                        });
                    });
                }
            });

            const showInfoLinks = document.querySelectorAll('.show-info');
            const additionalColumns = document.querySelectorAll('.additional-column');
            const containerpacientetabla = document.querySelector('.container-paciente-tabla');
            const patientDetails = document.querySelector('.patient-details');
            let currentPatientId = null; // Variable para rastrear el paciente actual

            showInfoLinks.forEach(link => {
                link.addEventListener('click', function() {
                    // Obtener el ID del paciente desde el atributo data
                    const patientId = link.getAttribute('data-patient-id');

                    // Ocultar las columnas adicionales
                    additionalColumns.forEach(column => {
                        column.classList.add('hidden');
                        containerpacientetabla.classList.add('active');
                    });

                    // Obtener los datos del paciente
                    const nombres = link.getAttribute('data-nombres');
                    const edad = link.getAttribute('data-edad');
                    const diagnostico = link.getAttribute('data-diagnostico');
                    const tratamiento = link.getAttribute('data-tratamiento');
                    const medicamentosprescritos = link.getAttribute('data-medicamentosprescritos');
                    const FechaInicioCita = link.getAttribute('data-FechaInicioCita');
                    // Formatear la fecha en español
                    const opcionesFecha = {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    };
                    const fechaFormateada = FechaInicioCita ? new Date(FechaInicioCita).toLocaleDateString('es-ES', opcionesFecha) : 'Aún no hay cita';

                    let fechaFormateadaDM = '20/07';
                    if (FechaInicioCita) {
                        const fecha = new Date(FechaInicioCita);
                        const dia = String(fecha.getDate()).padStart(2, '0');
                        const mes = String(fecha.getMonth() + 1).padStart(2, '0'); // getMonth() devuelve un número entre 0 y 11, por lo que sumamos 1
                        fechaFormateadaDM = `${dia}/${mes}`;
                    }



                    // Crear el contenido de los detalles del paciente
                    const patientInfoHTML = `
        <div style="display:grid; flex-direction:row; gap:10px;">
            <div class="top-group">
                <div class="name">
                    <h2 class="visual2">${nombres}</h2>
                    <p class="arriba">${edad} años </p>
                    <p class="arriba">${fechaFormateada  || 'Aun no hay cita'}</p>
                    <button type="button" class="green-button" id="butto">Ver Historial Medico</button>
                </div>
                <div class="date">
                    <h6>${fechaFormateadaDM } </h6>
                    <p>Próxima Consulta</p>
                </div>
            </div>
            <div class="ci-input-group">
                <h2 class="arriba" for="#">Diagnostico </h2>
                <p class="abajo">${diagnostico || 'Aun no hay cita'}</p>
            </div>
            <div class="ci-input-group">
                <h2 class="arriba" for="#">Tratamiento </h2>
                <p class="abajo">${tratamiento || 'Aun no hay cita'}</p>
            </div>
            <div class="ci-input-group">
                <h2 class="arriba" for="#">Logros alcanzados </h2>
                <p class="abajo">${medicamentosprescritos || 'Aun no hay cita'}</p>
            </div>
            <div class="ci-input-group">
                <h2 class="arriba" for="#">Primera cita </h2>
                <p class="abajo">${FechaInicioCita || 'Aun no hay cita'}</p>
            </div>
            <div class="BUT">
                <a href="RegAtencionPaciente.php" class="green-button" id="button2">Atención Paciente</a>
            </div>
        </div>
        <form id="patientForm" style="display:none;">
            <label for="patientId">Ingrese el ID del paciente:</label>
            <input type="text" id="patientId" name="patientId" required>
            <button type="button" id="showAllPatientsButton">Mostrar Detalles del Paciente</button>
        </form>
    `;

                    // Mostrar la información en el elemento .patient-details
                    patientDetails.innerHTML = patientInfoHTML;

                    // Mostrar el cuadro de detalles
                    patientDetails.style.display = 'block';

                    // Actualizar la variable currentPatientId
                    currentPatientId = patientId;

                    butto.addEventListener('click', function() {
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
                                    var patientDiv = document.createElement('div');
                                    patientDiv.className = 'patient-div';
                                    var tableContainer = document.createElement('div');
                                    tableContainer.className = 'table-container';
                                    var table = document.createElement('table');

                                    // Agregar subtítulos a la tabla
                                    var headerRow = table.createTHead().insertRow(0);
                                    var headers = ['#', 'Paciente', 'Fecha De Atencion', 'Enfermedad', 'Actualizar', 'Acciones']; // Cambiado a 'Nombre Completo'
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
                                        // Set the row number in cell0
                                        cell0.innerHTML = index + 1;
                                        // Combina nombre y apellido en un solo campo
                                        cell1.innerHTML = `${registro.NomPaciente} ${registro.ApPaterno}`;
                                        cell2.innerHTML = registro.FechaRegistro;
                                        cell3.innerHTML = registro.Clasificacion;
                                        // Crear botón para cada registro
                                        var cell4 = row.insertCell(4); // Agregada esta línea para la nueva columna
                                        var button = document.createElement('button');
                                        button.className = 'ver-detalles-button'; // Agrega esta línea para asignar una clase
                                        button.innerHTML = 'Actualizar Enfermedad';
                                        button.onclick = function() {
                                            // Abre el modal de historial
                                            var historyModal = document.getElementById('historyModal');
                                            historyModal.style.display = 'flex';

                                            // Muestra los detalles del historial en el cuerpo del modal
                                            var historyModalBody = document.getElementById('historyModalBody');
                                            historyModalBody.innerHTML = `
        <p>Motivo de la Cita: ${registro.MotivoCita || 'N/A'}</p>
        <p>Tipo de Cita: ${registro.TipoCita || 'N/A'}</p>
        <p>Duración de la Cita: ${registro.DuracionCita || 'N/A'}</p>
        <p>Canal de la Cita: ${registro.CanalCita || 'N/A'}</p>
    `;
                                        };



                                        // Agregar botón a la columna de acciones
                                        cell4.appendChild(button);

                                        // Crear botón "Actualizar Nota" en la columna acciones
                                        var cell5 = row.insertCell(4);
                                        var actualizarNotaButton = document.createElement('button');
                                        actualizarNotaButton.className = 'actualizar-nota-button';
                                        actualizarNotaButton.innerHTML = 'Actualizar Notas';
                                        actualizarNotaButton.onclick = function() {
                                            // Aquí puedes agregar el código para actualizar la nota
                                            // Abre el modal de historial
                                            var historyModal = document.getElementById('historyModal');
                                            historyModal.style.display = 'flex';

                                            // Muestra los detalles del historial en el cuerpo del modal
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
            // ...
        </script>

        <script>

        </script>
    </body>

    </html>
<?php
} else {
    header("Location: ../index.php");
}
?>
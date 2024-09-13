<?php
session_start();
if (isset($_SESSION['NombrePsicologo'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,1,0" />
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
        <link rel="stylesheet" href="../Issets/css/citas.css">
        <link rel="stylesheet" href="../Issets/css/main.css">
        <link rel="icon" href="../img/favicon.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <title>Citas</title>
    </head>

    <body>
        <style>
            @media (max-width: 900px) {
                body {}

                .container {
                    width: 100%;
                }

                .center-divs {
                    min-width: 900px;
                }

                .contenedor-botones {
                    min-width: 900px;
                }

                table {
                    min-width: 900px;
                }

                .animate__animated {
                    overflow: auto;
                }
            }


            /* 
                                                                                                                                            ESTILOS USANDO BEM
                                                                                                                                            RECOMENDACION: USAR BEM PARA DARLE ESTILOS A LOS COMPONENTES Y MANTEBER EL CODIGO LIMPIO
                                                                                                                                            */
            .appointments__header {
                display: flex;
                align-items: center;
                gap: 1rem;
                padding-block: 1rem;

                @media (max-width: 900px) {
                    flex-direction: column;
                }
            }

            .appointments__filters {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 1rem;
                flex-wrap: wrap;

                .input-buscador {
                    flex-grow: 1;
                }
            }

            .appointmentTuple__buttons {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 1rem;
                flex-wrap: wrap;
            }

            .appointmentTuple__button {
                padding: 0.5rem 1rem;
                border: none;
                z-index: 1;
                color: white;
                background: none;
                cursor: pointer;
                border-radius: 5px;
            }

            .appointmentTuple__button--edit span {
                color: blue;
            }

            .appointmentTuple__button--delete span {
                color: red;
            }
        </style>
        <?php
        require("../Controlador/Cita/ControllerCita.php");
        $ControllerCita = new usernameControlerCita();

        $rowsPerPage = 2;
        $currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;

        $rowscita = $ControllerCita->contarRegistrosEnCitas($_SESSION['IdPsicologo']);
        $idPsicologo = $_SESSION['idPsicologo'];
        $rows = $ControllerCita->getAll($idPsicologo, null, null, null, null, null, $rowsPerPage, ($currentPage - 1) * $rowsPerPage);
        $totalRows = $ControllerCita->contarRegistrosEnCitas($_SESSION['IdPsicologo']); // Asumiendo que cuentas el número total de registros
        $totalPages = ceil($totalRows / $rowsPerPage);
        ?>
        <div class="container">
            <?php
            require_once '../Issets/views/Menu.php';
            ?>
            <main class="animate__animated animate__fadeIn">
                <div class="center-divs">
                    <h4 style="color: #49c691;">Lista de Citas</h4>
                    <?php
                    require_once '../Issets/views/Info.php';
                    ?>
                </div>
                <div class="appointments__header">
                    <span style="font-size: 15px;color: #6a90f1; border-right: 3px solid #6a90f1; padding-right: 10px;">
                        <b style="font-size: 25px;color: #6a90f1;"><?= $rowscita ?></b>
                        Citas
                    </span>
                    <div class="appointments__filters">
                        <div class="input-buscador">
                            <span id="search-icon"><i class="fas fa-search"></i></span>
                            <input type="text" id="searchForCode" placeholder="Codigo Paciente" class="input Codigo"
                                required>
                        </div>
                        <div class="input-buscador">
                            <span id="search-icon"><i class="fas fa-search"></i></span>
                            <input type="text" id="searchForName" placeholder="Nombre Paciente" class="input nom" required>
                        </div>
                        <div class="input-buscador">
                            <span id="search-icon"><i class="fas fa-search"></i></span>
                            <input type="datetime-local" id="searchForDateStart" placeholder="Fecha de Inicio"
                                class="input date" required>
                        </div>
                        <div class="input-buscador">
                            <span id="search-icon"><i class="fas fa-search"></i></span>
                            <input type="datetime-local" id="searchForDateEnd" placeholder="Fecha de Fin" class="input date"
                                required>
                        </div>
                    </div>
                    <span style="display:none;" id="idPsicologo">
                        <?= $_SESSION['idPsicologo'] ?>
                    </span>
                    <a class="button-eliminar" id="eliminarSeleccionados">
                        <i id="search-icon" class="fas fa-trash" style="margin-right: 10px;color:red"></i>Eliminar
                    </a>
                </div>
                <div class="recent-citas">
                    <table>
                        <!-- Encabezado de la tabla -->
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkboxPrincipal" class="checkbox-principal"></th>
                                <th>Paciente</th>
                                <th>Codigo</th>
                                <th>Motivo</th>
                                <th>Estado</th>
                                <th>Fecha de Inicio</th>
                                <th>Duración</th>
                                <th>Más</th>
                            </tr>
                        </thead>

                        <!-- Cuerpo de la tabla -->
                        <tbody id="appointmentsTable">
                            <?php if ($rows): ?>
                                <?php foreach ($rows as $row): ?>
                                    <tr>
                                        <td><input type="checkbox" class="checkbox" id="checkbox<?= $row['IdCita'] ?>"
                                                value="<?= $row['IdCita'] ?>"></td>
                                        <td style="padding: 20px;"><?= $row['NomPaciente'] ?></td>
                                        <td><?= $row['codigopac'] ?></td>
                                        <td><?= $row['MotivoCita'] ?></td>
                                        <td><?= $row['EstadoCita'] ?></td>
                                        <td><?= $row['FechaInicioCita'] ?></td>
                                        <td style="color:green"><?= $row['Duracioncita'] ?></td>
                                        <td id="appointmentId-<?= $row['IdCita'] ?>">
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
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8">No hay registros.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="pagination">
                    <?php
                    if ($totalPages > 1) {
                        for ($page = 1; $page <= $totalPages; $page++) {
                            echo "<a href='?page=$page'>$page</a> ";
                        }
                    }
                    ?>
                </div>
            </main>
            <div id="notification" style="display: none;" class="notification">
                <p id="notification-text"></p>
                <span class="notification__progress"></span>
            </div>
        </div>
        <?php if ($rows): ?>
            <?php foreach ($rows as $row): ?>
                <!-- Modal de eliminación -->
                <div id="modalEliminar<?= $row[0] ?>" class="service-modal flex-center">
                    <div class="service-modal-body">
                        <a class="close" onclick="closeModalEliminar('<?= $row[0] ?>')">&times;</a>
                        <div style="text-align: center; padding: 20px;">
                            <span style="font-size:50px; color: #56B9B3;" class="material-symbols-sharp">help_outline</span>
                            <h2 style="font-size:20px; margin-top: 10px;">¿Eliminar cita?</h2>
                            <p>Se eliminará la cita de <strong><?= $row[1] ?></strong>. Esta acción no se puede deshacer.</p>
                        </div>
                        <div class="modal-button-container"
                            style="display: flex; justify-content: center; gap: 10px; margin-top: 20px;">
                            <button class="button-modal button-cancel" onclick="closeModalEliminar('<?= $row[0] ?>')"
                                style="background-color: #F19294; border: none; padding: 10px 20px; color: white; cursor: pointer;">Cancelar</button>
                            <a href="../Crud/Cita/eliminarCita.php?id=<?= $row[0] ?>" class="button-modal button-accept"
                                style="background-color: #56B9B3; border: none; padding: 10px 20px; color: white; text-decoration: none; text-align: center; cursor: pointer;">Aceptar</a>
                        </div>
                    </div>
                </div>
                <!-- Modal de edicion -->

            <?php endforeach; ?>
        <?php endif; ?>

        <div id="modalEditAppointment" class="service-modal flex-center">
            <div class="service-modal-body">
                <a href="#" class="close" id="closeModalEditAppointment">&times;</a>
                <div class="message_dialog">
                    <h2 id="appointmentTitle" style="font-size:20px; color:#49c691">Edit Appointment</h2>
                    <form id="editAppointmentForm" class="dialog">
                        <input type="hidden" id="appointmentId" name="appointmentId">

                        <div class="input-group-modal">
                            <label for="reason">
                                Motivo de la consulta
                                <b style="color:red">*</b></label>
                            <textarea id="reason" name="reason" required
                                style="resize: none; padding: 1.2em 1em 2.8em 1em; font-family: 'Montserrat', sans-serif; font-size: 14px;"></textarea>
                        </div>
                        <br>

                        <div class="input-group2">
                            <div class="input-group-modal">
                                <label for="appointmentStatus">
                                    Estado de la cita
                                    <b style="color:red">*</b></label>
                                <select id="appointmentStatus" name="appointmentStatus" required>
                                    <option value="Confirmation Required">
                                        Se requiere confirmación
                                    </option>
                                    <option value="Confirmed">
                                        Confirmada
                                    </option>
                                    <option value="Patient Absent">
                                        Ausencia del paciente
                                    </option>
                                </select>
                            </div>

                            <div class="input-group-modal" style="width:50%; margin-left: 65px;">
                                <label for="appointmentColor">Color de cita<b style="color:red">*</b></label>
                                <input type="color" id="appointmentColor" name="appointmentColor">
                                <datalist id="colorOptions">
                                    <option value="#b4d77b">Rojo</option>
                                    <option value="#9274b3">Verde</option>
                                    <option value="#f38238">Azul</option>
                                </datalist>
                            </div>
                        </div>
                        <br>

                        <div class="input-group2">
                            <div class="input-group-modal" style="width:49%">
                                <label for="startDate">Fecha de cita <b style="color:red">*</b></label>
                                <input type="date" id="startDate" name="startDate" required>
                            </div>
                            <div class="input-group-modal" style="width:49%">
                                <label for="startTime">Hora de inicio <b style="color:red">*</b></label>
                                <input type="time" id="startTime" name="startTime" required />
                            </div>
                        </div>
                        <br>

                        <div class="input-group2">
                            <div class="input-group-modal" style="width:49%">
                                <label for="appointmentType">Tipo de cita <b style="color:red">*</b></label>
                                <select id="appointmentType" name="appointmentType">
                                    <option value="First Visit">Primera visita</option>
                                    <option value="Follow-up Visit">Visita de control</option>
                                </select>
                            </div>

                            <div class="input-group-modal" style="margin-left: 65px;">
                                <label for="duration">Duración <b style="color:red">*</b></label>
                                <select id="duration" name="duration" required>
                                    <option value="5">5'</option>
                                    <option value="10">10'</option>
                                    <option value="15">15'</option>
                                    <option value="20">20'</option>
                                    <option value="30">30'</option>
                                    <option value="40">40'</option>
                                    <option value="45">45'</option>
                                    <option value="50">50'</option>
                                    <option value="60">60'</option>
                                    <option value="90">90'</option>
                                    <option value="120">120'</option>
                                </select>
                            </div>
                        </div>

                        <div class="input-group-modal" style="display: none;">
                            <label for="endDate">Fecha fin <b style="color:red">*</b></label>
                            <input id="endDate" type="text" name="endDate" readonly />
                        </div>

                        <div class="input-group2">
                            <div class="input-group-modal" style="width:58%">
                                <label for="attractionChannel">Canal de atracción <b style="color:red">*</b></label>
                                <select id="attractionChannel" name="attractionChannel" required>
                                    <option value="Online Appointment">Cita online</option>
                                    <option value="Direct Marketing">
                                        Marketing directo
                                    </option>
                                    <option value="Referrals">Referidos</option>
                                </select>
                            </div>
                            <div class="input-group-modal" style="width:55%">
                                <label for="label">Etiqueta <b style="color:red">*</b></label>
                                <select id="label" name="label" required>
                                    <option value="Consultation">
                                        Consulta
                                    </option>
                                    <option value="Referred Family">
                                        Familia referida
                                    </option>
                                    <option value="Priority">
                                        Prioridad
                                    </option>
                                </select>
                            </div>
                        </div>
                        <br>

                        <div class="modal-button-container">
                            <button type="button" class="button-modal button-cancelar button-cancel"
                                id="cancelEditAppointment">
                                Cancelar
                            </button>
                            <button type="submit" class="button-modal button-cancelar button-editar">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="../Issets/js/dashboard.js"></script>
        <script src="../Issets/js/citas.js"></script>
        <script>
            // Obtener elementos del formulario
            // var fechaInicioInput = document.getElementById('FechaInicioCita');
            // var horaInicioInput = document.getElementById('HoraInicio');
            // var duracionInput = document.getElementById('DuracionCita');
            // var fechaFinInput = document.getElementById('FechaFin');

            // // Escuchar eventos de cambio en los campos relevantes
            // fechaInicioInput.addEventListener('change', calcularFechaFin);
            // horaInicioInput.addEventListener('change', calcularFechaFin);
            // duracionInput.addEventListener('change', calcularFechaFin);

            // Función para calcular la fecha y hora de finalización
            function calcularFechaFin() {
                var fechaInicio = new Date(fechaInicioInput.value + 'T' + horaInicioInput.value);
                var duracion = parseInt(duracionInput.value);

                // Convertir la duración a milisegundos
                var duracionMs = duracion * 60000;

                // Calcular la fecha y hora de finalización
                var fechaFin = new Date(fechaInicio.getTime() + duracionMs);

                // Formatear la fecha y hora de finalización
                var fechaFinFormatted = formatDate(fechaFin) + ' ' + formatTime(fechaFin);

                fechaFinInput.value = fechaFinFormatted;
            }

            // Función para formatear la fecha en formato "YYYY-MM-DD"
            function formatDate(date) {
                var year = date.getFullYear();
                var month = String(date.getMonth() + 1).padStart(2, '0');
                var day = String(date.getDate()).padStart(2, '0');
                return year + '-' + month + '-' + day;
            }

            // Función para formatear la hora en formato "HH:MM"
            function formatTime(date) {
                var hours = String(date.getHours()).padStart(2, '0');
                var minutes = String(date.getMinutes()).padStart(2, '0');
                return hours + ':' + minutes;
            }
            //Funciones del modal
            function openModalEditar(id) {
                var modal = document.getElementById('modalEditar' + id);
                modal.classList.add('active');
            }

            function closeModalEditar(id) {
                var modal = document.getElementById('modalEditar' + id);
                modal.classList.remove('active');
            }

            function openModalEliminar(id) {
                var modal = document.getElementById('modalEliminar' + id);
                modal.classList.add('active');
            }

            function closeModalEliminar(id) {
                var modal = document.getElementById('modalEliminar' + id);
                modal.classList.remove('active');
            }

            function closeOptions(id) {
                var dropdownContent = document.querySelector("#dropdown-content-" + id);
                dropdownContent.style.display = "none";
            }

            function openOptions(id) {
                var dropdownContent = document.querySelector("#dropdown-content-" + id);

                // Comprueba si el dropdown ya está abierto
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    var dropdownContents = document.getElementsByClassName("dropdown-content");

                    for (var i = 0; i < dropdownContents.length; i++) {
                        dropdownContents[i].style.display = "none";
                    }

                    dropdownContent.style.display = "block";
                    dropdownContent.style.marginLeft = "-71px";
                }
            }
            //funciones de la pagina
            var paginationLinks = document.getElementsByClassName('pagination')[0].getElementsByTagName('a');

            for (var i = 0; i < paginationLinks.length; i++) {
                paginationLinks[i].addEventListener('click', function (event) {
                    event.preventDefault();
                    var page = parseInt(this.getAttribute('href').split('=')[1]);
                    mostrarPagina(page);
                });
            }

            function mostrarPagina(page) {
                var rows = document.getElementById('appointmentsTable').getElementsByTagName('tr');

                for (var i = 0; i < rows.length; i++) {
                    rows[i].style.display = 'none';
                }

                var startIndex = (page - 1) * <?= $rowsPerPage ?>;
                var endIndex = startIndex + <?= $rowsPerPage ?>;

                for (var i = startIndex; i < endIndex && i < rows.length; i++) {
                    rows[i].style.display = 'table-row';
                }
            }

            mostrarPagina(1);
        </script>
    </body>

    </html>
    <?php
} else {
    header("Location: ../Index.php");
}
?>
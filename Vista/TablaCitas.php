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
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <title>Citas</title>
    </head>

    <body>
        <style>
            @media (max-width: 900px) {

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

            .appointments__header {
                display: flex;
                align-items: center;
                gap: 1rem;
                /* padding-block: 1rem; */

                @media (max-width: 900px) {
                    flex-direction: column;
                }
            }

            .appointments__filters {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 1rem;
                padding: 10px 0;
                flex-wrap: wrap;

                .input-buscador {
                    flex-grow: 1;
                }
            }

            input.color-picker {
                color: #6a90f1;
                height: 33px;
                padding: 5px 10px;
            }
        </style>
        <?php
        require("../Controlador/Cita/ControllerCita.php");
        $ControllerCita = new usernameControlerCita();

        $rowsPerPage = 10;
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
                    <h4 style="color: #534489;">Lista de Citas</h4>
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
                            <input type="datetime-local" id="searchForDateStart" placeholder="Fecha de Inicio" class="input"
                                required>
                        </div>
                        <div class="input-buscador">
                            <span id="search-icon"><i class="fas fa-search"></i></span>
                            <input type="datetime-local" id="searchForDateEnd" placeholder="Fecha de Fin" class="input"
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
                                    <tr class="appointmentTuple">
                                        <td><input type="checkbox" class="checkbox" id="checkbox<?= $row['IdCita'] ?>"
                                                value="<?= $row['IdCita'] ?>"></td>
                                        <td><?= $row['NomPaciente'] ?></td>
                                        <td><?= $row['codigopac'] ?></td>
                                        <td><?= $row['MotivoCita'] ?></td>
                                        <td><?= $row['EstadoCita'] ?></td>
                                        <td><?= $row['FechaInicioCita'] ?></td>
                                        <td style="color:#4CAF50"><?= $row['Duracioncita'] ?></td>
                                        <td id="appointmentId-<?= $row['IdCita'] ?>">
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
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8">No hay Citas registradas.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <?php require_once './modales/ModalEditAppointment.html'; ?>
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
        <!-- Modales -->
        <?php require_once './modales/ModalDeleteAppointment.html'; ?>

        <script src="../Issets/js/dashboard.js"></script>
        <script src="../Issets/js/citas.js"></script>
        <script>
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
            function openModalEliminar(id) {
                var modal = document.getElementById(' ' + id);
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
            // TODO: Cambiar la forma de paginar, porque no esta trayendo todos los registros del servidor
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
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
        <link rel="stylesheet" href="../Issets/css/main.css">
        <link rel="stylesheet" href="../Issets/css/paciente.css">
        <link rel="stylesheet" href="../Issets/css/citas.css">
        <link rel="icon" href="../img/favicon.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <title>Paciente</title>
    </head>

    <body>
        <style>
            @media (max-width: 900px) {
                table {
                    min-width: 900px;
                }

                .animate__animated {
                    overflow: auto;
                }
            }

            .contenedor-botones {
                .button-arriba {
                    flex-grow: 1;
                }
            }

           

            @media (max-width: 1200px) {
                #modalNewAppointment {
                    width: 100%;
                    height: 100%;
                    position: fixed;
                    top: 0;
                    left: 0;
                    z-index: 1000;
                    background: rgba(0, 0, 0, 0.5);
                    justify-content: center;
                    align-items: center;
                    border-radius: 0;
                }
            }
        </style>

        <?php
        require("../Controlador/Paciente/ControllerPaciente.php");
        require("../Controlador/Cita/ControllerCita.php");

        $obj = new usernameControlerPaciente();
        $objcita = new usernameControlerCita();

        $rowsPerPage = 5;
        $currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;

        $patients = $obj->showCompleto($_SESSION['IdPsicologo'], $currentPage, $rowsPerPage);

        $rowscita = $objcita->contarRegistrosEnPacientes($_SESSION['IdPsicologo']);

        $totalPacientes = $rowscita;  // Asumiendo que cuentas el número total de registros
        $totalPages = ceil($totalPacientes / $rowsPerPage);
        ?>
        <div class="container">
            <?php
            require_once '../Issets/views/Menu.php';
            ?>
            <!----------- end of aside -------->
            <main class="animate__animated animate__fadeIn">
                <div class="center-divs">
                    <h4 style="color: #534489;">Lista de Pacientes</h4>
                    <?php
                    require_once '../Issets/views/Info.php';
                    ?>
                </div>
                <div class="appointments__header">
                    <span class="numeros-pacientes" translate="no">
                        <b><?= $rowscita ?></b>
                        Pacientes
                    </span>
                    <div class="contenedor-botones">
                        <div class="input-buscador">
                            <span id="search-icon"><i class="fas fa-search"></i></span>
                            <input type="text" id="buscarPaciente" placeholder="Buscar Paciente" class="input" required>
                        </div>
                        <div class="input-buscador">
                            <span id="search-icon"><i class="fas fa-search"></i></span>
                            <input type="text" id="buscarDni" placeholder="Buscar por DNI" class="input" required>
                        </div>
                        <div class="input-buscador">
                            <span id="search-icon"><i class="fas fa-search"></i></span>
                            <input type="text" id="buscarCodigo" placeholder="Buscar por Codigo" class="input" required>
                        </div>
                        <a class="button-arriba" style="padding:10px 30px;" href="RegPaciente.php">
                            <i id="search-icon" class="fas fa-plus-circle add-icon" style="margin-right: 10px;"></i>Agregar
                            Paciente
                        </a>
                        <a class="button-eliminar" id="eliminarSeleccionados">
                            <i id="search-icon" class="fas fa-trash" style="margin-right: 10px;"></i>Eliminar
                        </a>
                    </div>
                </div>
                <div class="recent-citas" >
                    <table>
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkboxPrincipal" class="checkbox-principal" aria-label="Seleccionar todos"></th>
                                <th class="additional-column">Paciente</th>
                                <th class="additional-column">Codigo</th>
                                <th class="additional-column">DNI</th>
                                <th class="additional-column">Email</th>
                                <th class="additional-column">Celular</th>
                                <th class="additional-column">Cita</th>
                                <th class="additional-column">Más</th>
                            </tr>
                        </thead>

                        <tbody id="myTable" class="tu-tbody-clase">
                            <?php if ($patients): ?>
                                <?php foreach ($patients as $patient): ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="checkbox" aria-label="Seleccionar elemento"
                                                id="checkbox<?= htmlspecialchars($patient[0], ENT_QUOTES, 'UTF-8') ?>"
                                                value="<?= htmlspecialchars($patient[0], ENT_QUOTES, 'UTF-8') ?>">
                                        </td>
                                        <td style="font-weight:bold;padding: 10px;">
                                            <a style="cursor:pointer" class="show-info"
                                                data-patient-id="<?= htmlspecialchars($patient[0], ENT_QUOTES, 'UTF-8') ?>"
                                                data-codigo="<?= htmlspecialchars($patient['codigopac'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                                data-nombres="<?= htmlspecialchars(($patient['NomPaciente'] ?? '') . ' ' . ($patient['ApPaterno'] ?? '') . ' ' . ($patient['ApMaterno'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
                                                data-dni="<?= htmlspecialchars($patient['Dni'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                                data-genero="<?= htmlspecialchars($patient['Genero'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                                data-edad="<?= htmlspecialchars($patient['Edad'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                                data-estadocivil="<?= htmlspecialchars($patient['EstadoCivil'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                                data-email="<?= htmlspecialchars($patient['Email'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                                data-celular="<?= htmlspecialchars($patient['Telefono'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                                data-nombre-madre="<?= htmlspecialchars($patient['NomMadre'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                                data-estado-madre="<?= htmlspecialchars($patient['EstadoMadre'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                                data-nombre-padre="<?= htmlspecialchars($patient['NomPadre'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                                data-estado-padre="<?= htmlspecialchars($patient['EstadoPadre'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                                data-cant-hermanos="<?= htmlspecialchars($patient['CantHermanos'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                                data-antecedentes-familiares="<?= htmlspecialchars($patient['HistorialFamiliar'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                                                <?= htmlspecialchars($patient['NomPaciente'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                                                <?= htmlspecialchars($patient['ApPaterno'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                                            </a>
                                            <button class="buttoncita"
                                                style="display:none; width: 110px; padding:6px; margin-top: 4.5%; margin-bottom: 0%;"
                                                data-patient-id="<?= htmlspecialchars($patient[0], ENT_QUOTES, 'UTF-8') ?>">
                                                <div style="display: flex;">
                                                    <span class="material-symbols-sharp">add</span>Crear Cita
                                                </div>
                                            </button>
                                        </td>
                                        <td class="additional-column" style="font-weight:bold;">
                                            <?= htmlspecialchars($patient['codigopac'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                                        </td>
                                        <td class="additional-column" style="font-weight:bold;">
                                            <?= htmlspecialchars($patient['Dni'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                                        </td>
                                        <td class="additional-column"
                                            style="font-weight:bold;width:25%;text-align: center; margin-left:4%;">
                                            <?= htmlspecialchars($patient['Email'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                                        </td>
                                        <td class="additional-column" style="font-weight:bold;">
                                            <?= htmlspecialchars($patient['Telefono'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                                        </td>
                                        <td class="additional-column">
                                            <div style="display: flex;justify-content: center;">
                                                <button class="buttoncita" style="width: 110px; padding:6px;"
                                                    data-patient-id="<?= htmlspecialchars($patient['IdPaciente'], ENT_QUOTES, 'UTF-8') ?>"
                                                    data-patient-code="<?= htmlspecialchars($patient['codigopac'], ENT_QUOTES, 'UTF-8') ?>">
                                                    <span class="material-symbols-sharp" translate="no">add</span>Crear Cita
                                                </button>
                                            </div>
                                        </td>
                                        <td id="appointmentId-<?= htmlspecialchars($patient['IdPaciente'], ENT_QUOTES, 'UTF-8') ?>">
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
                                <tr >
                                    <td colspan="8">No hay pacientes registrados .</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>

                    </table>
                    <?php
                    require_once './modales/ModalEditPaciente.html';
                    ?>
                    <?php
                    require_once './modales/ModalNewAppointment.php';
                    ?>
                </div>

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
        </div>
        <?php require_once './modales/ModalDeletePaciente.html'; ?>
        <script src="../Issets/js/dashboard.js"></script>
        <script src="../Issets/js/pacientes.js"></script>
        <script>
            //Funciones del modal
            function openModalEditar(id) {
                var modal = document.getElementById('modalEditar' + id);
                modal.classList.add('active');
            }

            function closeModalEditar(id) {
                var modal = document.getElementById('modalEditar' + id);
                modal.classList.remove('active');

                // Resetear los valores de los campos del formulario
                var form = modal.querySelector('form');
                form.reset();
            }

            /*function openModalEliminar(id) {
                var modal = document.getElementById('modalEliminar' + id);
                modal.classList.add('active');
            }*/

            function openModalEliminar(id) {
                var modal = document.getElementById('modalEliminar' + id);
                modal.dataset.patientId = id; // Establecer el ID del paciente en el atributo data-patient-id
                modal.classList.add('active'); // Mostrar el modal
            }


            function closeModalEliminar(id) {
                var modal = document.getElementById('modalEliminar' + id);
                modal.classList.remove('active');
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
        </script>

        <script>
            $(document).ready(function() {
                $('#Departamento').change(function() {
                    var departamentoId = $(this).find(':selected').data('id');
                    obtenerProvincias(departamentoId);
                });

                function obtenerProvincias(departamentoId) {
                    $.ajax({
                        url: '../Crud/Fetch/obtenerProvincias.php',
                        method: 'POST',
                        data: {
                            departamentoId: departamentoId
                        },
                        dataType: 'json',
                        success: function(provincias) {
                            // Llenar el select de provincias con los datos obtenidos
                            var selectProvincias = $('#Provincia');
                            selectProvincias.empty();
                            selectProvincias.append($('<option>', {
                                value: '',
                                text: 'Seleccionar'
                            }));
                            provincias.forEach(function(provincia) {
                                selectProvincias.append($('<option>', {
                                    value: provincia.id,
                                    text: provincia.name
                                }));
                            });
                        }
                    });
                }
            });

            $('#Provincia').change(function() {
                var provinciaId = $(this).val();
                obtenerDistritos(provinciaId);
            });

            function obtenerDistritos(provinciaId) {
                $.ajax({
                    url: '../Crud/Fetch/obtenerDistritos.php',
                    method: 'POST',
                    data: {
                        provinciaId: provinciaId
                    },
                    dataType: 'json',
                    success: function(distritos) {
                        // Llenar el select de distritos con los datos obtenidos
                        var selectDistritos = $('#Distrito');
                        selectDistritos.empty();
                        selectDistritos.append($('<option>', {
                            value: '',
                            text: 'Seleccionar'
                        }));
                        distritos.forEach(function(distrito) {
                            selectDistritos.append($('<option>', {
                                value: distrito.id,
                                text: distrito.name
                            }));
                        });
                    }
                });
            }
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#buscarPaciente').on('keyup', function() {
                    var value = $(this).val().toLowerCase();
                    $('#myTable tr').filter(function() {
                        $(this).toggle($(this).find('td:eq(1)').text().toLowerCase().indexOf(value) > -1);
                    });
                });

                $('#buscarDni').on('keyup', function() {
                    var value = $(this).val().toLowerCase();
                    $('#myTable tr').filter(function() {
                        $(this).toggle($(this).find('td:eq(3)').text().toLowerCase().indexOf(value) > -1);
                    });
                });

                $('#buscarCodigo').on('keyup', function() {
                    var value = $(this).val().toLowerCase();
                    $('#myTable tr').filter(function() {
                        $(this).toggle($(this).find('td:eq(2)').text().toLowerCase().indexOf(value) > -1);
                    });
                });
            });
        </script>


    </body>

    </html>
<?php
} else {
    header("Location: ../Index.php");
}
?>
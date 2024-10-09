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
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,1,0" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
        <link rel="stylesheet" href="../Issets/css/paciente.css">
        <link rel="stylesheet" href="../Issets/css/main.css">
        <link rel="icon" href="../img/favicon.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <title>Paciente</title>
    </head>

    <body>
    <style>
            @media (max-width: 900px) {
            body {

            }
            .container {
                width: 100%;
            }
            .center-divs{
                min-width: 900px;
            }
            /* .contenedor-botones{
                min-width: 900px;
            } */

            table{
                min-width: 900px;
            }
            .animate__animated{
                overflow: auto;
            }
            }

            @media (min-width: 900px) {

            }
            .contenedor-botones {
                .button-arriba {
                    flex-grow: 1;
                }
            }

        </style>

        <?php
        require("../Controlador/Paciente/ControllerPaciente.php");
        require("../Controlador/Cita/ControllerCita.php");

        $obj = new usernameControlerPaciente();
        $objcita = new usernameControlerCita();

        $rowsPerPage = 5;
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

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
                    <span class="numeros-pacientes">
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
                            <i id="search-icon" class="fas fa-plus-circle add-icon" style="margin-right: 10px;"></i>Agregar Paciente
                        </a>
                    </div>
                    <a class="button-eliminar" id="eliminarSeleccionados">
                        <i id="search-icon" class="fas fa-trash" style="margin-right: 10px;color:red"></i>Eliminar
                    </a>
                </div>
                <!-- <div class="separador"></div> -->
                <div class="container-paciente-tabla">
                    <table>
                        <!-- Encabezado de la tabla -->
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkboxPrincipal" class="checkbox-principal"></th>
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
    <?php if ($patients) : ?>
        <?php foreach ($patients as $patient) : ?>
            <tr>
                <td>
                    <input type="checkbox" class="checkbox" id="checkbox<?= htmlspecialchars($patient[0], ENT_QUOTES, 'UTF-8') ?>" value="<?= htmlspecialchars($patient[0], ENT_QUOTES, 'UTF-8') ?>">
                </td>
                <td style="text-align: start; font-weight:bold;padding: 14px;">
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
                        <?= htmlspecialchars($patient['NomPaciente'] ?? '', ENT_QUOTES, 'UTF-8') ?> <?= htmlspecialchars($patient['ApPaterno'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                    </a>
                    <a class="buttoncita" style="display:none; width: 110px; padding:6px; margin-top: 4.5%; margin-bottom: 0%;" href="RegCitas.php">
                        <div style="display: flex;">
                            <span class="material-symbols-sharp">add</span>Crear Cita
                        </div>
                    </a>
                </td>
                <td class="additional-column" style="font-weight:bold;"><?= htmlspecialchars($patient['IdPaciente'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                <td class="additional-column" style="font-weight:bold;"><?= htmlspecialchars($patient['Dni'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                <td class="additional-column" style="font-weight:bold;width:25%;text-align: center; margin-left:4%;">
                    <?= htmlspecialchars($patient['Email'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                </td>
                <td class="additional-column" style="font-weight:bold;"><?= htmlspecialchars($patient['Telefono'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                <td class="additional-column">
                    <div style="display: flex;justify-content: center;margin-top: 2%;">
                        <a class="buttoncita" style="width: 110px; padding:6px;" href="RegCitas.php">
                            <span class="material-symbols-sharp">add</span>Crear Cita
                        </a>
                    </div>
                </td>
                <td>
                    <div id="dropdown-content-<?= htmlspecialchars($patient[0], ENT_QUOTES, 'UTF-8') ?>" style="display: flex; column-gap: 1rem; justify-content: space-evenly;">
                        <a type="button" class="btne" onclick="openModalEliminar('<?= htmlspecialchars($patient[0], ENT_QUOTES, 'UTF-8') ?>')" style="color: red;cursor: pointer;" href="../Crud/Paciente/eliminarPaciente.php?id=<?= $patient['Dni'] ?>">
                            <span class="material-symbols-outlined">delete</span>
                            <p style="color:red;">Eliminar</p>
                        </a>
                        <a type="button" class="btnm" onclick="openModalEditar('<?= htmlspecialchars($patient[0], ENT_QUOTES, 'UTF-8') ?>')" style="color: blue;cursor: pointer;">
                            <span class="material-symbols-outlined">edit</span>
                            <p style="color:blue;">Editar</p>
                        </a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else : ?>
        <tr colspan="11">
            <td>No hay pacientes registrados.</td>
        </tr>
    <?php endif; ?>
</tbody>

                    </table>
                    <div class="patient-details">

                    </div>
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
        </div>
        <?php if (!empty($patients)) : ?>
            <?php foreach ($patients as $patient) : ?>
                <!-- Modal de eliminación -->
                <div id="modalEliminar<?= $patient[0] ?>" class="service-modal flex-center">
                    <div class="service-modal-body">
                        <a class="close" onclick="closeModalEliminar('<?= $patient[0] ?>')">&times;</a>
                        <div style="text-align: center; padding: 20px;">
                            <span style="font-size:50px; color: #56B9B3;" class="material-symbols-sharp">help_outline</span>
                            <h2 style="font-size:20px; margin-top: 10px;">¿Eliminar registro del paciente?</h2>
                            <p>Se eliminará el registro del paciente <strong><?= $patient[2] . " " . $patient[3] ?></strong>. Esta acción no se puede deshacer.</p>
                        </div>
                        <div class="modal-button-container" style="display: flex; justify-content: center; gap: 10px; margin-top: 20px;">
                            <button class="button-modal button-cancel" onclick="closeModalEliminar('<?= $patient[0] ?>')" style="background-color: #F19294; border: none; padding: 10px 20px; color: white; cursor: pointer;">Cancelar</button>
                            <a href="../Crud/Paciente/eliminarPaciente.php?id=<?= $patient[0] ?>" class="button-modal button-accept" style="background-color: #56B9B3; border: none; padding: 10px 20px; color: white; text-decoration: none; text-align: center; cursor: pointer;">Aceptar</a>
                        </div>
                    </div>
                </div>


                <!-- Modal de edicion -->
                <div id="modalEditar<?= $patient[0] ?>" class="service-modal flex-center" >
                    <div class="service-modal-body">
                        <a href="#" class="close" onclick="closeModalEditar('<?= $patient[0] ?>')">&times;</a>
                        <div class="message_dialog" >
                            <h2 style="font-size:20px; color:#49c691">Modificar datos de <?= $patient[2] . " " . $patient[3] ?></h2>
                            <form action="../Crud/Paciente/modificarPaciente.php" method="POST" class="modifica-form" style=" max-height:90vh; overflow-y:auto;">
                                <input type="hidden" name="id_cita" value="<?= $patient[0] ?>">
                                <!-- EDITAR MOTIVO ESTADO FECHA DE INICIO DURACION -->
                                <div class="input-group-modal" style="display: none">
                                    <h3 for="IdPsicologo">IdPsicologo</h3>
                                    <input type="text" id="IdPaciente" class="input" value="<?= $patient[0] ?>" name="IdPaciente" />
                                </div>
                                <div class="input-group2">
                                    <div class="input-group-modal">
                                        <h3 for="NomPaciente">Nombre</h3>
                                        <input id="NomPaciente" type="text" value="<?= $patient[2] ?>" name="NomPaciente" class="input" required />
                                    </div>
                                    <div class="input-group-modal">
                                        <h3 for="Dni">DNI</h3>
                                        <input id="Dni" type="text" value="<?= $patient[5] ?>" name="Dni" class="input" required />
                                    </div>
                                </div>
                                <div class="input-group2">
                                    <div class="input-group-modal">
                                        <h3 for="ApPaterno">Apellido Paterno</h3>
                                        <input id="ApPaterno" type="text" value="<?= $patient[3] ?>" name="ApPaterno" class="input" required />
                                    </div>
                                    <div class="input-group-modal">
                                        <h3 for="ApMaterno">Apellido Materno</h3>
                                        <input id="ApMaterno" type="text" value="<?= $patient[4] ?>" name="ApMaterno" class="input" required />
                                    </div>
                                </div>
                                <div class="input-group2">
                                    <div style=" width:190px;" class="input-group-modal">
                                        <h3 for="FechaNacimiento">Fecha de nacimiento</h3>
                                        <input type="date" id="FechaNacimiento" value="<?= $patient[6] ?>" name="FechaNacimiento" max="<?= $fechamin ?>" value="<?= $fechamin ?>" onchange="calcularEdad()" />
                                    </div>
                                    <div class="input-group-modal">
                                        <h3 for="Edad">Edad</h3>
                                        <input type="text" id="Edad" value="<?= $patient[7] ?>" name="Edad" readonly />
                                    </div>
                                </div>
                                <div class="input-group2">
                                    <div class="input-group-modal">
                                        <h3 for="GradoInstruccion">Grado de instruccion</h3>
                                        <input id="GradoInstruccion" value="<?= $patient[8] ?>" type="text" name="GradoInstruccion" class="input" required />
                                    </div>
                                    <div class="input-group-modal">
                                        <h3 for="Ocupacion">Ocupacion</h3>
                                        <input type="text" id="Ocupacion" value="<?= $patient[9] ?>" class="input" name="Ocupacion" required />
                                    </div>
                                </div>
                                <div class="input-group2">
                                    <div style="width:190px" class="input-group-modal">
                                        <h3 for="EstadoCivil">Estado civil</h3>
                                        <select style="text-align:center" class="input" id="EstadoCivil" name="EstadoCivil" required>
                                            <option value="">Seleccionar</option>
                                            <option value="soltero" <?php echo ($patient[10] === 'soltero') ? 'selected' : ''; ?>>
                                                Soltero/a</option>
                                            <option value="casado" <?php echo ($patient[10] === 'casado') ? 'selected' : ''; ?>>
                                                Casado/a</option>
                                            <option value="divorciado" <?php echo ($patient[10] === 'divorciado') ? 'selected' : ''; ?>>Divorciado/a
                                            </option>
                                            <option value="viudo" <?php echo ($patient[10] === 'viudo') ? 'selected' : ''; ?>>
                                                Viudo/a</option>
                                        </select>

                                    </div>
                                    <div style=" width:190px;" class="input-group-modal">
                                        <h3 for="Genero">Género</h3>
                                        <select style="text-align:center" class="input" id="Genero" name="Genero" required>
                                            <option value="">Seleccionar</option>
                                            <option value="Masculino" <?php echo ($patient[11] === 'Masculino') ? 'selected' : ''; ?>>Masculino</option>
                                            <option value="Femenino" <?php echo ($patient[11] === 'Femenino') ? 'selected' : ''; ?>>
                                                Femenino</option>
                                            <option value="Otro" <?php echo ($patient[11] === 'Otro') ? 'selected' : ''; ?>>Otro
                                            </option>
                                        </select>

                                    </div>
                                </div>
                                <div class="input-group-modal">
                                    <h3 for="Telefono">Celular</h3>
                                    <input type="text" id="Telefono" value="<?= $patient[12] ?>" class="input" name="Telefono" placeholder="Ejemp. 955888222" required />
                                </div>
                                <div style="margin-left:2em" id="respuesta2"> </div>
                                <div class="input-group-modal">
                                    <h3 for="Email">Correo Electronico</h3>
                                    <input type="Email" id="Email" class="input" value="<?= $patient[13] ?>" name="Email" style="color: #7B7C89;" required />
                                </div>
                                <div style="margin-left:2em" id="respuesta3"> </div>
                                <div class="input-group-modal">
                                    <h3 for="Direccion">Direccion</h3>
                                    <input type="text" id="Direccion" class="input" value="<?= $patient[14] ?>" name="Direccion" />
                                </div>
                                <div class="input-group-modal">
                                    <h3 for="AntecedentesMedicos">Antecedentes médicos</h3>
                                    <input type="text" id="AntecedentesMedicos" value="<?= $patient[15] ?>" class="input" name="AntecedentesMedicos" style="color: #7B7C89;" required />
                                </div>
                                <div class="input-group-modal">
                                    <h3 for="MedicamentosPrescritos">Medicamentos Prescritos</h3>
                                    <input type="text" id="MedicamentosPrescritos" class="input" value="<?= $patient[17] ?>" name="MedicamentosPrescritos" style="color: #7B7C89;" required />
                                </div>


                                <div class="input-group-modal" style="display: none">
                                    <h3 for="IdPsicologo">IdPsicologo</h3>
                                    <input type="text" id="IdPsicologo" class="input" value="<?= $patient[16] ?>" name="IdPsicologo" value="<?= $_SESSION['IdPsicologo'] ?>" />
                                </div>
                                <!-- CAMPOS ESCONDIDOS -->
                                <div class="input-group-modal" style="display: none">
                                    <h3 for="IdPsicologo">Provincia</h3>
                                    <input type="text" id="IdPsicologo" class="input" value="<?= $patient[20] ?>" name="Provincia" value="<?= $patient[20] ?>" />
                                </div>
                                <div class="input-group-modal" style="display: none">
                                    <h3 for="IdPsicologo">Departamento</h3>
                                    <input type="text" id="IdPsicologo" class="input" value="<?= $patient[21] ?>" name="Departamento" value="<?= $patient[21] ?>" />
                                </div>
                                <div class="input-group-modal" style="display: none">
                                    <h3 for="IdPsicologo">Distrito</h3>
                                    <input type="text" id="IdPsicologo" class="input" value="<?= $patient[22] ?>" name="Distrito" value="<?= $patient[22] ?>" />
                                </div>
                                <!-- -->


                                <br>
                                <div class="modal-button-container">
                                    <button class="button-modal button-cancelar" onclick="closeModalEditar('<?= $patient[0] ?>')">Cancelar</button>
                                    <button class="button-modal button-editar">Guardar</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <script src="../Issets/js/pacientes.js"></script>
        <script src="../Issets/js/dashboard.js"></script>
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

    function openModalEliminar(id) {
        var modal = document.getElementById('modalEliminar' + id);
        modal.classList.add('active');
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
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
    <link rel="stylesheet" href="../Issets/css/main.css">
    <link rel="stylesheet" href="../Issets/css/paciente.css">
    <link rel="icon" href="../img/favicon.png">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <title>Datos del Paciente</title>
  </head>

  <body>
    <div class="container">
      <?php
      require_once '../Issets/views/Menu.php';
      ?>
      <main class="animate__animated animate__fadeIn">
        <?php
        require_once '../Issets/views/Info.php';
        $departamentos = $Psi->MostrarDepartamento();
        ?>
        <div>
          <form id="miFormulario" action="../Crud/Paciente/guardarPaciente.php" method="post">
            <h4><a href="TablaPacientes.php" style="float: left;color: #6B93F3;">
                Datos del Paciente</a></h4>
            <br>
            <div class="contenedorFormularios">
              <div class="checkout-information">
                <div class="input-group2">
                  <div class="input-group">
                    <h3 for="NomPaciente">Nombre</h3>
                    <input id="NomPaciente" type="text" name="NomPaciente" class="input" data-error-target="error-nombre" />
                    <span class="error-message" id="error-nombre"></span>
                  </div>
                  <div class="input-group">
                    <h3 for="Dni">DNI</h3>
                    <input id="Dni" type="text" name="Dni" class="input" data-error-target="error-dni" />
                    <span class="error-message" id="error-dni"></span>
                  </div>
                </div>
                <div style="margin-left:2em; display: none;" id="respuesta"> </div>
                <div class="input-group2">
                  <div class="input-group">
                    <h3 for="ApPaterno">Apellido Paterno</h3>
                    <input id="ApPaterno" type="text" name="ApPaterno" class="input" data-error-target="error-apPaterno" />
                    <span class="error-message" id="error-apPaterno"></span>
                  </div>
                  <div class="input-group">
                    <h3 for="ApMaterno">Apellido Materno</h3>
                    <input id="ApMaterno" type="text" name="ApMaterno" class="input" data-error-target="error-apMaterno" />
                    <span class="error-message" id="error-apMaterno"></span>
                  </div>
                </div>
                <div class="input-group2">
                  <?php
                  date_default_timezone_set('America/Lima');
                  $fechamin = date("2015-01-31")
                  ?>
                  <div class="input-group">
                    <h3 for="FechaNacimiento">Fecha de nacimiento</h3>
                    <input type="date" id="FechaNacimiento" name="FechaNacimiento" onchange="calcularEdad()" data-error-target="error-fechaNac" />
                    <span class="error-message" id="error-fechaNac"></span>
                  </div>
                  <div class="input-group">
                    <h3 for="Edad">Edad</h3>
                    <input type="text" id="Edad" name="Edad" readonly />
                  </div>
                </div>
                <div class="input-group2">
                  <div class="input-group">
                    <h3 for="GradoInstruccion">Grado de instruccion</h3>
                    <input id="GradoInstruccion" type="text" name="GradoInstruccion" class="input" data-error-target="error-grado" />
                    <span class="error-message" id="error-grado"></span>
                  </div>
                  <div class="input-group">
                    <h3 for="Ocupacion">Ocupacion</h3>
                    <input type="text" id="Ocupacion" class="input" name="Ocupacion" data-error-target="error-ocupacion" />
                    <span class="error-message" id="error-ocupacion"></span>
                  </div>
                </div>
                <div class="input-group2">
                  <div class="input-group">
                    <h3 for="EstadoCivil">Estado civil</h3>
                    <select style="text-align:center" class="input" id="EstadoCivil" name="EstadoCivil" data-error-target="error-estadoCivil">
                      <option value="">Seleccionar</option>
                      <option value="soltero">Soltero/a</option>
                      <option value="casado">Casado/a</option>
                      <option value="divorciado">Divorciado/a</option>
                      <option value="viudo">Viudo/a</option>
                    </select>
                    <span class="error-message" id="error-estadoCivil"></span>
                  </div>
                  <div class="input-group">
                    <h3 for="Genero">Género</h3>
                    <select style="text-align:center" class="input" id="Genero" name="Genero" data-error-target="error-genero">
                      <option value="">Seleccionar</option>
                      <option value="Masculino">Masculino</option>
                      <option value="Femenino">Femenino</option>
                      <option value="Otro">Otro</option>
                    </select>
                    <span class="error-message" id="error-genero"></span>
                  </div>
                </div>
                <div class="input-group">
                  <h3 for="Telefono">Celular</h3>
                  <input type="tel" id="Telefono" class="input" name="Telefono" placeholder="Ejemp. 955888222" style="color: #7B7C89;" data-error-target="error-telefono" />
                  <span class="error-message" id="error-telefono"></span>
                </div>
                <div style="margin-left:2em; display: none;" id="respuesta2"> </div>
              </div>
              <div class="checkout-information">
                <div class="input-group">
                  <h3 for="Email">Correo Electronico</h3>
                  <input type="Email" id="Email" class="input" name="Email" style="color: #7B7C89;" data-error-target="error-email" />
                  <span class="error-message" id="error-email"></span>
                </div>
                <div style="margin-left:2em; display: none;" id="respuesta3"> </div>
                <div class="input-group2">
                  <div class="input-group">
                    <h3 for="Departamento">Departamento</h3>
                    <select style="text-align: center" class="input" id="Departamento" name="Departamento" data-error-target="error-departamento">
                      <option value="">Seleccionar</option>
                      <?php foreach ($departamentos as $departamento) : ?>
                        <option value="<?php echo $departamento['id']; ?>" data-id="<?php echo $departamento['id']; ?>"><?php echo $departamento['name']; ?></option>
                      <?php endforeach; ?>
                    </select>
                    <span class="error-message" id="error-departamento"></span>
                  </div>
                  <div class="input-group">
                    <h3 for="Provincia">Provincia</h3>
                    <select style="text-align: center" class="input" id="Provincia" name="Provincia" data-error-target="error-provincia">
                      <option value="">Seleccionar</option>
                      <option value="P">Prueba</option>
                      <?php foreach ($provincias as $provincia) : ?>
                        <option value="<?php echo $provincia['id']; ?>" data-id="<?php echo $provincia['id']; ?>"><?php echo $provincia['name']; ?></option>
                      <?php endforeach; ?>
                    </select>
                    <span class="error-message" id="error-provincia"></span>
                  </div>
                </div>
                <div class="input-group2">
                  <div class="input-group">
                    <h3 for="Distrito">Distrito</h3>
                    <select style="text-align:center" class="input" id="Distrito" name="Distrito" data-error-target="error-distrito">
                      <option value="">Seleccionar</option>
                      <option value="P">Prueba</option>
                    </select>
                    <span class="error-message" id="error-distrito"></span>
                  </div>
                  <div class="input-group">
                    <h3 for="Direccion">Dirección</h3>
                    <input type="text" id="Direccion" class="input" name="Direccion" style="color: #7B7C89;" data-error-target="error-direccion" />
                    <span class="error-message" id="error-direccion"></span>
                  </div>
                </div>
                <div class="input-group">
                  <h3 for=" AntecedentesMedicos">Antecedentes médicos</h3>
                  <input type="text" id="AntecedentesMedicos" class="input" name="AntecedentesMedicos" style="color: #7B7C89;" data-error-target="error-antecedentes" />
                  <span class="error-message" id="error-antecedentes"></span>
                </div>
                <div class="input-group">
                  <h3 for=" MedicamentosPrescritos">Medicamentos Prescritos</h3>
                  <input type="text" id="MedicamentosPrescritos" class="input" name="MedicamentosPrescritos" style="color: #7B7C89;" data-error-target="error-medicamentos" />
                  <span class="error-message" id="error-medicamentos"></span>
                </div>
                <div class="input-group" style="display: none">
                  <h3 for="IdPsicologo">IdPsicologo</h3>
                  <input type="text" id="IdPsicologo" class="input" name="IdPsicologo" value="<?= $_SESSION['IdPsicologo'] ?>" />
                </div>
              </div>
            </div>
            <br>
            <div class="button-container">
              <a class="btn bg-celeste" href="RegAreaFamiliar.php" id="contenido">Registro Familiar</a>
              <a class="btn bg-celeste" href="RegAtencionPaciente.php" id="contenido">Atencion al Paciente</a>
              <button id="submitButton" class="btn bg-azul">Registrar</button>
            </div>
          </form>
        </div>
      </main>

      <div id="notification" style="display: none;" class="notification">
        <p id="notification-text"></p>
        <span class="notification__progress"></span>
      </div>
      <script src="../Issets/js/dashboard.js"></script>
      <script src="../js/ubicacion.js"></script>
      <script src="../Issets/js/validationMessageGeneral.js"></script>
      <script>
        // Llamada a la función que está en el archivo externo
        const fieldsConfig = {
          'NomPaciente': 'El nombre es obligatorio.',
          'Dni': 'El DNI es obligatorio.',
          'ApPaterno': 'El apellido paterno es obligatorio.',
          'ApMaterno': 'El apellido materno es obligatorio.',
          'FechaNacimiento': 'La fecha de nacimiento es obligatoria.',
          'GradoInstruccion': 'El grado de instrucción es obligatorio.',
          'Ocupacion': 'La ocupación es obligatoria.',
          'EstadoCivil': 'El estado civil es obligatorio.',
          'Genero': 'El género es obligatorio.',
          'Telefono': 'El teléfono es obligatorio.',
          'Email': 'El correo electrónico es obligatorio.',
          'Departamento': 'El departamento es obligatorio.',
          'Provincia': 'La provincia es obligatoria.',
          'Distrito': 'El distrito es obligatorio.',
          'Direccion': 'La dirección es obligatoria.',
          'AntecedentesMedicos': 'Los antecedentes médicos son obligatorios.',
          'MedicamentosPrescritos': 'Los medicamentos prescritos son obligatorios.'
        };

        document.getElementById('miFormulario').addEventListener('submit', function(e) {
          e.preventDefault();
          if (validateForm(fieldsConfig)) {
            e.target.submit();
          }
        });
      </script>
  </body>

  </html>
<?php
} else {
  header("Location: ../Index.php");
}
?>
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
    <link rel="stylesheet" href="../Issets/css/paciente.css">
    <link rel="stylesheet" href="../Issets/css/main.css">
    <link rel="icon" href="../img/Logo.png">
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
          <form action="../Crud/Paciente/guardarPaciente.php" method="post">
            <h4><a href="TablaPacientes.php" style="float: left;color: #6B93F3;">
                Datos del Paciente</a></h4>
            <br>
            <div style="display:flex; flex-direction:row; gap:70px;">
              <div class="checkout-information">
                <div class="input-group2">
                  <div class="input-group">
                    <h3 for="NomPaciente">Nombre</h3>
                    <input id="NomPaciente" type="text" name="NomPaciente" class="input" required />
                  </div>
                  <div class="input-group">
                    <h3 for="Dni">DNI</h3>
                    <input id="Dni" type="text" name="Dni" class="input" required />
                  </div>
                </div>
                <div style="margin-left:2em" id="respuesta"> </div>
                <div class="input-group2">
                  <div class="input-group">
                    <h3 for="ApPaterno">Apellido Paterno</h3>
                    <input id="ApPaterno" type="text" name="ApPaterno" class="input" required />
                  </div>
                  <div class="input-group">
                    <h3 for="ApMaterno">Apellido Materno</h3>
                    <input id="ApMaterno" type="text" name="ApMaterno" class="input" required />
                  </div>
                </div>
                <div class="input-group2">
                  <?php
                  date_default_timezone_set('America/Lima');
                  $fechamin = date("2015-01-31")
                  ?>
                  <div style=" width:190px;" class="input-group">
                    <h3 for="FechaNacimiento">Fecha de nacimiento</h3>
                    <input type="date" id="FechaNacimiento" name="FechaNacimiento" max="<?= $fechamin ?>" value="<?= $fechamin ?>" onchange="calcularEdad()" />
                  </div>
                  <div class="input-group">
                    <h3 for="Edad">Edad</h3>
                    <input type="text" id="Edad" name="Edad" readonly />
                  </div>
                </div>
                <div class="input-group2">
                  <div class="input-group">
                    <h3 for="GradoInstruccion">Grado de instruccion</h3>
                    <input id="GradoInstruccion" type="text" name="GradoInstruccion" class="input" required />
                  </div>
                  <div class="input-group">
                    <h3 for="Ocupacion">Ocupacion</h3>
                    <input type="text" id="Ocupacion" class="input" name="Ocupacion" required />
                  </div>
                </div>
                <div class="input-group2">
                  <div style="width:190px" class="input-group">
                    <h3 for="EstadoCivil">Estado civil</h3>
                    <select style="text-align:center" class="input" id="EstadoCivil" name="EstadoCivil" required>
                      <option value="">Seleccionar</option>
                      <option value="soltero">Soltero/a</option>
                      <option value="casado">Casado/a</option>
                      <option value="divorciado">Divorciado/a</option>
                      <option value="viudo">Viudo/a</option>
                    </select>
                  </div>
                  <div style=" width:190px;" class="input-group">
                    <h3 for="Genero">Género</h3>
                    <select style="text-align:center" class="input" id="Genero" name="Genero" required>
                      <option value="">Seleccionar</option>
                      <option value="Masculino">Masculino</option>
                      <option value="Femenino">Femenino</option>
                      <option value="Otro">Otro</option>
                    </select>
                  </div>
                </div>
                <div class="input-group">
                  <h3 for="Telefono">Celular</h3>
                  <input type="tel" id="Telefono" class="input" name="Telefono" placeholder="Ejemp. 955888222" style="color: #7B7C89;" required />
                </div>
                <div style="margin-left:2em" id="respuesta2"> </div>
              </div>
              <div class="checkout-information">
                <div class="input-group">
                  <h3 for="Email">Correo Electronico</h3>
                  <input type="Email" id="Email" class="input" name="Email" style="color: #7B7C89;" required />
                </div>
                <div style="margin-left:2em" id="respuesta3"> </div>
                <div class="input-group2">
                  <div style="width: 190px" class="input-group">
                    <h3 for="Departamento">Departamento</h3>
                    <select style="text-align: center" class="input" id="Departamento" name="Departamento" required>
                      <option value="">Seleccionar</option>
                      <?php foreach ($departamentos as $departamento) : ?>
                        <option value="<?php echo $departamento['id']; ?>" data-id="<?php echo $departamento['id']; ?>"><?php echo $departamento['name']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div style="width: 190px" class="input-group">
                    <h3 for="Provincia">Provincia</h3>
                    <select style="text-align: center" class="input" id="Provincia" name="Provincia" required>
                      <option value="">Seleccionar</option>
                    </select>
                  </div>
                </div>
                <div class="input-group2">
                  <div style="width:190px" class="input-group">
                    <h3 for="Distrito">Distrito</h3>
                    <select style="text-align:center" class="input" id="Distrito" name="Distrito" required>
                      <option value="">Seleccionar</option>
                    </select>
                  </div>
                  <div class="input-group">
                    <h3 for="Direccion">Dirección</h3>
                    <input type="text" id="Direccion" class="input" name="Direccion" style="color: #7B7C89;" required />
                  </div>
                </div>
                <div class="input-group">
                  <h3 for="AntecedentesMedicos">Antecedentes médicos</h3>
                  <input type="text" id="AntecedentesMedicos" class="input" name="AntecedentesMedicos" style="color: #7B7C89;" required />
                </div>
                <div class="input-group">
                  <h3 for="MedicamentosPrescritos">Medicamentos Prescritos</h3>
                  <input type="text" id="MedicamentosPrescritos" class="input" name="MedicamentosPrescritos" style="color: #7B7C89;" required />
                </div>
                <div class="input-group" style="display: none">
                  <h3 for="IdPsicologo">IdPsicologo</h3>
                  <input type="text" id="IdPsicologo" class="input" name="IdPsicologo" value="<?= $_SESSION['IdPsicologo'] ?>" />
                </div>
              </div>
            </div>
            <br>
            <div class="button-container">
              <a class="btn bg-celeste" href="RegAreaFamiliar.php" id="contenido" style="margin-top: 10px;display: flex;gap: 10px;font-size:15px; ">Registro Familiar</a>
              <a class="btn bg-celeste" href="RegAtencionPaciente.php" id="contenido" style="margin-top: 10px;display: flex;gap: 10px;font-size:15px;">Atencion al Paciente</a>
              <button id="submitButton" class="btn bg-azul">FINALIZAR</button>
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
  </body>

  </html>
<?php
} else {
  header("Location: ../Index.php");
}
?>
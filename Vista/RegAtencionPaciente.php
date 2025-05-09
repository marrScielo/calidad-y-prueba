<?php
session_start();
if (isset($_SESSION['NombrePsicologo'])) {
  // Datos de conexión a la base de datos
  $servidor = "localhost";
  $usuario = "root";
  $contrasena = "";
  $basedatos = "contigovoy3";

  // Crear conexión
  $conexion = new mysqli($servidor, $usuario, $contrasena, $basedatos);

  // Verificar conexión
  if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
  }

?>
  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,1,0" />
    <link rel="stylesheet" href="../Issets/css/paciente.css">
    <link rel="stylesheet" href="../Issets/css/main.css">
    <link rel="icon" href="../img/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Datos del Paciente</title>
  </head>

  <body>
    <div class="container">
      <?php
      require_once '../Issets/views/Menu.php';
      ?>
      <!----------- end of aside -------->
      <main class="animate__animated animate__fadeIn">
        <?php
        require_once '../Issets/views/Info.php';
        ?>
        <div class="container-form">
          <div class="recent-updates">
            <form id="miFormulario" action="../Crud/Paciente/guardarAtencPaciente.php" method="post">
        
              <h4>
                Atencion al Paciente
              </h4>
              <br>
              <div style="display:flex; flex-direction:row; gap:70px;">
                <div class="checkout-information">
                  <a style="display: none;"></a>
                  <div class="input-group2">
                    <div class="input-group" style="display:none; width: 55%;">
                      <h3 for="IdPaciente">Id Paciente <b style="color:red">*</b></h3>
                      <div style="display: flex; gap:5px;">
                        <input id="IdPaciente" type="text" name="IdPaciente" />
                        <a class="search id"><span style="font-size:4em" class="material-symbols-sharp">search</span></a>
                      </div>
                    </div>
                    <div class="input-group">
                      <h3 for="codigopac">Codigo Paciente <b style="color:red">*</b></h3>
                      <div style="display: flex; gap:5px;">
                        <input id="codigopac" type="text" name="codigopac" class="input" data-error-target="error-codigopac" />
                        <a class="search codigoaa"><span style="font-size:4em" class="material-symbols-sharp">search</span></a>
                      </div>
                      <span class="error-message-RegAP" id="error-codigopac"></span>
                    </div>
                    <div class="input-group">
                      <h3 for="NomPaciente">Nombre Paciente </h3>
                      <div style="display: flex; gap:5px;">
                        <input id="NomPaciente" type="text" name="NomPaciente" class="input" data-error-target="error-nombrepac" />
                        <a class="search nom"><span style="font-size:4em" class="material-symbols-sharp">search</span></a>
                      </div>
                      <span class="error-message-RegAP" id="error-nombrepac"></span>
                    </div>
                  </div>
                  <div class="input-group" style="width: 100%;">
                    <h3 for="Paciente">Paciente</h3>
                    <input id="Paciente" type="text" name="Paciente" class="input" readonly data-error-target="error-paciente" />
                    <span class="error-message-RegAP" id="error-paciente"></span>
                  </div>
                  <div class="input-group2">
                    <div class="input-group">
                      <h3 for="MotivoConsulta">Motivo de la Consulta</h3>
                      <input id="MotivoConsulta" type="text" name="MotivoConsulta" class="input" data-error-target="error-motivo" />
                      <span class="error-message-RegAP" id="error-motivo"></span>
                    </div>
                    <div class="input-group">
                      <h3 for="FormaContacto">Forma de Contacto</h3>
                      <input id="FormaContacto" type="text" name="FormaContacto" class="input" data-error-target="error-contacto" />
                      <span class="error-message-RegAP" id="error-contacto"></span>
                    </div>
                  </div>
                  <div class="input-group" style="width: 100%;">
                    <h3 for="Diagnostico">Diagnostico</h3>
                    <textarea style="resize: none; padding: 1.2em 1em 2.8em 1em;font-family: 'Montserrat', sans-serif;	font-size: 14px;" type="text" id="Diagnostico" name="Diagnostico" placeholder="Ingrese su diagnostico" data-error-target="error-diagnostico"></textarea>
                    <span class="error-message-RegAP" id="error-diagnostico"></span>
                  </div>
                  <div class="input-group" style="width: 100%;">
                    <h3 for="Tratamiento">Tratamiento</h3>
                    <textarea style="resize: none; padding: 1.2em 1em 2.8em 1em;font-family: 'Montserrat', sans-serif;	font-size: 14px;" type="text" id="Tratamiento" name="Tratamiento" placeholder="Tratamiento" data-error-target="error-tratamiento"></textarea>
                    <span class="error-message-RegAP" id="error-tratamiento"></span>
                  </div>
                </div>
                <div class="checkout-information">
                  <div class="input-group" style="width: 100%;">
                    <h3 for="Observacion">Observacion</h3>
                    <textarea style="resize: none; padding: 1.2em 1em 2.8em 1em;font-family: 'Montserrat', sans-serif;	font-size: 14px;" type="text" id="Observacion" name="Observacion" placeholder="Observacion" data-error-target="error-observacion"></textarea>
                    <span class="error-message-RegAP" id="error-observacion"></span>
                  </div>
                  <div class="input-group" style="width: 100%;">
                    <h3 for="UltimosObjetivos">Ultimos Objetivo / Objetivo alcanzado </h3>
                    <textarea style="resize: none; padding: 1.2em 1em 2.8em 1em;font-family: 'Montserrat', sans-serif;	font-size: 14px;" type="text" id="UltimosObjetivos" name="UltimosObjetivos" placeholder="Objetivos Alcanzados" data-error-target="error-objetivos"></textarea>
                    <span class="error-message-RegAP" id="error-objetivos"></span>
                  </div>
                  <div class="input-group2">
                    <div class="input-group">
                      <h3 for="dsm5 ">DSM5</h3>
                      <div style="display: flex;gap:5px;">
                        <!-- <input id="dsm5" type="text" name="dsm5" class="input" data-error-target="error-dsm5" />
                        <a class="search btndsm5"><span style="font-size:4em" class="material-symbols-sharp">search</span></a> -->
                        <select id="dsm5" name="dsm5" class="input" data-error-target="error-dsm5">
                          <option value="">Seleccione una opción</option>
                        </select>
                      </div>
                      <span class="error-message-RegAP" id="error-dsm5"></span>
                    </div>
                    <div class="input-group">
                      <h3 for="cea10">CEA10</h3>
                      <div style="display: flex;gap:5px;">
                        <!-- <input id="cea10" type="text" name="cea10" class="input" data-error-target="error-cea10" />
                        <a class="search btncea10"><span style="font-size:4em" class="material-symbols-sharp">search</span></a> -->
                        <select id="cea10" name="cea10" class="input" data-error-target="error-cea10">
                          <option value="">Seleccione una opción</option>
                        </select>
                      </div>
                      <span class="error-message-RegAP" id="error-cea10"></span>
                    </div>
                  </div>
                  <div class="input-group" style="flex-direction: column;   width: 100%;">
                    <h3 for="DescripcionEnfermedad">Clasificacion</h3>
                    <div style="display: flex; gap:5px; ">
                      <input style="width: 100%;" id="DescripcionEnfermedad" type="text" name="DescripcionEnfermedad" class="input" data-error-target="error-enfermedad" disabled />
                    </div>
                    <span class="error-message-RegAP" id="error-enfermedad"></span>
                  </div>
                  <div class="input-group" style="display: none;">
                    <h3 for="IdEnfermedad">IdEnfermedad</h3>
                    <input id="IdEnfermedad" type="text" name="IdEnfermedad" class="input" readonly data-error-target="error-idEnfermedad" />
                  </div>
                  <span class="error-message-RegAP" id="error-idEnfermedad"></span>
                </div>
              </div>
              <br>
              <div class="button-container">
                <button class="button" onclick="history.go(-1); return false;">Volver</button>
                <button id="submitButton" class="button">Registrar</button>
              </div>
            </form>
          </div>
        </div>
      </main>
      <script src="../Issets/js/Dashboard.js"></script>
  </body>
  <script src="../Issets/js/validationMessageGeneral.js"></script>
  <script>
    
    // Obtener el valor de un parámetro de la URL
    function getQueryParam(param) {
      const urlParams = new URLSearchParams(window.location.search);
      return urlParams.get(param);
    }
    // Obtener el ID del paciente de la URL 
    const patientId = getQueryParam('id');
    console.log('Patient ID:', patientId);

    //* Si se obtiene un ID de paciente en la URL, realiza una solicitud AJAX para obtener los datos del paciente
    if (patientId) {
      $(document).ready(function() {
        // Ejecutar el código solo si se obtiene un id en la URL
        var codigopac = 'PA00' + patientId;
        var idPsicologo = <?php echo $_SESSION['IdPsicologo']; ?>;

        // Realizar la solicitud AJAX al servidor
        $.ajax({
          url: '../Crud/Fetch/fetch_paciente.php', // Archivo PHP que procesa la solicitud
          method: 'POST',
          data: {
            codigopac: codigopac,
            idPsicologo: idPsicologo
          },
          success: function(response) {
            if (response.hasOwnProperty('error')) {
              $('#Paciente').val(response.error);
              $('#IdPaciente').val('');
              $('#codigopac').val(codigopac);
              $('#Diagnostico').val('');
              $('#Tratamiento').val('');
              $('#MotivoConsulta').val('');
              $('#FormaContacto').val('');
              $('#Observacion').val('');
              $('#UltimosObjetivos').val('');
            } else {
              // Actualizar los campos del formulario con los datos del paciente
              $('#Paciente').val(response.nombre);
              $('#IdPaciente').val(response.id);
              $('#NomPaciente').val(response.nombre);
              $('#codigopac').val(codigopac); // Actualizar el campo de código paciente
              $('#Diagnostico').val(response.diagnostico);
              $('#Tratamiento').val(response.tratamiento);
              $('#MotivoConsulta').val(response.motivoConsulta);
              $('#FormaContacto').val(response.formaContacto);
              $('#Observacion').val(response.observacion);
              $('#UltimosObjetivos').val(response.ultimosObjetivos);
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
            $('#Paciente').val('Error al procesar la solicitud');
            $('#IdPaciente').val('');
            $('#codigopac').val(codigopac);
            $('#Diagnostico').val('');
            $('#Tratamiento').val('');
            $('#MotivoConsulta').val('');
            $('#FormaContacto').val('');
            $('#Observacion').val('');
            $('#UltimosObjetivos').val('');
            console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
          }
        });
      });
    }




    // Llamada a la función que está en el archivo externo
    const fieldsConfig = {
      'codigopac': 'El código del paciente es obligatorio.',
      'NomPaciente': 'El nombre del paciente es obligatorio.',
      'Paciente': 'El paciente es obligatorio.',
      'MotivoConsulta': 'El motivo de la consulta es obligatorio.',
      'FormaContacto': 'La forma de contacto es obligatoria.',
      'Diagnostico': 'El diagnóstico es obligatorio.',
      'Tratamiento': 'El tratamiento es obligatorio.',
      'Observacion': 'La observación es obligatoria.',
      'UltimosObjetivos': 'Los últimos objetivos son obligatorios.',
      'dsm5': 'El DSM5 es obligatorio.',
      'cea10': 'El CEA10 es obligatorio.',
      'DescripcionEnfermedad': 'La clasificación es obligatoria.'
    };

    document.getElementById('miFormulario').addEventListener('submit', function(e) {
      e.preventDefault();
      if (validateForm(fieldsConfig)) {
        e.target.submit();
      }
    });
  </script>
  <script>
document.addEventListener('DOMContentLoaded', function() {
    fetch('../Crud/Fetch/fetch_valores_enfermedad.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la red: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            const enfermedadesSelect = document.getElementById('cea10');
            const enfermedadesSelectDSM5 = document.getElementById('dsm5');

            enfermedadesSelect.innerHTML = '';
            enfermedadesSelectDSM5.innerHTML = '';
            const defaultOption = document.createElement('option');
            const defaultOptionDSM5 = document.createElement('option');
            defaultOptionDSM5.value = '';
            defaultOptionDSM5.textContent = 'Seleccione una opción';
            enfermedadesSelectDSM5.appendChild(defaultOptionDSM5);
            defaultOption.value = '';
            defaultOption.textContent = 'Seleccione una opción';
            enfermedadesSelect.appendChild(defaultOption);
            data["data"].forEach(function(item) {
                const option = document.createElement('option');
                option.value = item.CEA10;
                option.textContent = item.CEA10;
                enfermedadesSelect.appendChild(option);
                // Agregar opciones a la lista de opciones de la select de DSM5
                const optionDSM5 = document.createElement('option');
                optionDSM5.value = item.DSM5;
                optionDSM5.textContent = item.DSM5;
                enfermedadesSelectDSM5.appendChild(optionDSM5);
            });
           
        })
        .catch(error => {
            console.error('Error al obtener los datos:', error);
        });
});
</script>

  <script>
    // Buscador de la dsm5
    $(document).ready(function() {
      $('#dsm5').change(function() {
        var dsm5 = $('#dsm5').val();
        $.ajax({
          url: '../Crud/Fetch/fetch_dsm5.php',
          method: 'POST',
          data: {
            dsm5: dsm5
          },
          success: function(response) {
            if (response.error) {
              $('#DescripcionEnfermedad').val('No existe esa enfermedad');
              $('#').val('');
              $('#IdEnfermedad').val('');
            } else {
              $('#DescripcionEnfermedad').val(response.nombre);
              $('#cea10').val(response.cea10);
              $('#IdEnfermedad').val(response.id);
            }
          },
          error: function() {
            $('#DescripcionEnfermedad').val('Error al procesar la solicitud');
            $('#cea10').val('');
            $('#IdEnfermedad').val('');
          }
        });
      });
    });

    // Buscador de la cea10
    $(document).ready(function() {
      $('#cea10').change(function() {
        var cea10 = $('#cea10').val();
        $.ajax({
          url: '../Crud/Fetch/fetch_cea10.php',
          method: 'POST',
          data: {
            cea10: cea10
          },
          success: function(response) {
            if (response.error) {
              $('#DescripcionEnfermedad').val('No existe esa enfermedad');
              $('#dsm5').val('');
              $('#IdEnfermedad').val('');
            } else {
              $('#DescripcionEnfermedad').val(response.nombre);
              $('#dsm5').val(response.dsm5);
              $('#IdEnfermedad').val(response.id);
            }
          },
          error: function() {
            $('#DescripcionEnfermedad').val('Error al procesar la solicitud');
            $('#dsm5').val('');
            $('#IdEnfermedad').val('');
          }
        });
      });
    });

    $(document).ready(function() {
      $('.codigoaa').click(function() {
        var codigopac = $('#codigopac').val();
        var NomPaciente = $('#NomPaciente').val();
        var idPsicologo = <?php echo $_SESSION['IdPsicologo']; ?>;

        // Realizar la solicitud AJAX al servidor
        $.ajax({
          url: '../Crud/Fetch/fetch_paciente.php', // Archivo PHP que procesa la solicitud
          method: 'POST',
          data: {
            codigopac: codigopac,
            idPsicologo: idPsicologo
          },
          success: function(response) {
            if (response.hasOwnProperty('error')) {
              $('#Paciente').val(response.error);
              $('#IdPaciente').val('');
              $('#codigopac').val('');
              $('#Diagnostico').val('');
              $('#Tratamiento').val('');
              $('#MotivoConsulta').val('');
              $('#FormaContacto').val('');
              $('#Observacion').val('');
              $('#UltimosObjetivos').val('');
            } else {
              // Actualizar los campos del formulario con los datos del paciente
              $('#Paciente').val(response.nombre);
              $('#IdPaciente').val(response.id);
              $('#NomPaciente').val(response.nombre);
              $('#codigopac').val(codigopac); // Actualizar el campo de código paciente
              $('#Diagnostico').val(response.diagnostico);
              $('#Tratamiento').val(response.tratamiento);
              $('#MotivoConsulta').val(response.motivoConsulta);
              $('#FormaContacto').val(response.formaContacto);
              $('#Observacion').val(response.observacion);
              $('#UltimosObjetivos').val(response.ultimosObjetivos);
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
            $('#Paciente').val('Error al procesar la solicitud');
            $('#IdPaciente').val('');
            $('#codigopac').val('');
            $('#Diagnostico').val('');
            $('#Tratamiento').val('');
            $('#MotivoConsulta').val('');
            $('#FormaContacto').val('');
            $('#Observacion').val('');
            $('#UltimosObjetivos').val('');
            console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
          }
        });
      });
    });





    // Buscador paciente segun su nombre 
    $(document).ready(function() {
      $('.nom').click(function() {
        var NomPaciente = $('#NomPaciente').val();
        var idPsicologo = <?php echo $_SESSION['IdPsicologo']; ?>;

        // Realizar la solicitud AJAX al servidor
        $.ajax({
          url: '../Crud/Fetch/fetch_pacienteNom.php', // Archivo PHP que procesa la solicitud
          method: 'POST',
          data: {
            NomPaciente: NomPaciente,
            idPsicologo: idPsicologo
          },
          success: function(response) {
            if (response.hasOwnProperty('error')) {
              $('#Paciente').val(response.error);
              $('#IdPaciente').val('');
              $('#codigopac').val('');
              $('#Diagnostico').val('');
              $('#Tratamiento').val('');
              $('#MotivoConsulta').val('');
              $('#FormaContacto').val('');
              $('#Observacion').val('');
              $('#UltimosObjetivos').val('');
            } else {
              $('#Paciente').val(response.nombre);
              $('#IdPaciente').val(response.id);
              $('#codigopac').val(response.codigopac);
              $('#Diagnostico').val(response.diagnostico);
              $('#Tratamiento').val(response.tratamiento);
              $('#MotivoConsulta').val(response.motivoConsulta);
              $('#FormaContacto').val(response.formaContacto);
              $('#Observacion').val(response.observacion);
              $('#UltimosObjetivos').val(response.ultimosObjetivos);
            }
          },
          error: function() {
            $('#Paciente').val('Error al procesar la solicitud');
            $('#IdPaciente').val('');
            $('#codigopac').val('');
            $('#Diagnostico').val('');
            $('#Tratamiento').val('');
            $('#MotivoConsulta').val('');
            $('#FormaContacto').val('');
            $('#Observacion').val('');
            $('#UltimosObjetivos').val('');
          }
        });
      });
    });
  </script>

  </html>
<?php
} else {
  header("Location: ../Index.php");
}
?>
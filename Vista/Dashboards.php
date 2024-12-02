<?php
session_start();
if (isset($_SESSION['rol'], $_SESSION['IdPsicologo']) && $_SESSION['rol'] == 'psicologo') {
  // Incluir los archivos necesarios
  require_once("../Controlador/Paciente/ControllerPaciente.php");
  require_once("../Controlador/Cita/ControllerCita.php");
  $PORC = new usernameControlerCita();
  $Pac = new usernameControlerPaciente();

  // Obtener el nombre actualizado del psicólogo desde los parámetros GET o la sesión
  if (isset($_GET['nombre'])) {
    $_SESSION['NombrePsicologo'] = $_GET['nombre'];
  }
  $nombrePsicologo = isset($_SESSION['NombrePsicologo']) ? $_SESSION['NombrePsicologo'] : 'Psicólogo'; // Cambia 'Psicólogo' por el valor por defecto que prefieras

  // Obtener otros datos necesarios para el dashboard
  $totalRegistrosEnCanalAtraccion = $PORC->contarCitasConfirmadasConCanal($_SESSION['IdPsicologo']);
  $totalRegistrosEnCanalAtraccion2 = $PORC->contarCitasConfirmadasConCanal2($_SESSION['IdPsicologo']);
  $totalRegistrosEnCanalAtraccion3 = $PORC->contarCitasConfirmadasConCanal3($_SESSION['IdPsicologo']);
  $totalPacientes = $PORC->contarRegistrosEnPacientes($_SESSION['IdPsicologo']);
  $totalPacientesRecientes = $PORC->contarPacientesConFechaActual($_SESSION['IdPsicologo']);
  $totalRegistrosEnCitasConfirmado = $PORC->contarCitasConfirmadas($_SESSION['IdPsicologo']);
  $totalRegistrosEnCitasHora = $PORC->obtenerFechasCitasConFechaActual($_SESSION['IdPsicologo']);
  $contarPacientesUltimoMes = $PORC->contarPacientesUltimoMes($_SESSION['IdPsicologo']);
  $Citas = $PORC->showByFecha($_SESSION['IdPsicologo']);
  $datos = $Pac->MostrarPacientesRecientes($_SESSION['IdPsicologo']);
  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,1,0" />
    <link rel="icon" href="../img/favicon.png">
    <link rel="stylesheet" href="../Issets/css/main.css">
    <link rel="stylesheet" href="../Issets/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  </head>

  <body>
    <style>
      @media (max-width: 900px) {
        body {}

        /* .center-divs {
          min-width: 800px;
        } */

        /* .contenedor_dsh {
          min-width: 800px;
        } */

        .animate__animated {
          overflow: auto;
        }

      }
    </style>
    <?php
    require_once("../Controlador/Paciente/ControllerPaciente.php");
    require_once("../Controlador/Cita/ControllerCita.php");
    $PORC = new usernameControlerCita();
    $Pac = new usernameControlerPaciente();
    /*Modificacion realizada */
    $totalRegistrosEnCanalAtraccion = $PORC->contarCitasConfirmadasConCanal($_SESSION['IdPsicologo']);
    $totalRegistrosEnCanalAtraccion2 = $PORC->contarCitasConfirmadasConCanal2($_SESSION['IdPsicologo']);
    $totalRegistrosEnCanalAtraccion3 = $PORC->contarCitasConfirmadasConCanal3($_SESSION['IdPsicologo']);
    /*----------------------------------------------------------------------------------------------------- */
    $totalPacientes = $PORC->contarRegistrosEnPacientes($_SESSION['IdPsicologo']);
    $totalPacientesRecientes = $PORC->contarPacientesConFechaActual($_SESSION['IdPsicologo']);
    $totalRegistrosEnCitasConfirmado = $PORC->contarCitasConfirmadas($_SESSION['IdPsicologo']);
    $totalRegistrosEnCitasHora = $PORC->obtenerFechasCitasConFechaActual($_SESSION['IdPsicologo']);
    $contarPacientesUltimoMes = $PORC->contarPacientesUltimoMes($_SESSION['IdPsicologo']);
    $Citas = $PORC->showByFecha($_SESSION['IdPsicologo']);
    $datos = $Pac->MostrarPacientesRecientes($_SESSION['IdPsicologo']);
    ?>
    <div class="container">
      <?php
      require_once '../Issets/views/Menu.php';
      ?>
      <main class="animate__animated animate__fadeIn">
        <div class="contenedor_dsh">
          <div>
            <h4>¡Buenos días, <?= $nombrePsicologo ?>!</h4>
            <h1>Tienes <span
                style="color:#416cd8; font-weight: bold; font-size:20px"><?= count($totalRegistrosEnCitasHora) ?>
                citas</span> programadas para hoy</h1>
          </div>
          <?php
          require_once '../Issets/views/Info.php';
          ?>
        </div>
        <div class="center-divs">
          <div class="agenda" translate="no">
            <?php
            $fecha_actual = new DateTime('now', new DateTimeZone('America/Lima'));

            // Llama a la función para obtener las citas con nombre del paciente, hora y minutos
            $citasConNombrePacienteHoraMinutos = (new UserModelCita())->obtenerCitasConNombrePacienteHoraMinutos2($_SESSION['IdPsicologo']);

            // Crear un arreglo para todas las citas (registradas y en blanco)
            $todas_las_citas = array();

            // Agregar las citas registradas al arreglo
            if (!empty($citasConNombrePacienteHoraMinutos)) {
              foreach ($citasConNombrePacienteHoraMinutos as $cita) {
                $hora_cita = new DateTime($cita['HoraMinutos']);
                $todas_las_citas[] = array(
                  'HoraMinutos' => $hora_cita,
                  'NomPaciente' => $cita['NomPaciente'],
                );
              }
            }

            // Crear un arreglo con todas las horas desde las 09:00 AM hasta las 12:00 PM
            $horas_disponibles = array();
            for ($i = 8; $i <= 24; $i++) {
              $hora = new DateTime("$i:00");
              $horas_disponibles[] = $hora;
            }

            // Agregar las citas en blanco al arreglo
            foreach ($horas_disponibles as $hora) {
              $cita_en_blanco = array(
                'HoraMinutos' => $hora,
                'NomPaciente' => '', // Dejar el nombre del paciente en blanco
              );

              // Verificar si hay una cita programada con la misma hora
              $eliminar_cita_en_blanco = false;

              foreach ($todas_las_citas as $cita_programada) {
                if ($cita_programada['HoraMinutos'] == $hora) {
                  $eliminar_cita_en_blanco = true;
                  break; // Salir del bucle al encontrar una coincidencia
                }
              }

              // Agregar la cita en blanco solo si no coincide con una cita programada
              if (!$eliminar_cita_en_blanco) {
                $todas_las_citas[] = $cita_en_blanco;
              }
            }

            // Ordenar todas las citas por hora
            usort($todas_las_citas, function ($a, $b) {
              return $a['HoraMinutos'] <=> $b['HoraMinutos'];
            });
            ?>

            <div class="div_event3">
              <?php
              // Obtener la fecha actual
              $fecha_actual = new DateTime();

              // Definir la configuración regional en español
              $localidad = 'es_ES';

              // Crear un formateador de fecha en español para el día y el mes
              $formato_fecha = new IntlDateFormatter($localidad, IntlDateFormatter::FULL, IntlDateFormatter::NONE, null, null, "d 'de' MMMM");

              // Formatear la fecha actual en el formato deseado
              $fecha_formateada = $formato_fecha->format($fecha_actual);

              // Imprimir la fecha
              echo "<div>
                          <h3 style='text-align: left; font-size: 16px;'>Citas del día</h3>
                          <p style='text-align: left; color: #fff;'>Hoy, $fecha_formateada</p>
                      </div>";
              ?>
              <div style="display:flex; align-items: center;">
                <a href="TablaCitas.php">
                  <span style="color: #fff" class="material-symbols-sharp" translate="no">add_circle</span>
                </a>
              </div>
            </div>
            <div class="contend_table">
              <table>
                <?php foreach ($todas_las_citas as $cita): ?>
                  <tr>
                    <td><?= $cita['HoraMinutos']->format('H:i A') ?></td>
                    <td>
                      <div class="section-cia">
                        <span><?= $cita["NomPaciente"] ?></span>
                        <a class="button3" href="RegCitas.php">Botón</a>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </table>
            </div>
          </div>
          <div class="recent-updates">
            <h2>Pacientes Recientes</h2>
            <div class="updates">
              <div class="update">
                <?php if ($datos): ?>
                  <?php foreach ($datos as $key): ?>
                    <div class="message">
                      <p><b><?= $key['NomPaciente'] ?>       <?= $key['ApPaterno'] ?>       <?= $key['ApMaterno'] ?>
                          (<?= $key['codigopac'] ?>)</b> <?= $key['Edad'] ?> años</p>
                      <?php
                      // Suponiendo que la fecha en $key['Fecha'] está en formato yyyy-mm-dd
                      $date = new DateTime($key['Fecha']);
                      $formattedDate = $date->format('d/m/Y');
                      ?>
                      <small class="text-muted">Registrado el: <?= $formattedDate ?></small>
                      <br>
                      <small class="text-muted">Hora: <?= $key['Hora'] ?></small>
                    </div>
                  <?php endforeach; ?>
                <?php else: ?>
                  <p style="text-align: center;">No hay Pacientes<a href="RegPaciente.php"> Agregar nuevo paciente </a> </p>
                <?php endif; ?>
              </div>
              <div>
                <a class="btn-addPacientes" href="RegPaciente.php" translate="no">Agregar Paciente</a>
              </div>
            </div>
          </div>
        </div>

        <!--<h2>Estadisticas</h2>-->
        <div class="center-graficos">
          <div class="insights" style="color: #534489; ">
            <div class="sales">
              <div class="middle">
                <h3 class="estadistica_h3">
                  <span style=" font-weight: bold; font-size:40px"><?= $totalPacientes ?></span> <br>Total de pacientes
                </h3>
              </div>
            </div>
            <!------------------- Final del Sales -------------------->

            <div class="expenses">
              <div class="middle">
                <h3 class="estadistica_h3">
                  <span style=" font-weight: bold; font-size:40px"><?= $totalPacientesRecientes ?></span> <br> Nuevos
                  pacientes
                </h3>
              </div>
            </div>
            <!------------------- Final del expenses -------------------->
            <div class="income">
              <div class="middle">
                <h3 class="estadistica_h3" translate="no">
                  <span style=" font-weight: bold; font-size:40px"><?= $totalRegistrosEnCitasConfirmado ?></span> <br>
                  Citas Confirmadas
                </h3>
              </div>
            </div>
            <!------------------- Final del income -------------------->
          </div>
          <div class="div-grafico">
            <h2 style="text-align: center;" translate="no">Citas del Ultimo mes</h2>
            <div class="grafico2">
              <div class="grafico">
                <canvas id="myPieChart"></canvas>
              </div>
            </div>
            <div class="texto-grafico">
              <h5 translate="no">Cita Online:<span> <?= $totalRegistrosEnCanalAtraccion ?> </span></h5>
              <h5 translate="no">Marketing Digital: <span><?= $totalRegistrosEnCanalAtraccion2 ?> </span></h5>
              <h5 translate="no">Referidos: <span><?= $totalRegistrosEnCanalAtraccion3 ?> </span></h5>
            </div>
          </div>

        </div>
      </main>

    </div>
    </div>
    <script src="../Issets/js/dashboard.js"></script>
    <script>
      // Importa los datos que deseas mostrar en el gráfico de pastel.
      var canalAtraccion1 = <?= $totalRegistrosEnCanalAtraccion ?>;
      var canalAtraccion2 = <?= $totalRegistrosEnCanalAtraccion2 ?>;
      var canalAtraccion3 = <?= $totalRegistrosEnCanalAtraccion3 ?>;

      // Define colores personalizados para cada canal de atracción
      var colores = ["#8CB7C2", "#7999A4", "#27ae60"];

      // Configura el gráfico de pastel
      var ctx = document.getElementById("myPieChart").getContext('2d');
      var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
          //labels: ["Cita Online", "Marketing Digital", "Canal Atracción 3"],
          datasets: [{
            backgroundColor: colores,
            data: [canalAtraccion1, canalAtraccion2, canalAtraccion3]
          }]
        },
        options: {
          responsive: true,
          legend: {
            display: true,
            position: 'bottom'
          }
        }
      });
    </script>
  </body>

  </html>
  <?php
} else {
  header("Location: ../index.php");
}
?>
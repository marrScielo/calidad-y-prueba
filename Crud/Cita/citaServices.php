<?php
require(__DIR__ . "/../../Controlador/Cita/ControllerCita.php");
$ControllerCita = new usernameControlerCita();
$idPsicologo = $_GET['idPsicologo'];
if (isset($_GET['NomPaciente'])) {
    $nomPaciente = $_GET['NomPaciente'];
    $citas = $ControllerCita->getAll($idPsicologo, null, $nomPaciente, null, null, null, 10, 0);
    echo json_encode($citas);
} elseif (isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];
    $citas = $ControllerCita->getAll($idPsicologo, null, null, $codigo, null, null, 10, 0);
    echo json_encode($citas);
} elseif (isset($_GET['dateStart']) && isset($_GET['dateEnd'])) {
    $dateStart = $_GET['dateStart'];
    $dateEnd = $_GET['dateEnd'];
    $citas = $ControllerCita->getAll($idPsicologo, null, null, null, $dateStart, $dateEnd, 10, 0);
    echo json_encode($citas);
} elseif (isset($_GET['IdCita'])) {
    $IdCita = $_GET['IdCita'];
    $citas = $ControllerCita->getAll($idPsicologo, $IdCita, null, null, null, null, 10, 0);
    echo json_encode($citas);
} else {
    $citas = $ControllerCita->getAll($idPsicologo, null, null, null, null, null, 10, 0);
    echo json_encode($citas);
}
<?php
require(__DIR__ . "/../../Controlador/Cita/ControllerCita.php");
$ControllerCita = new usernameControlerCita();
$idPsicologo = $_GET['idPsicologo'];
if(isset($_GET['NomPaciente'])){
    $nomPaciente = $_GET['NomPaciente'];
    $citas = $ControllerCita->getAll($idPsicologo, $nomPaciente, null, null, null, 10, 0);
    echo json_encode($citas);
}elseif(isset($_GET['codigo'])){
    $codigo = $_GET['codigo'];
    $citas = $ControllerCita->getAll(null, null, $codigo, null, null, 1, 0);
    echo json_encode($citas);
}elseif(isset($_GET['dateStart']) && isset($_GET['dateEnd'])){
    $dateStart = $_GET['dateStart'];
    $dateEnd = $_GET['dateEnd'];
    $citas = $ControllerCita->getAll(null, null, null, $dateStart, $dateEnd, 10, 0);
    echo json_encode($citas);
}
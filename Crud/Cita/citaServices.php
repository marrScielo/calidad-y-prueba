<?php
require(__DIR__ . "/../../Controlador/Cita/ControllerCita.php");
$ControllerCita = new usernameControlerCita();
$idPsicologo = $_GET['idPsicologo'];

$nomPaciente = $_GET['NomPaciente'] ?? null;
$codigo = $_GET['codigo'] ?? null;
$dateStart = $_GET['dateStart'] ?? null;
$dateEnd = $_GET['dateEnd'] ?? null;
$IdCita = $_GET['IdCita'] ?? null;
$page = $_GET['page'] ?? 0;

$citas = $ControllerCita->getAll(
    $idPsicologo,
    $IdCita,
    $nomPaciente,
    $codigo,
    $dateStart,
    $dateEnd,
    10,
    $page,
);
$countCitas = $ControllerCita->totalCitas(
    $idPsicologo,
    $IdCita,
    $nomPaciente,
    $codigo,
    $dateStart,
    $dateEnd,
);
echo json_encode(
    array(
        'total' => $countCitas,
        'citas' => $citas
    )
);
?>
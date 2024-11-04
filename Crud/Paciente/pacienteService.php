<?php

require_once(__DIR__ . "/../../Controlador/Paciente/ControllerPaciente.php");

$ControllerPaciente = new usernameControlerPaciente();

// $IdPsicologo = $_SESSION['IdPsicologo'];
$idPaciente = $_GET['idPaciente'];

$datos = $ControllerPaciente->show($idPaciente);

echo json_encode($datos);
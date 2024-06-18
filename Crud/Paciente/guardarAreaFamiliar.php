<?php
include 'config/config.php';
require_once BASE_PATH . 'Controlador/Paciente/ControllerPaciente.php';
// require_once BASE_PATH_WEB . 'Controlador/Paciente/ControllerPaciente.php';
// require_once("/home3/ghxumdmy/public_html/gestion-contigo-voy-com/Controlador/Paciente/ControllerPaciente.php");
$obj = new usernameControlerPaciente();
$obj->guardarAreaFamiliar($_POST['IdPaciente'], $_POST['NomPadre'],$_POST['EstadoPadre'], $_POST['NomMadre'],$_POST['EstadoMadre'],$_POST['NomApoderado'],$_POST['EstadoApoderado'], $_POST['CantHermanos'], $_POST['CantHijos'], $_POST['IntegracionFamiliar'], $_POST['HistorialFamiliar']);
?>

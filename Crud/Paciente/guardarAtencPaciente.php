<?php
include '../../config/config.php';
require_once BASE_PATH . '/Controlador/Paciente/ControllerPaciente.php';
// require_once BASE_PATH_WEB . 'Controlador/Paciente/ControllerPaciente.php';
// require_once("/home3/ghxumdmy/public_html/gestion-contigo-voy-com/Controlador/Paciente/ControllerPaciente.php");
$obj = new usernameControlerPaciente();
$obj->guardarAtencPac($_POST['IdPaciente'], $_POST['IdEnfermedad'], $_POST['MotivoConsulta'], $_POST['FormaContacto'], $_POST['Diagnostico'], $_POST['Tratamiento'],$_POST['Observacion'],$_POST['UltimosObjetivos']);?>

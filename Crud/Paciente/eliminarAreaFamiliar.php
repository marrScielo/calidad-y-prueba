<?php
require_once("../../Controlador/Paciente/ControllerAtencFamiliar.php");

$obj = new usernameControlerPaciente();

$obj->eliminarAreaFamiliar($_GET['id']);
?>

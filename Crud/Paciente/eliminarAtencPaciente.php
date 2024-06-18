<?php
require_once("../../Controlador/Paciente/ControllerAtencPaciente.php");

$obj = new usernameControlerPaciente();

$obj->eliminar($_GET['id']);
?>

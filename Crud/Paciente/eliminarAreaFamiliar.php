<?php
require_once("../../Controlador/Paciente/ControllerAtencFamiliar.php");

$obj = new usernameControlerPaciente();

$obj->eliminar($_GET['id']);
?>

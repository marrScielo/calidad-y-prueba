<?php
//local
require_once("../../Controlador/Paciente/ControllerPaciente.php");

//hosting
//$ruta_local = "/Controlador/Paciente/ControllerPaciente.php";
//$ruta_hosting = "/home3/ghxumdmy/public_html/website_ddbea1df";
//require_once($ruta_hosting . $ruta_local);

$obj = new usernameControlerPaciente();

$obj->eliminar($_GET['id']);
?>


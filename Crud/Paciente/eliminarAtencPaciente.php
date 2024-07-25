<?php
//local
require_once("../../Controlador/Paciente/ControllerAtencFamiliar.php");

//hosting
//$ruta_local = "/Controlador/Paciente/ControllerAtencFamiliar.php";
//$ruta_hosting = "/home3/ghxumdmy/public_html/website_1cf5dd5d";
//require_once($ruta_hosting . $ruta_local);

$obj = new usernameControlerPaciente();

$obj->eliminar($_GET['id']);
?>

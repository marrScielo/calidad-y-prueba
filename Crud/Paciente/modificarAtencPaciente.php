<?php

// /home3/ghxumdmy/public_html/website_ddbea1df
// require_once("../../Controlador/Paciente/ControllerAtencFamiliar.php");
$ruta_local = "/Controlador/Paciente/ControllerAtencPaciente.php";
$ruta_hosting = "/home3/ghxumdmy/public_html/website_ddbea1df";
require_once($ruta_hosting . $ruta_local);
$obj = new usernameControlerPaciente();
$obj->modificarAtencPaciente($_POST['IdAtencion'], $_POST['MotivoConsulta'], $_POST['FormaContacto'], $_POST['Diagnostico'], $_POST['Tratamiento'],$_POST['Observacion'],$_POST['UltimosObjetivos']);

?>

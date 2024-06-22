<?php
include '../../config/config.php';
// /home3/ghxumdmy/public_html/website_ddbea1df
// require_once("../../Controlador/Paciente/ControllerPaciente.php");
$ruta_local = "/Controlador/Paciente/ControllerPaciente.php";
$ruta_hosting = "/home3/ghxumdmy/public_html/gestion-contigo-voy-com";
require_once($ruta_hosting . $ruta_local);
$obj = new usernameControlerPaciente();
$obj->guardarAreaFamiliar($_POST['IdPaciente'], $_POST['NomPadre'],$_POST['EstadoPadre'], $_POST['NomMadre'],$_POST['EstadoMadre'],$_POST['NomApoderado'],$_POST['EstadoApoderado'], $_POST['CantHermanos'], $_POST['CantHijos'], $_POST['IntegracionFamiliar'], $_POST['HistorialFamiliar']);
?>

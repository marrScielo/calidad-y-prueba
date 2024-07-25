<?php

//local
//include '../../config/config.php';
// /home3/ghxumdmy/public_html/website_1cf5dd5d
require_once("../../Controlador/Paciente/ControllerPaciente.php");

//hosting
//$ruta_local = "/Controlador/Paciente/ControllerPaciente.php";
//$ruta_hosting = "/home3/ghxumdmy/public_html/website_1cf5dd5d";
//require_once($ruta_hosting . $ruta_local);

$obj = new usernameControlerPaciente();
$obj->guardarAtencPac($_POST['IdPaciente'], $_POST['IdEnfermedad'], $_POST['MotivoConsulta'], $_POST['FormaContacto'], $_POST['Diagnostico'], $_POST['Tratamiento'],$_POST['Observacion'],$_POST['UltimosObjetivos']);?>

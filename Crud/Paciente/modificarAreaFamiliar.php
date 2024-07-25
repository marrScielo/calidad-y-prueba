<?php
//local
// /home3/ghxumdmy/public_html/website_1cf5dd5d
require_once("../../Controlador/Paciente/ControllerAtencFamiliar.php");

//hosting
//$ruta_local = "/Controlador/Paciente/ControllerAtencFamiliar.php";
//$ruta_hosting = "/home3/ghxumdmy/public_html/website_1cf5dd5d";
//require_once($ruta_hosting . $ruta_local);

$obj = new usernameControlerPaciente();

$obj->ModificarAreaFamiliar($_POST['IdFamiliar'], $_POST['NomPadre'], $_POST['EstadoPadre'], $_POST['NomMadre'], $_POST['EstadoMadre'], $_POST['NomApoderado'], $_POST['EstadoApoderado'], $_POST['CantHermanos'], $_POST['CantHijos'], $_POST['IntegracionFamiliar'], $_POST['HistorialFamiliar']);

?>


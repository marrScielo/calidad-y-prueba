<?php

require_once("../../Controlador/Cita/ControllerCita.php");
//$ruta_local = "/Controlador/Cita/ControllerCita.php";
//$ruta_hosting = "/home3/ghxumdmy/public_html/website_ddbea1df";
//require_once($ruta_hosting . $ruta_local);

$obj = new usernameControlerCita();

$obj->eliminar($_GET['id']);
?>

<?php
// /home3/ghxumdmy/public_html/website_ddbea1df
// require_once("../../Controlador/Cita/ControllerCita.php");
require_once("/home3/ghxumdmy/public_html/website_ddbea1df/Controlador/Cita/ControllerCita.php");
$obj = new usernameControlerCita();

$obj->eliminar($_GET['id']);
?>

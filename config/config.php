<?php
/*  Hosting
define('NOMBRE_PROYECTO', 'website_ddbea1df');
define('BASE_PATH_WEB', '/home3/ghxumdmy/public_html/'.NOMBRE_PROYECTO.'/');*/

// Local
define('NOMBRE_PROYECTO','ContigoVoy'); 

define('BASE_PATH',$_SERVER['DOCUMENT_ROOT'].'/'.NOMBRE_PROYECTO); // en local=> C:/xampp/htdocs/ContigoVoy

define('CONEXION_PATH', BASE_PATH . '/conexion/conexion.php');
define('MODELCITAPATH', BASE_PATH . '/Modelo/Cita/ModelCita.php');
define('MODELlOGINPATH', BASE_PATH . '/Modelo/login/ModelLogin.php');
define('MODELPACIENTEPATH', BASE_PATH . '/Modelo/Paciente/ModelPaciente.php');

define('CONTROLCITAPATH', BASE_PATH . '/Controlador/Cita/ControllerCita.php');
define('CONTROLLOGINPATH', BASE_PATH . '/Controlador/login/ControllerLogin.php');
define('CONTROLPACIENTEPATH', BASE_PATH . '/Controlador/Paciente/ControllerPaciente.php');

?>
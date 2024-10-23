<?php
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$comentario = $_POST['comentario'];

$destinatario = "jma.roque.77153538@gmail.com";
$asunto = "Contacto desde la web";

$carta = "De: $nombre $apellidos \n";
$carta .= "Correo: $email \n";
$carta .= "Mensaje: $comentario";

mail($destinatario, $asunto, $carta);
header("Location: ./Contactanos.php");
exit();

?>

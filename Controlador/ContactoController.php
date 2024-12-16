<?php

require_once '../Modelo/ContactoModel.php';

class ContactoController
{
    private $contactoModel;

    public function __construct()
    {
        $this->contactoModel = new Contacto();
    }

    public function Request()
    {
        $this->crearModelo();
    }
    public function crearModelo(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $telefono = $_POST['phone'];
            $email = $_POST['email'];
            $mensaje = $_POST['comentario'];
            $apellidos = $_POST['apellidos'];
            $resultado = $this->contactoModel->create($nombre, $telefono, $email, $mensaje);
            if ($resultado === true) {
                $destino="contigovoyproject@gmail.com";
                $assunto="Contact Form";
                $nombre_limpio = strip_tags($nombre);
                $apellido_limpio = strip_tags($apellidos);
                $email_limpio = strip_tags($email);
                $mensaje_limpio = strip_tags($mensaje);

                $cuerpo = '
                <html>
                    <head>
                        <title>Contact Form</title>
                    </head>
                    <body>
                        <h1>Contact Form</h1>
                        <p>Name: <strong>' . $nombre_limpio . ' ' . $apellido_limpio . '</strong></p>
                        <p>Email: ' . $email_limpio . '</p>
                        <p>Message:  <strong>' . $mensaje_limpio . '</strong></p>
                    </body>
                </html>
                ';

                $headers="MIME-Version: 1.0\r\n";
                $headers.="Content-type: text/html; charset=utf-8\r\n";
                $headers.="From: $nombre $apellidos <$email>\r\n";
                $headers.="Return-Path:  $destino\r\n";
                mail($destino,$assunto,$cuerpo,$headers);              
                header("Location: ../index.php");
                exit(); 
            }else {
                echo 'Error al enviar mensaje en contactanos';
            }
        }
    }
}

$controller = new ContactoController();
$controller->Request();

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
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            case 'create':
                $this->crearModelo();
                break;
        }
    }
    public function crearModelo(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];
            $mensaje = $_POST['mensaje'];
            $resultado = $this->contactoModel->create($nombre, $telefono, $email, $mensaje);
      
            if ($resultado === true) {
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

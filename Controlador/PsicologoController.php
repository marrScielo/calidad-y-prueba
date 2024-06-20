<?php
require_once 'DatabaseController.php';
require_once './Modelo/PsicologoModel.php';

class PsicologosController {
    private $psicologoModel;

    public function __construct() {
        $db = new DatabaseController();
        $this->psicologoModel = new PsicologosModel($db);
    }

    public function mostrarPsicologos() {
        return $this->psicologoModel->getPsicologos();
    }

    public function buscarPorNombre($nombre) {
        return $this->psicologoModel->buscarPorNombre($nombre);
    }
}
?>

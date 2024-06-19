<?php
require_once 'Modelo/PsicologoModel.php';

class PsicologosController {
    private $model;

    public function __construct() {
        $this->model = new PsicologosModel();
    }

    public function mostrarPsicologos() {
        return $this->model->getPsicologos();
    }

    public function buscarPorNombre($nombre) {
        return $this->model->buscarPorNombre($nombre);
    }
}
?>

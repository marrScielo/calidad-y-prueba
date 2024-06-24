<?php
//local
require_once 'Modelo/UsuarioModel.php';

//require_once("/home3/ghxumdmy/public_html/website_ddbea1df/Modelo/UsuarioModel.php");

class UsuariosController {
    private $model;

    public function __construct() {
        $this->model = new UsuarioModel();
    }

    public function mostrarUsuarios() {
        return $this->model->getUsuarios();
    }

    public function buscarPorEmail($email) {
        return $this->model->buscarPorEmail($email);
    }

    public function agregarUsuario($email, $password, $fotoPerfil, $rol) {
        return $this->model->agregarUsuario($email, $password, $fotoPerfil, $rol);
    }

    public function actualizarUsuario($id, $email, $password, $fotoPerfil, $rol) {
        return $this->model->actualizarUsuario($id, $email, $password, $fotoPerfil, $rol);
    }

    public function eliminarUsuario($id) {
        return $this->model->eliminarUsuario($id);
    }
}
?>

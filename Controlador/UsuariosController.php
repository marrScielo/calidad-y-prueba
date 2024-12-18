<?php
//local
require_once __DIR__ . '/../Modelo/UsuarioModel.php';

//require_once("/home3/ghxumdmy/public_html/website_1cf5dd5d/Modelo/UsuarioModel.php");

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

    public function agregarUsuario($email, $password, $fotoPerfil, $rol, $introduccion, $speciality_id, $nombrePsicologo, $video, $celular) {
        return $this->model->agregarUsuario($email, $password, $fotoPerfil, $rol, $introduccion, $speciality_id, $nombrePsicologo, $video, $celular);
    }
    
    public function actualizarUsuario($id, $email, $password, $fotoPerfil, $rol, $introduccion, $especialidad, $nombrePsicologo, $video, $celular) {
        // Manejar la actualización de la imagen de perfil
        if (!empty($_FILES['fotoPerfil']['name'])) {
            $fileManager = new FileManager();
            $fotoPerfil = $fileManager->uploadImage($_FILES['fotoPerfil']);
        } else {
            $fotoPerfil = $_POST['fotoPerfilActual'];
        }
    
        return $this->model->actualizarUsuario($id, $email, $password, $fotoPerfil, $rol, $introduccion, $especialidad, $nombrePsicologo, $video, $celular);
    }
    
    public function eliminarUsuario($id) {
        return $this->model->eliminarUsuario($id);
    }

    // Método para buscar un usuario por su ID
    public function buscarPorId($id) {
        return $this->model->buscarPorId($id);
    }

    public function buscarUsuarios($query) {
        return $this->model->buscarUsuarios($query);
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'search' && isset($_GET['query'])) {
    $controller = new UsuariosController();
    $resultados = $controller->buscarUsuarios($_GET['query']);
    echo json_encode($resultados);
}

?>

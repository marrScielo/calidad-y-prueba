<?php 
include_once 'Controlador/DatabaseController.php';
$dbController = new DatabaseController();
$conn = $dbController->getConnection();

class PsicologoModel {}
class PsicologoController{
    private $model;

    public function __construct() {
        $this->model = new PsicologoModel();
    }
    public function getPsicologoByIdUser($id) {
        global $conn;
        $sql = "SELECT * FROM psicologo WHERE usuario_id = $id";
        $result = $conn->query($sql);
        return $result->fetch(PDO::FETCH_ASSOC);
    }
}
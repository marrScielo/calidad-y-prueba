<?php
include_once 'Controlador/DatabaseController.php';
$dbController = new DatabaseController();
$conn = $dbController->getConnection();


class EspecialidadController
{
    public function getEspecialidades()
    {
        global $conn;
        try {
            $sql = "SELECT * FROM especialidad";
            $result = $conn->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al obtener las especialidades: " . $e->getMessage());
        }
    }
    public function getEspecialidadById($id)
    {
        global $conn;
        if (!isset($id)) {
            throw new Exception("El id de la especialidad es requerido");
        }
        try {
            $sql = "SELECT * FROM especialidad WHERE id = $id";
            $result = $conn->query($sql);
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al obtener la especialidad: " . $e->getMessage());
        }
    }
}
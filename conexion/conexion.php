<?php
require_once __DIR__.'/../config/credenciales-db.php';

class conexion
{
    private $servername = CONFIG_DB['servername'];
    private $username = CONFIG_DB['username'];
    private $password = CONFIG_DB['password'];
    private $database = CONFIG_DB['database'];
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:host=" . $this->servername . ";dbname=" . $this->database, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    // Método para obtener la conexión PDO
    public function getPDO()
    {
        return $this->pdo;
    }

    // Método de ejemplo para obtener la clasificación de una enfermedad
    public function obtenerClasificacionEnfermedad($idEnfermedad)
    {
        try {
            $sql = "SELECT clasificacion FROM enfermedad WHERE IdEnfermedad = :idEnfermedad";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':idEnfermedad', $idEnfermedad, PDO::PARAM_INT);
            $stmt->execute();

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado['clasificacion'] ?? null;
        } catch (PDOException $e) {
            // Puedes manejar el error aquí o retornar null
            return null;
        }
    }
}

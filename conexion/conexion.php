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

    public function conexion()
    {
        try {
            $PDO = new PDO("mysql:host=" . $this->servername . ";dbname=" . $this->database, $this->username, $this->password);
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $PDO;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

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
            return null; // Manejar errores según tu lógica de aplicación
        }
    }

    public function getPDO()
    {
        return $this->pdo;
    }

}

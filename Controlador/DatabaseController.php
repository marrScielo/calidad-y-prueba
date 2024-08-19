<?php
require_once __DIR__.'/../config/credenciales-db.php';
class DatabaseController {
    
    private $servername = CONFIG_DB['servername'];
    private $username = CONFIG_DB['username'];
    private $password = CONFIG_DB['password'];
    private $database = CONFIG_DB['database'];
    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host={$this->servername};dbname={$this->database}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch(PDOException $e) {
            throw new Exception("Error de conexión: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}

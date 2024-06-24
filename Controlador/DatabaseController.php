<?php

class DatabaseController {
    // hosting
    // private $servername = "localhost";
    // private $username = "ghxumdmy_psicologoapk";
    // private $password = "Psicologo123";
    // private $database = "ghxumdmy_psicologia";
    // private $conn;

    //local
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "contigovoy3";
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

?>
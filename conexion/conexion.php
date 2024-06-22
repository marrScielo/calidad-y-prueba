<?php
class conexion{
    // private $servername = "localhost";
    // private $username = "root";
    // private $password = "";
    // private $database = "contigovoy3";
    // private $conn;

    private $servername = "localhost";
    private $username = "ghxumdmy_psicologoapk";
    private $password = "Psicologo123";
    private $database = "ghxumdmy_psicologia";
    private $conn;

    public function conexion(){
        try{
            $this->conn = new PDO("mysql:host={$this->servername};dbname={$this->database}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           

        }catch(PDOException $e){
            return $e->getMessage();
        }
    }
}
?>
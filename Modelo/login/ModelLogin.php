<?php
class Login
{
    private $PDO;
    public function __construct()
    {
        //include 'config/config.php';
        include_once $_SERVER['DOCUMENT_ROOT'].'/ContigoVoy/config/config.php';
        
        require_once CONEXION_PATH;
        // require("C:/xampp/htdocs/ContigoVoy/conexion/conexion.php");
        $con = new conexion();
        $this->PDO = $con->conexion();
    }
    public function validarDatos($NombrePsicologo, $contra)
    {
        if ($_POST) {
            session_start();
            $NombrePsicologo = $_POST['usu'];
            $contra = $_POST['pass'];
            $this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $statement = $this->PDO->prepare("SELECT * FROM psicologo WHERE NombrePsicologo = :u AND Passwords = :p");
            $statement->bindParam(":u", $NombrePsicologo);
            $statement->bindParam(":p", $contra);
            $statement->execute();
            $NombrePsicologo = $statement->fetch(PDO::FETCH_ASSOC);
            if ($NombrePsicologo) {
                $_SESSION['NombrePsicologo'] = $NombrePsicologo["NombrePsicologo"];
                $_SESSION['IdPsicologo'] = $NombrePsicologo["IdPsicologo"];
                $_SESSION['Usuario'] = $NombrePsicologo["Usuario"];
                header("location: ../../Vista/Dashboards.php");
            } else {
                header("location: ../../index.php?error=1");
            }
        }
    }
}

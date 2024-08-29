<?php

/*
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
*/

class Login
{
    private $PDO;

    public function __construct()
    {
        include_once '../../Controlador/DatabaseController.php';
        //require_once CONEXION_PATH;
        $con = new DatabaseController();
        $this->PDO = $con->getConnection();

    }

    public function validarDatos($email, $password)
    {
    if ($_POST) {
        session_start();
        $email = trim($_POST['usu']);
        $password = trim($_POST['pass']);

        // verify if the email exists in the database
        $statement = $this->PDO->prepare("SELECT * FROM usuarios WHERE email = :email");
        $statement->bindParam(":email", $email);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        // compare the password with the hash stored in the database
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['email'] = $user["email"];
            $_SESSION['id'] = $user["id"];
            $_SESSION['rol'] = $user["rol"];

            // check the specific role 'psicologo'
            if ($user['rol'] == 'psicologo') {
                // search the IdPsicologo in the 'psicologo' table
                $psicologoStatement = $this->PDO->prepare("SELECT IdPsicologo, NombrePsicologo FROM psicologo WHERE usuario_id = :usuario_id");
                $psicologoStatement->bindParam(":usuario_id", $user["id"]);
                $psicologoStatement->execute();
                $psicologo = $psicologoStatement->fetch(PDO::FETCH_ASSOC);

                if ($psicologo) {
                    $_SESSION['IdPsicologo'] = $psicologo["IdPsicologo"];
                    $_SESSION['NombrePsicologo'] = $psicologo["NombrePsicologo"];
                    $_SESSION['Usuario'] = $psicologo["Usuario"];
                    header("Location: ../../Vista/Dashboards.php");
                    exit();
                } else {
                    // Redirect to an error page if the corresponding psychologist is not found
                    header("Location: ../../login.php?error=no_psicologo");
                    exit();
                }
            } elseif ($user['rol'] == 'administrador') {
                $_SESSION['logeado'] = true;
                //header("Location: /ContigoVoy/usuarios.php");
                header("Location: ../../usuarios.php"); 
                exit();
            } else {
                // Redirect to a generic or error page if the role is not recognized
                header("Location: ../../login.php?error=rol_no_reconocido");
                exit();
            }
        } else {
            header("Location: ../../login.php?error=1");
            exit();
        }
    }
    }
}
?>
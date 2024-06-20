
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
        include_once $_SERVER['DOCUMENT_ROOT'].'/ContigoVoy/config/config.php';
        require_once CONEXION_PATH;
        $con = new DatabaseController();
        $this->PDO = $con->getConnection();

    }

    public function validarDatos($email, $password)
    {
    if ($_POST) {
        session_start();
        $email = $_POST['usu'];
        $password = $_POST['pass'];

        $this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = $this->PDO->prepare("SELECT * FROM usuarios WHERE email = :email AND password = :password");
        $statement->bindParam(":email", $email);
        $statement->bindParam(":password", $password);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $_SESSION['email'] = $user["email"];
            $_SESSION['id'] = $user["id"];
            $_SESSION['rol'] = $user["rol"];

            // Verificar el rol específico 'psicologo'
            if ($user['rol'] == 'psicologo') {
                // Buscar el IdPsicologo en la tabla 'psicologo'
                $psicologoStatement = $this->PDO->prepare("SELECT IdPsicologo, NombrePsicologo FROM psicologo WHERE usuario_id = :usuario_id");
                $psicologoStatement->bindParam(":usuario_id", $user["id"]);
                $psicologoStatement->execute();
                $psicologo = $psicologoStatement->fetch(PDO::FETCH_ASSOC);

                if ($psicologo) {
                    $_SESSION['IdPsicologo'] = $psicologo["IdPsicologo"];
                    $_SESSION['NombrePsicologo'] = $psicologo["NombrePsicologo"];
                    $_SESSION['Usuario'] = $psicologo["Usuario"];
                    header("Location: /ContigoVoy/Vista/Dashboards.php");
                    exit();
                } else {
                    // Redirigir a una página de error si no se encuentra el psicólogo correspondiente
                    header("Location: /ContigoVoy/index.php?error=no_psicologo");
                    exit();
                }
            } elseif ($user['rol'] == 'administrador') {
                $_SESSION['logeado'] = true;
                header("Location: /ContigoVoy/usuarios.php");
                exit();
            } else {
                // Redirigir a una página genérica o de error si el rol no es reconocido
                header("Location: /ContigoVoy/index.php?error=rol_no_reconocido");
                exit();
            }
        } else {
            header("Location: /ContigoVoy/index.php?error=1");
            exit();
        }
    }
    }
}
?>

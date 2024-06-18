<?php 
    if (isset($_POST["usu"]) && isset($_POST["pass"])) {
        require("C:/xampp/htdocs/ContigoVoy/Modelo/login/ModelLogin.php");
        $validar = new Login();
        $validar->validarDatos($_POST["usu"], $_POST["pass"]);
    } else {
        header("location:../index.php");
    }
?>
<?php

if($_POST){
   
$email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
$name=filter_var($_POST['nombre'],FILTER_SANITIZE_STRING);
$lastname=filter_var($_POST['apellidos'],FILTER_SANITIZE_STRING);
$message=filter_var($_POST['comentario'],FILTER_SANITIZE_STRING);

if(!empty($email) && !empty($name) && !empty($message) && !empty($lastname)){
    $destino="luisdemaryori@gmail.com";
    $assunto="Contact Form";
    $cuerpo='
    <html>
        <head>
            <title>Contact Form</title>
        </head>
        <body>
            <h1>Contact Form</h1>
            <p>Name: '.$name. ' '.$lastname.'</p>
            <p>Email: '.$email.'</p>
            <p>Message: '.$message.'</p>
        </body>
    
    </html>
    
    ';

    $headers="MIME-Version: 1.0\r\n";
    $headers.="Content-type: text/html; charset=utf-8\r\n";
    $headers.="From: $name $lastname <$email>\r\n";
    $headers.="Return-Path:  $destino\r\n";
    mail($destino,$assunto,$cuerpo,$headers);
    echo "Email sent successfully";

}else{
    echo "Error al enviar el email";
}
}

header("Location:./index.php");
exit();

?>
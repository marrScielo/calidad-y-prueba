<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link	href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="img/logo-actual.png">
	<link rel="stylesheet" href="css/inicio-header1.css">
	<link rel="stylesheet" href="css/boton-wsp.css">
	<link rel="stylesheet" href="css/estilos-login1.css">
    <title>Psicologa</title>
	<style>
		.container1{
    width: 90%;
    margin: auto;
	}
	#center-container{
		width: 100%;
		display: flex;
		justify-content: center;
	}
	</style>
</head>
<body>
<header>
    <nav class="container1">
        <div class="logo">
            <img src="img/logo-actual.png" alt="Contigo Voy" class="logo-img">
        </div>
        <div class="menu-icon" id="menu-icon">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <ul class="nav-links" id="nav-links">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="blog.php">Blog</a></li>
            <li><a href="psicologos.php">Psicólogos</a></li>
            <li class="dropdown">
                <a href="../ContigoVoy/login.php">Iniciar Sesión</a>
            </li>
            <li><a href="#">Reservar Cita</a></li>
        </ul>
    </nav>
</header>

<div id="center-container">
  <div class="container">
		<span class="form__title">Acceder</span>
		<form method="post" action="./Controlador/login/ControllerLogin.php" class="form">
			<div class="form__group">
				<i class="ri-user-line form__icon"></i>
				<input for="usu" 
          type="text" 
          placeholder="Usuario" 
          name="usu" id="usu" 
          required 
          class="form__input" />
				<span class="form__bar"></span>
			</div>
			<div class="form__group">
				<i class="ri-lock-line form__icon"></i>
				<input
					autocomplete="cc-number"
					type="password"
					placeholder="Contraseña"
					required
          			name="pass" id="pass"
					class="form__input"
				/>
				<span class="form__bar"></span>
			</div>
			<br>
			<?php
			if(isset($_GET['error']) && $_GET['error'] == 1){
			    echo "<p class='form__switch2' >Usuario o password son invalidos</p>";
			}
			?>
			<button type="submit" class="form__button">Ingresar</button>
<!--			
			<p class="form__switch">
				Olvidaste la Contraseña<a href="#">Aqui</a>
			</p>
			-->
		</form>
	</div>
</div>

	<!-- Botón flotante de WhatsApp -->
    <a href="https://wa.me/51915205726" class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>
	<script src="js/navabar.js"></script>
</body>
</html>

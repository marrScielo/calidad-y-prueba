<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" rel="stylesheet">
	<link rel="icon" href="img/favicon.png">
	<link rel="stylesheet" href="css/header-style.css">
	<link rel="stylesheet" href="css/boton-wsp.css">
	<link rel="stylesheet" href="css/estilos-login1.css">
	<link rel="stylesheet" href="css/styles.css">
	<title>Psicologa</title>
	<style>
		#center-container {
			height: 100vh;
			display: flex;
			justify-content: center;
			align-items: center;
		}

		.form__error-message {
			display: flex;
			align-items: center;
			color: #dc2626;
			background-color: #fee2e2;
			border: 1px solid #dc2626;
			border-radius: 4px;
			padding: 10px;
			margin-bottom: 15px;
			font-size: 14px;
		}

		.form__error-icon {
			width: 20px;
			height: 20px;
			margin-right: 10px;
		}
	</style>
</head>

<body>


	<div id="center-container">
		<div class="container">
			<span class="form__title">Acceder</span>
			<form method="post" action="./Controlador/login/ControllerLogin.php" class="form">
				<div class="form__group">
					<i class="ri-user-line form__icon"></i>
					<input for="usu" type="text" placeholder="Usuario" name="usu" id="usu" required class="form__input" />
					<span class="form__bar"></span>
				</div>
				<div class="form__group">
					<i class="ri-lock-line form__icon"></i>
					<input autocomplete="cc-number" type="password" placeholder="Contraseña" required name="pass" id="pass" class="form__input" />
					<span class="form__bar"></span>
				</div>
				<br>
				<?php
				if (isset($_GET['error']) && $_GET['error'] == 1) {
					echo "<p class='form__error-message'>
            <svg class='form__error-icon' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='currentColor'>
                <path fill-rule='evenodd' d='M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z' clip-rule='evenodd' />
            </svg>
            <span>El usuario o la contraseña son inválidos. Por favor, inténtalo de nuevo.</span>
          </p>";
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
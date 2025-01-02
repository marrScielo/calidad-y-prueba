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
			display: none;
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

		.form__group {
			position: relative;
		}

		.password-toggle {
			position: absolute;
			right: 10px;
			top: 70%;
			transform: translateY(-50%);
			background: none;
			border: none;
			cursor: pointer;
		}
	</style>
</head>

<body>
<a href="index.php" class="button-return">
<button class="button">
  <div class="button-box">
    <span class="button-elem">
      <svg viewBox="0 0 46 40" xmlns="http://www.w3.org/2000/svg" >
        <path
          d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z"
        ></path>
      </svg>
    </span>
    <span class="button-elem">
      <svg viewBox="0 0 46 40">
        <path
          d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z"
        ></path>
      </svg>
    </span>
  </div>
</button>
</a>
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
					<input autocomplete="current-password" type="password" placeholder="Contraseña" required name="pass" id="pass" class="form__input" />
					<span class="form__bar"></span>
					<button type="button" id="togglePassword" class="password-toggle" aria-label="Mostrar contraseña">
						<i class="ri-eye-line"></i>
					</button>
				</div>
				<br>
				

			<p class='form__error-message'>
				<svg class='form__error-icon' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='currentColor'>
					<path fill-rule='evenodd' d='M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z' clip-rule='evenodd' />
				</svg>
				<span>El usuario o la contraseña son inválidos. Por favor, inténtalo de nuevo.</span>
			</p>
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
	<?php include_once 'Componentes/chatbot.php'; ?>
	<a href="https://wa.me/51987654321" class="whatsapp-float" target="_blank">
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" height="1.2em"
    fill="currentColor"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
    </a>
	<script src="js/navabar.js"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const togglePassword = document.querySelector('#togglePassword');
			const password = document.querySelector('#pass');

			togglePassword.addEventListener('click', function() {
				const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
				password.setAttribute('type', type);
				this.querySelector('i').classList.toggle('ri-eye-line');
				this.querySelector('i').classList.toggle('ri-eye-off-line');
			});
		});
	</script>
	<script>
  document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.form');

    form.addEventListener('submit', function(event) {
      event.preventDefault(); 

      const usernameInput = form.querySelector('input[name="usu"]');
      const passwordInput = form.querySelector('input[name="pass"]');

      const formData = new FormData();
      formData.append('usu', usernameInput.value);
      formData.append('pass', passwordInput.value);

		fetch('./Controlador/login/ControllerLogin.php', {
		method: 'POST',
		body: formData
		})
		.then(response => response.url)
		.then(url => {
		if (url.includes('error=1')) {
			const errorMessage = document.querySelector('.form__error-message');
			errorMessage.style.display = 'flex';
			setTimeout(() => {
				errorMessage.style.display = 'none';
     		 }, 2000);
		} else {
			window.location.href = url;
		}
		})
		.catch(error => {
		console.error(error);
		});

    });
  });
</script>
	
</body>

</html>
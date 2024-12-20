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
	<a href="https://wa.me/51915205726" class="whatsapp-float" target="_blank">
		<i class="fab fa-whatsapp"></i>
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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <style>
    .footer_container{
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 1rem;
    }

    .content_2{
      font-weight: bold;
      font-style: italic;

    }

    #link_footer{
      color: black;
      text-decoration: none;
      font-weight: bold;
      transition: 0.3s ease-in-out all;
      padding: 0.4rem;
    }

    #link_footer:hover{
      background: #56B9B3;
      color: white;
    }

    #social_media_links{
      text-decoration: none;
      font-weight: bold;
      transition: 0.3s ease-in-out all;
      padding: 0.4rem;
    }

    #social_media_links:hover{
      background: #56B9B3;
      color: white;
    }

  </style>


</head>
<body>
  
<footer class="footer-celeste">
    <div class="footer-content">
        <div>
            <h3>¿Eres un profesional de la salud?</h3>
            <h1>¡Te estamos buscando!</h1>
            <h3>Únete a nuestro equipo y ayúdanos a mejorar la salud de nuestra comunidad.</h3>
            <a href="https://api.whatsapp.com/send?phone=51915205726" class="btn-rosado" target="_blank">Contáctanos</a>
        </div>
    </div>
</footer>


<footer class="footer-rosado">
  <div class="footer_container">
    <div>
      <img src="img/logo-actual.webp" alt="Logo" class="logo bn">
    </div>
    <div>
      <p class="content_2">Somos un centro de Psicología online. Si buscar psicólogo online, ponte en contacto con nostros y estaremos encantados de atenderte. 😀</p>
    </div>
    <div class="redes-sociales-footer">
      <a id="social_media_links" target="_blank" href="https://www.facebook.com/profile.php?id=61559259927318"><i class="fab fa-facebook"></i></a>
      <a id="social_media_links" target="_blank" href="https://twitter.com/ContigoVoy_pe"><i class="fab fa-twitter"></i></a>
      <a id="social_media_links" target="_blank" href="https://www.instagram.com/contigovoy.pe/"><i class="fab fa-instagram"></i></a>
      <a id="social_media_links" target="_blank" href="https://www.youtube.com/channel/UCTiafg0LZPem0OhqKiCVE2Q"><i class="fab fa-youtube"></i></a>
      <a id="social_media_links" target="_blank" href="https://web.whatsapp.com/send?phone=${whatsappNumber}&text=${encodeURIComponent(message)}"><i class="fab fa-whatsapp"></i></a>
      <a id="social_media_links" target="_blank" href="https://www.tiktok.com/@contigovoy.pe"><i class="fab fa-tiktok"></i></a>
    </div>
    <div>
      <a id="link_footer" href="#">Políticas de Privacidad</a>
    </div>
    <div>
      <a id="link_footer" href="#">Aviso Legal</a>
    </div>
    <div>
      <a id="link_footer" href="#">Políticas de cookies</a>
    </div>
    <div>
      <a id="link_footer" href="#">Contacto</a>
    </div>
  </div>
</footer>





</body>
</html>
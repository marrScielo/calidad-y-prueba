<style>
  .footer {
    width: 100%;
    height: auto;
    background: rgb(155, 150, 186);
    margin-bottom: 0%;
    background: linear-gradient(90deg, rgba(155, 150, 186, 1) 0%, rgba(108, 89, 182, 1) 100%);
    color: #fff;
    border-top: 1px solid #fff;
  }

  .principal {
    width: auto;
    margin-bottom: 0%;
    height: auto;

  }



  .principal div:first-child {
    grid-area: redes;
  }

  .principal div:nth-child(2) {
    grid-area: atencion;
  }

  .principal div:nth-child(3) {
    grid-area: contacto1;
  }

  .principal div:nth-child(4) {
    grid-area: contacto2;
  }

  .principal div:nth-child(5) {
    grid-area: contacto3;
  }

  .principal div:nth-child(6) {
    grid-area: contacto4;
  }

  .principal div:nth-child(7) {
    grid-area: somos1;
    margin-top: 1rem;
  }

  .principal div:nth-child(8) {
    grid-area: somos2;
  }

  .principal div:nth-child(9) {
    grid-area: somos3;
  }

  .principal div:nth-child(10) {
    grid-area: somos4;
  }

  .principal div:nth-child(11) {
    grid-area: links1;
  }

  .principal div:nth-child(12) {
    grid-area: links2;
    margin-top: -.5rem;
  }

  .principal div:nth-child(13) {
    grid-area: links3;
    margin-top: -.5rem;
  }

  .principal div:nth-child(14) {
    grid-area: copyright;
  }

  .redes {
    display: flex;
    flex-direction: row;
    /* justify-content: end; */
    justify-content: center;
    align-items: center;
    border-bottom: 3px solid #fff;
    padding-block: 10px;
  }

  .redes ul {
    display: flex;
    flex-direction: row;
    justify-content: end;
    align-items: center;
    list-style: none;
    margin-right: 5px;
    gap: 20px;
    margin: 10px 0;
    @media (min-width: 768px) {
        gap: 20px;
    }
  }

  .redes ul li {
    width: 35px;
    height: 35px;
    background-color: white;
    border-radius: 100%;
  }

  .redes ul li img {
    width: 100%;
    height: 100%;
  }


  .titulo {
    text-align: center;
    margin: .5rem auto;
    font-size: 18px;
    font-weight: bold;
  }

  .contacto {
    align-items: center;
    margin: auto;
    margin-block-end: .5rem;
    list-style: none;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 10px;
    text-align: center;
  }

  .contacto .textosup {
    font-size: 15px;
    font-weight: bold;
  }

  .contacto li {
    width: 30px;
    height: 30px;
    border-radius: 100%;
  }

  .contacto li img {
    width: 100%;
    height: 100%;
  }

  .nosotros {
    height: auto;
    display: flex;
    flex-direction: column;
    gap: 10px;
    font-family: 'Montserrat';
    width: 70%;
    margin: 0 auto 1rem;
  }

  .nosotros .textosup {
    font-size: 20px;
    font-weight: bold;
    border-bottom: 2px solid #fff;
    text-align: center;
    padding-block-end: .3rem;
  }

  .nosotros .textoinf {
    font-size: 14px;
    display: flex;
    flex-direction: column;
    gap: 5px;
    text-align: center;
    p {
      line-height: 1.5;
    }
  }

  .logoo img {
    width: 100%;
    height: 75%;
    position: absolute;
    top: 0;
    border-radius: 20px 0;
    margin-top: 15PX;
  }

  .logoo {
    margin-right: 15px;
    position: relative;
  }

  .links {
    display: flex;
    flex-direction: column;
    gap: 10px;
    width: 70%;
    margin: 0 auto 1rem;
    /* margin-right: 15px; */
    /* margin-bottom: 10px; */
  }

  .copy {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    border-top: 3px solid #fff;
  }

  .links .textosup {
    font-size: 18px;
    font-weight: bold;
    border-bottom: 2px solid #fff;
    text-align: center;
    padding-block-end: .3rem;
  }

  .links .borde {
    /* border-bottom: 1px solid #fff; */
    text-align: center;
    font-size: 14px;
  }

  .links .textoinf {
    font-size: 14px;
    text-align: center;
    p {
      line-height: 1.5;
    }
  }

  @media only screen and (min-width: 320px) and (max-width: 480px) {
    .footer {
      height: 1450px;
      grid-template-columns: 20px 1fr 5px;
    }

    .footer .principal:first-child {
      grid-column: 2/3;
      grid-row: 1/2;
    }

    .principal {
      width: 100%;
      height: 100%;
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      grid-template-rows: 1fr 1fr 2fr 2fr 2fr 2fr 3fr 3fr 3fr 3fr 3fr 3fr 200px 1fr;
      row-gap: 10px;
      grid-template-areas:
        'redes redes'
        'atencion atencion'
        'contacto1 contacto1 '
        'contacto2 contacto2'
        'contacto3 contacto3 '
        'contacto4 contacto4'
        'somos1 somos1'
        'somos2 somos2'
        'somos3 somos3'
        'somos4 somos4'
        'links3 links3'
        'links2 links2'
        'links1 links1'
        'copyright copyright '
    }

    .redes ul {
      margin: 10px 0;
    }

    .nosotros .textosup{
      font-size: 18px;
    }
  }

  @media only screen and (min-width: 481px) and (max-width: 768px) {
    .footer {
      height: 1000px;
      grid-template-columns: 100px 1fr 100px;
    }

    .footer .principal:first-child {
      grid-column: 2/3;
      grid-row: 1/2;
    }

    .principal {
      width: 100%;
      height: 100%;
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      grid-template-rows: 1fr 1fr 2fr 2fr 3fr 3fr 3fr 200px 1fr;
      row-gap: 10px;
      grid-template-areas:
        'redes redes redes redes'
        'atencion atencion atencion atencion'
        'contacto1 contacto1 contacto2 contacto2'
        'contacto3 contacto3 contacto4 contacto4'
        'somos1 somos1 somos2 somos2'
        'somos3 somos3 somos4 somos4'
        'links3 links3 links2 links2'
        '. links1 links1 .'
        'copyright copyright copyright copyright '
    }

    .redes ul {
      margin: 10px 0;
    }
  }

  @media only screen and (min-width: 769px) and (max-width: 1024px) {
    .footer {
      height: 950px;
      grid-template-columns: 100px 1fr 100px;
    }

    .footer .principal:first-child {
      grid-column: 2/3;
      grid-row: 1/2;
    }

    .principal {
      width: 100%;
      height: 100%;
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      grid-template-rows: 1fr 1fr 2fr 2fr 3fr 3fr 3fr 200px 1fr;
      row-gap: 10px;
      grid-template-areas:
        'redes redes redes redes'
        'atencion atencion atencion atencion'
        'contacto1 contacto1 contacto2 contacto2'
        'contacto3 contacto3 contacto4 contacto4'
        'somos1 somos1 somos2 somos2'
        'somos3 somos3 somos4 somos4'
        'links3 links3 links2 links2'
        '. links1 links1 .'
        'copyright copyright copyright copyright '
    }

    .redes ul {
      margin: 10px 0;
    }
  }

  @media only screen and (min-width: 1025px) and (max-width: 1280px) {
    .footer {
      height: 1050px;
      grid-template-columns: 100px 1fr 100px;
    }

    .footer .principal:first-child {
      grid-column: 2/3;
      grid-row: 1/2;
    }

    .principal {
      width: 100%;
      height: 100%;
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      grid-template-rows: 1fr 1fr 2fr 2fr 3fr 3fr 3fr 300px 1fr;
      row-gap: 10px;
      grid-template-areas:
        'redes redes redes redes'
        'atencion atencion atencion atencion'
        'contacto1 contacto1 contacto2 contacto2'
        'contacto3 contacto3 contacto4 contacto4'
        'somos1 somos1 somos2 somos2'
        'somos3 somos3 somos4 somos4'
        'links3 links3 links2 links2'
        '. links1 links1 .'
        'copyright copyright copyright copyright '
    }
  }
  @media only screen and (min-width: 1281px) {
    .footer {
      max-height: 650px;
      grid-template-columns: 1fr 1fr 1fr;
    }
    .principal{
      min-width: 1000px;
      max-height: 1000px;
    }
  }
</style>

<footer class="footer">
  <div class="principal">
    <div class="redes">
      <ul>
        <li><a href="https://www.facebook.com/profile.php?id=61559259927318&_rdr" target="_blank"><img src="img/icons/facebook.png" alt="Facebook"></a></li>
        <li><a href="https://x.com/ContigoVoy_pe" target="_blank"><img src="img/icons/twitter.png" alt="Twitter"></a></li>
        <li><a href="https://www.instagram.com/contigovoy.pe/" target="_blank"><img src="img/icons/instagram.png" alt="Instagram"></a></li>
        <li><a href="https://www.youtube.com/@contigovoype" target="_blank"><img src="img/icons/youtube.png" alt="YouTube"></a></li>
        <li><a href="" target="_blank"><img src="img/icons/whatsapp.png" alt="Whatsapp"></a></li>
        <li><a href="https://www.tiktok.com/@contigovoy.pe" target="_blank"><img src="img/icons/tiktok.png" alt="TikTok"></a></li>
      </ul>
    </div>
    <div class="titulo">Atencion al usuario</div>
    <div class="contacto">
      <div class="icono">
        <li><img src="img/CELULAR-8.png" alt="Celular"></li>
      </div>
      <div class="textosup">Linea de soporte</div>
      <div class="textoinf">(+51) 666 666 666 Ext. 1111</div>
      <div></div>
    </div>
    <div class="contacto">
      <div class="icono">
        <li><img src="img/CELULAR-8.png" alt="Celular"></li>
      </div>
      <div class="textosup">Linea administrativa</div>
      <div class="textoinf">(57+1) 5185353 Ext. 1000</div>
      <div></div>
    </div>
    <div class="contacto">
      <div class="icono">
        <li><img style="height: 75%" src="img/MENSAJE-8.png" alt="Mensaje"></li>
      </div>
      <div class="textosup">Correo Electronico</div>
      <div class="textoinf">CONTIGO.VOY@gmail.com</div>
      <div></div>
    </div>
    <div class="contacto">
      <div class="icono">
        <li><img style="height: 85%;width: 60%;" src="img/UBICACION-8.png" alt="Ubicacion"></li>
      </div>
      <div class="textosup">Calle 73 # 7 - 31, Torre B Piso 2,
        Bogotá D.C., Colombia
        C.P. 110221180
      </div>
    </div>
    <div class="nosotros">
      <div class="textosup">Quiénes somos</div>
      <div class="textoinf">
        <p>¿Qué es Contigo Voy?</p>
        <p>
          Es una marca que ofrece apoyo emocional y psicológico, proporcionando un entorno seguro y confiable para el bienestar de los clientes
        </p>
      </div>
    </div>
    <div class="nosotros">
      <div class="textosup">¡Conéctate ya!</div>
      <div class="textoinf" style="gap: 0">
        <p>¡Afiliate a Contigo Voy!</p>
        <p>¡Conoce a nuestro equipo!</p>
        <p>¡Conoce a nuestros psicólogos!</p>
        <!-- <p>Psicologos afiliados</p> -->
        <p>Empresa líder en Perú</p>
      </div>
    </div>
    <div class="nosotros">
      <div class="textosup">Servicios</div>
      <div class="textoinf" style="gap: 0">
        <p>Herramientas de colaboración</p>
        <p>Herramientas de colaboración</p>
        <p>Gestión de proyectos</p>
        <p>Conectividad avanzada</p>
      </div>
    </div>
    <div class="nosotros">
      <div class="textosup">Noticias y eventos</div>
      <div class="textoinf" style="gap: 0">
        <p>Noticias</p>
        <p>Eventos</p>
      </div>
    </div>
    <div class="logoo">
      <img src="img/Recurso 13-8.png" alt="Logo">
    </div>
    <div class="links">
      <div class="textosup">Intranet</div>
      <div class="borde">Blog Contigo Voy</div>
      <div class="links">
        <div class="textosup">Contacto</div>
        <div class="textoinf">
          <p>Contáctanos</p>
          <p>Ubicación</p>
          <p>Soporte</p>
        </div>
      </div>
    </div>
    <div class="links">
      <div class="textosup">Colaboración</div>
      <div class="textoinf">
        <p>Convocatorias</p>
        <p>Proyectos</p>
        <p>Pulicaciones</p>
        <p>Red de oportunidades</p>
        <p>Comunidad de salud digital</p>
      </div>
    </div>
    <div class="copy">© Copyright All rights reserved 2024</div>
  </div>
</footer>
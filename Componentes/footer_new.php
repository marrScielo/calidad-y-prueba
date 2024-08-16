<style>
  .footer {
    width: 100%;
    height: auto;
    background: rgb(155, 150, 186);
    margin-bottom: 0%;
    background: linear-gradient(90deg, rgba(155, 150, 186, 1) 0%, rgba(108, 89, 182, 1) 100%);
    display: grid;
    grid-template-columns: 350px 1fr 350px;
    color: #fff;
    border-top: 1px solid #fff;
  }

  .footer .principal:first-child {
    grid-column: 2/3;
    grid-row: 1/2;
  }

  .principal {
    width: auto;
    margin-bottom: 0%;
    max-height: 650px !important;
    height: auto;
    display: grid;
    /*grid-template-columns: repeat(8,1fr);
    */
    grid-template-columns: repeat(8, minmax(10%, 1fr));
    grid-template-rows: 1fr 1fr 2fr 3fr 3fr 1fr;
    gap: 10px;
  }

  .principal div {
    width: auto;
    height: auto;
  }

  .principal div:first-child {
    grid-column: 1/9;
    grid-row: 1/2;
  }

  .principal div:nth-child(2) {
    grid-column: 1/9;
    grid-row: 2/3;
  }

  .principal div:nth-child(3) {
    grid-column: 1/3;
    grid-row: 3/4;
  }

  .principal div:nth-child(4) {
    grid-column: 3/5;
    grid-row: 3/4;
  }

  .principal div:nth-child(5) {
    grid-column: 5/7;
    grid-row: 3/4;
  }

  .principal div:nth-child(6) {
    grid-column: 7/9;
    grid-row: 3/4;
  }

  .principal div:nth-child(7) {
    grid-column: 1/3;
    grid-row: 4/5;
  }

  .principal div:nth-child(8) {
    grid-column: 3/5;
    grid-row: 4/5;
  }

  .principal div:nth-child(9) {
    grid-column: 5/7;
    grid-row: 4/5;
  }

  .principal div:nth-child(10) {
    grid-column: 7/9;
    grid-row: 4/5;
  }

  .principal div:nth-child(11) {
    grid-column: 2/4;
    grid-row: 5/6;
  }

  .principal div:nth-child(12) {
    grid-column: 4/6;
    grid-row: 5/6;
  }

  .principal div:nth-child(13) {
    grid-column: 6/8;
    grid-row: 5/6;
  }

  .principal div:nth-child(14) {
    grid-column: 1/9;
    grid-row: 6/7;
  }

  .redes {
    display: flex;
    flex-direction: row;
    justify-content: end;
    align-items: center;
    border-bottom: 3px solid #fff;
  }

  .redes ul {
    display: flex;
    flex-direction: row;
    justify-content: end;
    align-items: center;
    list-style: none;
    margin-right: 5px;
    gap: 5px;
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
    margin: auto;
    font-size: 18px;
    font-weight: bold;
  }

  .contacto {
    align-items: center;
    margin: auto;
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
    margin: 0 10px;
    gap: 10px;
    font-family: 'Montserrat Medium';
  }

  .nosotros .textosup {
    font-size: 20px;
    font-weight: bold;
    border-bottom: 1px solid #fff;
  }

  .nosotros .textoinf {
    font-size: 17px;
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
    margin-right: 15px;
    margin-bottom: 10px;
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
    border-bottom: 1px solid #fff;
    margin-top: 5PX;
  }

  .links .borde {
    border-bottom: 1px solid #fff;
    margin-top: 5px;
    font-size: 12px;
  }

  .links .textoinf {
    margin-top: 5px;
    font-size: 12px;
  }
</style>

<footer class="footer">
  <div class="principal">
    <
      <div class="redes">
      <ul>
        <li><a href=""><img src="../../ContigoVoy/img/ICONOS REDES SOCIALES/Recurso 11-8.png" alt="Facebook"></a></li>
        <li><a href=""><img src="../../ContigoVoy/img/ICONOS REDES SOCIALES/Recurso 12-8.png" alt="Twitter"></a></li>
        <li><a href=""><img src="../../ContigoVoy/img/ICONOS REDES SOCIALES/Recurso 13-8.png" alt="Instagram"></a></li>
        <li><a href=""><img src="../../ContigoVoy/img/ICONOS REDES SOCIALES/Recurso 14-8.png" alt="YouTube"></a></li>
        <li><a href=""><img src="../../ContigoVoy/img/ICONOS REDES SOCIALES/Recurso 15-8.png" alt="Whatsapp"></a></li>
        <li><a href=""><img src="../../ContigoVoy/img/ICONOS REDES SOCIALES/Recurso 16-8.png" alt="TikTok"></a></li>
      </ul>
  </div>
  <div class="titulo">Atencion al usuario</div>
  <div class="contacto">
    <div class="icono">
      <li><img src="../../ContigoVoy/img/CELULAR-8.png" alt="Celular"></li>
    </div>
    <div class="textosup">Linea de soporte</div>
    <div class="textoinf">(+51) 666 666 666 Ext. 1111</div>
    <div></div>
  </div>
  <div class="contacto">
    <div class="icono">
      <li><img src="../../ContigoVoy/img/CELULAR-8.png" alt="Celular"></li>
    </div>
    <div class="textosup">Linea administrativa</div>
    <div class="textoinf">(57+1) 5185353 Ext. 1000</div>
    <div></div>
  </div>
  <div class="contacto">
    <div class="icono">
      <li><img style="height: 75%" src="../../ContigoVoy/img/MENSAJE-8.png" alt="Mensaje"></li>
    </div>
    <div class="textosup">Correo Electronico</div>
    <div class="textoinf">CONTIGO.VOY@gmail.com</div>
    <div></div>
  </div>
  <div class="contacto">
    <div class="icono">
      <li><img style="height: 85%;width: 60%;" src="../../ContigoVoy/img/UBICACION-8.png" alt="Ubicacion"></li>
    </div>
    <div class="textosup">Calle 73 # 7 – 31, Torre B Piso 2,
      Bogotá D.C., Colombia
      C.P. 110221180
    </div>
  </div>
  <div class="nosotros">
    <div class="textosup">Quiénes somos</div>
    <div class="textoinf">¿Qué es Contigo Voy?<br>
      Es una marca que ofrece apoyo<br>
      emocional y psicológico,<br>
      proporcionando un entorno<br>
      seguro y confiable para el<br>
      bienestar de los clientes</div>
  </div>
  <div class="nosotros">
    <div class="textosup">¡Conéctate ya!</div>
    <div class="textoinf">¡Afiliate a Contigo Voy!<br>
      Psicolog@s afiliados<br>
      Las empresa lider en Perú</div>
  </div>
  <div class="nosotros">
    <div class="textosup">Servicios</div>
    <div class="textoinf">Herramientas de colaboración<br>
      Gestión de proyectos<br>
      Conectividad avanzada</div>
  </div>
  <div class="nosotros">
    <div class="textosup">Noticias y eventos</div>
    <div class="textoinf">Noticias<br>
      Eventos</div>
  </div>
  <div class="logoo">
    <img src="../../ContigoVoy/img/Recurso 13-8.png" alt="Logo">
  </div>
  <div class="links">
    <div class="textosup">Intranet</div>
    <div class="borde">Blog Contigo Voy</div>
    <div class="textosup">Contacto</div>
    <div class="textoinf">Soporte <br>
      Contactanos</div>
  </div>
  <div class="links">
    <div class="textosup">Colaboracion</div>
    <div class="textoinf">Convocatorias<br>
      Proyectos<br>
      Pulicaciones<br>
      Red de oportunidades<br>
      Comunidad de salud digital</div>
  </div>
  <div class="copy">© Copyright All rights reserved 2024</div>
  </div>
</footer>
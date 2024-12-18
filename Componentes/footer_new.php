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
    width: min(90%, 1100px);
    margin: 0 auto;
    height: auto;
    padding-block-end: 1rem;
  }

  .redes {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    border-bottom: 3px solid #fff;
    padding-block: 10px;
    @media (min-width: 768px) {
      justify-content: end;
    }
  }

  .redes ul {
    display: flex;
    flex-direction: row;
    justify-content: end;
    align-items: center;
    list-style: none;
    margin-right: 5px;
    gap: 10px;
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
    margin: 1rem auto .5rem;
    font-size: 16px;
    font-weight: bold;
    @media (min-width: 768px) {
        font-size: 20px;
    }
  }

  .contacto-contenedor {
    display: grid;
    gap: .5rem;
    @media (min-width: 480px) {
        grid-template-columns: repeat(2, 1fr);
        /* grid-template-rows: repeat(2, 1fr); */
    }
    @media (min-width: 768px) {
        grid-template-columns: repeat(4, 1fr);
        margin-top: 2rem;
    }
  }

  .contacto {
    margin: auto;
    list-style: none;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 10px;
    text-align: center;
    @media (min-width: 768px) {
      justify-content: flex-start;
      height: -webkit-fill-available;
    }
  }

  .contacto .textosup {
    font-size: 14px;
    font-weight: bold;
    @media (min-width: 768px) {
        font-size: 16px;
    }
  }

  .contacto .textoinf {
    font-size: 14px;
    &.address {
      width: 80%;
      line-height: 1.5;
      @media (min-width: 768px) {
          width: 100%;
      }
    }
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

  .nosotros-contenedor {
    margin-top: 1.5rem;
    display: grid;
    gap: 1rem;
    @media (min-width: 480px) {
        grid-template-columns: repeat(2, 1fr);
        /* grid-template-rows: repeat(2, 1fr); */
    }
    @media (min-width: 768px) {
        grid-template-columns: repeat(4, 1fr);
    }
  }

  .nosotros {
    height: auto;
    display: flex;
    flex-direction: column;
    gap: 10px;
    font-family: 'Montserrat';
    width: 90%;
    margin: 0 auto;
    @media (min-width: 320px) {
        width: 70%;
    }
    @media (min-width: 768px) {
        width: 100%;
    }
  }

  .nosotros .textosup {
    font-size: 16px;
    font-weight: bold;
    border-bottom: 2px solid #fff;
    text-align: center;
    padding-block-end: .3rem;
    @media (min-width: 768px) {
        font-size: 16px;
        border-width: 1px;
        text-align: left;
    }
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
    @media (min-width: 768px) {
        text-align: left;
    }
  }

  .logoo {
    display: flex;
    justify-content: center;
  }

  .logoo img {
    width: 100%;
    height: auto;
    border-radius: 20px;
    object-fit: contain;
    /* @media (min-width: 420px) {
        width: 60%;
    }
    @media (min-width: 768px) {
        width: 100%;
    } */
  }

  .links-contenedor {
    margin-block: 1.5rem;
    display: grid;
    gap: 1rem;
    @media (min-width: 480px) {
        grid-template-columns: repeat(2, 1fr);
        /* grid-template-rows: repeat(2, 1fr); */
        .links:nth-of-type(3) {
          grid-row: 1 / 2;
          grid-column: 2 / 3;
        }
    }
    @media (min-width: 768px) {
        grid-template-columns: repeat(4, 1fr);
        .links:nth-of-type(3) {
          grid-row: unset;
          grid-column: unset;
        }
        .links:nth-of-type(2) {
          grid-column: unset
        }
    }
  }

  .links {
    display: flex;
    flex-direction: column;
    gap: 10px;
    width: 90%;
    margin: 0 auto;
    @media (min-width: 320px) {
        width: 70%;
    }
    @media (min-width: 768px) {
        width: 100%;
    }
  }

  .copy {
    display: flex;
    justify-content: center;
    align-items: center;
    border-top: 3px solid #fff;
    padding-top: .5rem;
    text-align: center;
  }

  .links .textosup {
    font-size: 16px;
    font-weight: bold;
    border-bottom: 2px solid #fff;
    text-align: center;
    padding-block-end: .3rem;
    @media (min-width: 768px) {
      border-width: 1px;
        text-align: left;
    }
  }

  .links .borde {
    /* border-bottom: 1px solid #fff; */
    text-align: center;
    font-size: 14px;
    @media (min-width: 768px) {
        text-align: left;
    }
  }

  .links .textoinf {
    font-size: 14px;
    text-align: center;
    p {
      line-height: 1.5;
    }
    @media (min-width: 768px) {
        text-align: left;
    }
  }

</style>

<footer class="footer">
  <div class="principal">
    <div >
    <?php include_once 'redesSociales.php'; ?>
    </div>
    <div class="titulo">Atención al usuario</div>
    <div class="contacto-contenedor">
      <div class="contacto">
        <div class="icono">
          <li>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
</svg>

          </li>
        </div>
        <div class="textosup">Línea de soporte</div>
        <div class="textoinf">(+51) 666 666 666 Ext. 1111</div>
      </div>
      <div class="contacto">
        <div class="icono">
        <li>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
</svg>

          </li>
        </div>
        <div class="textosup">Linea administrativa</div>
        <div class="textoinf">(57+1) 5185353 Ext. 1000</div>
      </div>
      <div class="contacto">
        <div class="icono">
          <li>
          <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-mail"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M22 7.535v9.465a3 3 0 0 1 -2.824 2.995l-.176 .005h-14a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-9.465l9.445 6.297l.116 .066a1 1 0 0 0 .878 0l.116 -.066l9.445 -6.297z" /><path d="M19 4c1.08 0 2.027 .57 2.555 1.427l-9.555 6.37l-9.555 -6.37a2.999 2.999 0 0 1 2.354 -1.42l.201 -.007h14z" /></svg>
          </li>
        </div>
        <div class="textosup">Correo Electrónico</div>
        <div class="textoinf">CONTIGO.VOY@gmail.com</div>
      </div>
      <div class="contacto">
        <div class="icono">
<li>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
  <path fill-rule="evenodd" d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd" />
</svg>

</li>
        </div>
        <div class="textosup">
          Dirección
        </div>
        <div class="textoinf address">Calle 73 # 7 - 31, Torre B Piso 2,
          Bogotá D.C., Colombia
          C.P. 110221180</div>
          
      </div>
    </div>
    <div class="nosotros-contenedor">
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
    </div>
    <div class="links-contenedor">
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
      <div class="links">
        <div class="textosup">Intranet</div>
        <div class="borde">Blog Contigo Voy</div>
      </div>
      <div class="links">
          <div class="textosup">Contacto</div>
          <div class="textoinf">
            <p>Contáctanos</p>
            <p>Ubicación</p>
            <p>Soporte</p>
          </div>
      </div>
      <div class="logoo">
        <img src="img/Recurso 13-8.png" alt="Logo">
      </div>
    </div>
    <div class="copy">© Copyright All rights reserved 2024</div>
  </div>
</footer>
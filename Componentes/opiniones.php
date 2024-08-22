<style>
  .container {
    width: 100%;
  }

  .title {
    text-align: center;
    font-size: 2rem;
    color: #56B9B3;
  }

  .container_body {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 1rem;
  }

  .content {
    font-style: italic;
    text-align: justify;
    line-height: 1rem;
    margin: 1rem;
    font-weight: light;
  }

  .author {
    text-align: center;
  }

  .especialidad {
    text-align: center;
  }

  .author {
    font-weight: bold;
  }

  .especialidad {
    color: #56B9B3;
  }

  .imagenc {
    text-align: center;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
  }

  .ccc {
    text-align: center;
  }

  @media (max-width: 768px) {
    .container_body {
      grid-template-columns: 1fr;
    }
  }
</style>


<div class="container">
  <h4 class="title">Opiniones de nuestros pacientes</h4>

  <div class="container_body">

    <div class="ccc">
      <p class="content" id="test">Llevaba una época bastante mal, y solo puedo tener palabras de agradecimiento hacia
        mi psicologo. Me ha ayudado a superar
        mis problemas de ansiedad con ejercicios muy practicos.
      </p>
      <img class="imagenc"
        src="https://www.shutterstock.com/image-photo/portrait-beautiful-young-woman-smiling-600nw-185861723.jpg"
        alt="">
      <p class="author">Sandra Palmero</p>
      <p class="especialidad">Docente</p>
    </div>

    <div class="ccc">
      <p class="content">Llevaba una época bastante mal, y solo puedo tener palabras de agradecimiento hacia mi
        psicologo. Me ha ayudado a superar
        mis problemas de ansiedad con ejercicios muy practicos.
      </p>
      <img class="imagenc"
        src="https://plus.unsplash.com/premium_photo-1689568158814-3b8e9c1a9618?fm=jpg&w=3000&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8cGVyc29uYXxlbnwwfHwwfHx8MA%3D%3D"
        alt="">
      <p class="author">John Doe</p>
      <p class="especialidad">Administrador</p>
    </div>

    <div class="ccc">
      <p class="content">Llevaba una época bastante mal, y solo puedo tener palabras de agradecimiento hacia mi
        psicologo. Me ha ayudado a superar
        mis problemas de ansiedad con ejercicios muy practicos.
      </p>
      <img class="imagenc"
        src="https://img.freepik.com/foto-gratis/sonriente-joven-morena-caucasica-mira-camara_141793-103816.jpg?size=626&ext=jpg&ga=GA1.1.2008272138.1720828800&semt=ais_user"
        alt="">
      <p class="author">July Patterson</p>
      <p class="especialidad">Gerente</p>
    </div>

  </div>

</div>
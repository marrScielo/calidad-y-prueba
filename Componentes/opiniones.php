<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>

    .container{
      width: 100%;
    }

    .title{
      text-align: center;
      font-size: 2rem;
      color: #56B9B3;
    }

    .container_body{
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
      gap: 1rem;
    }

    .content{
      font-style: italic;
      text-align: justify;
      line-height: 1rem;
      margin: 1rem;
      font-weight: light;
    }

    .author{
      text-align: center;
    }

    .especialidad{
      text-align: center;
    }

    .author{
      font-weight: bold;
    }

    .especialidad{
      color: #56B9B3;
    }

    @media (max-width: 768px) {
      .container_body{
        grid-template-columns: 1fr;
      }
    }

  </style>
</head>
<body>
  
  <div class="container">
    <h4 class="title">Opiniones de nuestros pacientes</h4>

    <div class="container_body">

      <div>
        <p class="content" id="test">Llevaba una época bastante mal, y solo puedo tener palabras de agradecimiento hacia mi psicologo. Me ha ayudado a superar
           mis problemas de ansiedad con ejercicios muy practicos.
        </p>
        <p class="author">Sandra Palmero</p>
        <p class="especialidad">Docente</p>
      </div>

      <div>
        <p class="content">Llevaba una época bastante mal, y solo puedo tener palabras de agradecimiento hacia mi psicologo. Me ha ayudado a superar
           mis problemas de ansiedad con ejercicios muy practicos.
        </p>
        <p class="author">John Doe</p>
        <p class="especialidad">Administrador</p>
      </div>

      <div>
        <p class="content">Llevaba una época bastante mal, y solo puedo tener palabras de agradecimiento hacia mi psicologo. Me ha ayudado a superar
           mis problemas de ansiedad con ejercicios muy practicos.
        </p>
        <p class="author">July Patterson</p>
        <p class="especialidad">Gerente</p>
      </div>

    </div>

  </div>


</body>
</html>
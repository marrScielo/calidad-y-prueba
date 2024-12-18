<style>
.cta-button {
  padding: 17px 40px;
  border-radius: 50px;
  cursor: pointer;
  border: 0;
  background-color: white;
  box-shadow: rgb(0 0 0 / 5%) 0 0 8px;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  font-size: 15px;
  transition: all 0.5s ease;
  color:#524388;
  font-weight: bold;
}

.cta-button:hover {
  /* letter-spacing: 3px; */
  background-color: #524388;
  color: hsl(0, 0%, 100%);
  box-shadow: rgb(93 24 220) 0px 7px 29px 0px;
}

.cta-button:active {
  letter-spacing: 3px;
  background-color: #524388;
  color: hsl(0, 0%, 100%);
  box-shadow: rgb(93 24 220) 0px 0px 0px 0px;
  transform: translateY(10px);
  transition: 100ms;
}

.wrapper_card {
  width: 100%;
  height: 400px;
  position: relative;
  text-align: center;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
}

.inner {
  --w: 120px;
  --h: 170px;
  --translateZ: calc((var(--w) + var(--h)) + 0px);
  --rotateX: -15deg;
  --perspective: 1000px;
  position: absolute;
  width: var(--w);
  height: var(--h);
  top: 25%;
  left: calc(50% - (var(--w) / 2) - 2.5px);
  z-index: 2;
  transform-style: preserve-3d;
  transform: perspective(var(--perspective));
  animation: rotating 20s linear infinite; /* */
}
@keyframes rotating {
  from {
    transform: perspective(var(--perspective)) rotateX(var(--rotateX))
      rotateY(0);
  }
  to {
    transform: perspective(var(--perspective)) rotateX(var(--rotateX))
      rotateY(1turn);
  }
}

.card_psicologo {
  position: absolute;
  border: 2px solid #483285;
  border-radius: 12px;
  overflow: hidden;
  inset: 0;
  transform: rotateY(calc((360deg / var(--quantity)) * var(--index)))
    translateZ(var(--translateZ));
}

.img {
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  object-fit: cover;
  padding: 10px;
  /* background: #0000
    radial-gradient(
      circle,
      rgba(var(--color-card), 0.2) 0%,
      rgba(var(--color-card), 0.6) 80%,
      rgba(var(--color-card), 0.9) 100%
    ); */
  background-color: #9897d1;
}


</style>

<?php
$psicilogos = [
    ['id' => 0, 'src' => 'img/confia-nosotros.webp'],
    ['id' => 1, 'src' => 'img/confia-nosotros.webp'],
    ['id' => 2, 'src' => 'img/confia-nosotros.webp'],
    ['id' => 3, 'src' => 'img/confia-nosotros.webp'],
    ['id' => 4, 'src' => 'img/confia-nosotros.webp'],
    ['id' => 5, 'src' => 'img/confia-nosotros.webp'],
    ['id' => 6, 'src' => 'img/confia-nosotros.webp'],
    ['id' => 7, 'src' => 'img/confia-nosotros.webp'],
    ['id' => 8, 'src' => 'img/confia-nosotros.webp'],
    ['id' => 9, 'src' => 'img/confia-nosotros.webp'],
];
?>
<div class="container_plus">
    <div class="content-wrapper container-section">
        <div class="column image-column" style="width: 100%;">
            <div class="wrapper_card">
              <div class="inner" style="--quantity: 10;">
                   <?php foreach ($psicilogos as $idx => $psicilogo): ?>
                    <div class="card_psicologo" style="--index: <?php echo $psicilogo['id']; ?>;">
                      <div class="img">
                        <img src="<?php echo $psicilogo['src']; ?>" alt="Psicologo Plus" style="border-radius: 10px;width: 100%;">
                      </div>
                    </div>
                   <?php endforeach; ?>
              </div>
            </div>

        </div>
        <div class="column text-column column_Info">
            <h2>¿Por qué confiar en ContigoVoy?</h2>
            <p class="text-p">Nuestros psicólogos son profesionales colegiados con un trato cercano. Ya han ayudado a
                miles de pacientes a mejorar su calidad de vida.</p>
            <ul class="benefits">
                <li class="text-p">Sesiones privadas, confidenciales y seguras</li>
                <li class="text-p">Ahorra tiempo y desplazamientos</li>
                <li class="text-p">Tú decides donde y cuándo realizar las sesiones</li>
            </ul>
            <button class="cta-button" onclick="window.location.href='psicologos.php';">Pide una cita</button>
        </div>
    </div>
</div>
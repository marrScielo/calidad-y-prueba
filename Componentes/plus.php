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

</style>
<div class="container_plus">
    <div class="content-wrapper container-section">
        <div class="column image-column">
            <img src="img/confia-nosotros.jpg" alt="Psicologo Plus">
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
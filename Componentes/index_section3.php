<style>
    .grid-container {
        width: 100%;
    display: grid;
    grid-auto-rows: auto;
    grid-template-columns: repeat(auto-fill, minmax(180px, 210PX));
    grid-gap: 1rem;
    white-space: nowrap;
    justify-content: center;
}

.grid-item {
    display: flex;
    align-items: center;
    justify-content: center;
}

.c-button {
  font-weight: 700;
  font-size: 14px;
  text-decoration: none;
  padding: 0.9em 1.6em;
  cursor: pointer;
  display: inline-block;
  vertical-align: middle;
  position: relative;
  z-index: 1;
}

.c-button--gooey {
  color: #9986d9;
  background-color: transparent;
  text-transform: uppercase;
  letter-spacing: 2px;
  border: 4px solid #9986d9;
  position: relative;
  transition: all 700ms ease;
  border-radius: 999px;
  width: 100%;
}

.c-button--gooey .c-button__blobs {
  height: 100%;
  filter: url(#goo);
  overflow: hidden;
  position: absolute;
  top: 0;
  left: 0;
  bottom: -3px;
  right: -1px;
  z-index: -1;
  border-radius: 20px;
}

.c-button--gooey .c-button__blobs div {
  background-color:  #524388;
  width: 34%;
  height: 100%;
  border-radius: 100%;
  position: absolute;
  transform: scale(1.4) translateY(125%) translateZ(0);
  transition: all 700ms ease;
}

.c-button--gooey .c-button__blobs div:nth-child(1) {
  left: -5%;
}

.c-button--gooey .c-button__blobs div:nth-child(2) {
  left: 30%;
  transition-delay: 60ms;
}

.c-button--gooey .c-button__blobs div:nth-child(3) {
  left: 66%;
  transition-delay: 25ms;
}

.c-button--gooey:hover {
  color: #fff;
}

.c-button--gooey:hover .c-button__blobs div {
  transform: scale(1.4) translateY(0) translateZ(0);
}


</style>
<?php
$options = [
    ['name' => 'Adicciones', 'id' => '1'],
    ['name' => 'Ansiedad', 'id' => '2'],
    ['name' => 'Atención', 'id' => '3'],
    ['name' => 'Crianza', 'id' => '4'],
    ['name' => 'Depresión', 'id' => '5'],
    ['name' => 'Estrés', 'id' => '6'],
    ['name' => 'Impulsividad', 'id' => '7'],
    ['name' => 'TOC', 'id' => '8'],
    ['name' => 'Ira', 'id' => '9'],
    ['name' => 'Sexualidad', 'id' => '10'],
    ['name' => 'Traumas', 'id' => '11'],
    ['name' => 'Riesgo Sexual', 'id' => '12'],
];
?>
<section class="section-help-you">
    <div class="section-help-you__content container-section">
        <div class="section-help-you__text">
            <h2>¿Cómo podemos ayudarte?</h2>
            <p>Nuestros psicólogos online cuentan con distintas especialidades. Las sesiones se adaptan a las
                necesidades de cada paciente.</p>
        </div>
        <div class="section-help-you__list" style="width: 100%;">
    <div class="section-help-you__list-content grid-container">
        <?php foreach ($options as $option): ?>
            <div class="grid-item">
                <button class="c-button c-button--gooey">
                <?= $option['name'] ?>
                <div class="c-button__blobs">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
                </button>
                <svg
                style="display: block; height: 0; width: 0;"
                version="1.1"
                xmlns="http://www.w3.org/2000/svg"
                >
                <defs>
                    <filter id="goo">
                    <feGaussianBlur
                        result="blur"
                        stdDeviation="10"
                        in="SourceGraphic"
                    ></feGaussianBlur>
                    <feColorMatrix
                        result="goo"
                        values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7"
                        mode="matrix"
                        in="blur"
                    ></feColorMatrix>
                    <feBlend in2="goo" in="SourceGraphic"></feBlend>
                    </filter>
                </defs>
                </svg>

            </div>
        <?php endforeach; ?>
    </div>
</div>

    </div>
</section>
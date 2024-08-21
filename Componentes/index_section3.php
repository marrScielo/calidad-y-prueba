<style>
    .section-bg {
        max-width: 1900px;
        margin: 0 auto;
        background-image: url("ContigoVoyAssets/fondos/comopodemosrecursonuevo.jpg");
        background-size: cover;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    /* Estilos de contenido */
    .section-bg__content {
        margin: 0 auto;
        flex-wrap: wrap;
        gap: 1.5rem;
        padding: 5rem .5rem;
        display: flex;
        align-items: center;
        gap: 2rem;
    }

    @media (max-width: 1250px) {
        .section-bg__content {
            flex-direction: column;
        }

    }

    .section-bg__text {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 2rem;
        color: var(--darkGreen);
    }

    .section-bg__text h2 {
        font-size: 2.8rem;
    }

    .section-bg__text p {
        font-size: 1.5rem;
        text-wrap: balance;
    }

    @media (max-width: 1250px) {
        .section-bg__content :is(p, h2) {
            text-align: center;
        }

    }

    /* Estilos de la lista */
    .section-bg__list {
        flex: 1;
        display: flex;
        justify-content: center;
    }

    .section-bg__list-content {
        display: grid;
        column-gap: 1rem;
        row-gap: 2rem;
        grid-template-columns: repeat(auto-fill, minmax(min(20rem, 100%), 1fr));
        height: fit-content;
    }

    .section-bg__list ol {
        list-style-type: none;
        display: flex;
        flex-direction: row;
        gap: 1rem;
    }

    .section-bg__list ol:nth-child(2) {
        position: relative;
        right: 2em;
    }

    .section-bg__list li {
        text-align: center;
        color: var(--light);
        padding: 0.8em 1.5em;
        border-radius: 0.7em;
        background-color: var(--darkPink);
    }

    /* Media Queries */
    @media (max-width: 1250px) {

        .section-bg {
            background-position-x: -0.5em;
        }

        .section-bg__text,
        .section-bg__list {
            padding: .5rem;
        }

        .section-bg__list-content {
            padding: 0;
            grid-template-columns: repeat(3, 1fr);
        }

        .section-bg__list ol {
            flex-direction: column;
        }

        .section-bg__list ol:nth-child(2) {
            right: 0;
        }
    }




    @media (max-width: 600px) {
        .section-bg__list-content {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 1rem;
        }
    }

    @media (min-width: 1900px) {
        .section-bg {
            background-position-y: 0em;
        }
    }
</style>
<section class="section-bg">
    <div class="section-bg__content container-section">
        <div class="section-bg__text">
            <h2>¿Cómo podemos ayudarte?</h2>
            <p>Nuestros psicólogos online cuentan con distintas especialidades. Las sesiones se adaptan a las
                necesidades de cada paciente.</p>
        </div>
        <div class="section-bg__list">
            <div class="section-bg__list-content">
                <ol>
                    <li>Adicciones</li>
                    <li>Ansiedad</li>
                    <li>Atención</li>
                    <li>Crianza</li>
                </ol>
                <ol>
                    <li>Depresión</li>
                    <li>Estrés</li>
                    <li>Impulsividad</li>
                    <li>TOC</li>
                </ol>
                <ol>
                    <li>Ira</li>
                    <li>Sexualidad</li>
                    <li>Traumas</li>
                    <li style="white-space: nowrap;">Riesgo Sexual</li>
                </ol>
            </div>
        </div>
    </div>
</section>
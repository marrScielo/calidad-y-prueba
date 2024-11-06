<div class="checkout-information-modal" id="modalNewAppointment">
    <form class="form-crearCita" action="../Crud/Cita/guardarCita.php" method="post">
        <a style="display: none"></a>
        <div class="input-group2">
            <div class="input-group" style="display: none">
                <h3 for="IdPaciente">Id Paciente <b style="color: red">*</b></h3>
                <div style="display: flex; gap: 1px">
                    <input id="IdPaciente" type="text" name="IdPaciente" required />
                    <a class="search id"><span style="font-size: 4em" class="material-symbols-sharp">search</span></a>
                </div>
            </div>
            <div class="input-group">
                <h3 for="codigopac">Codigo Paciente <b style="color: red">*</b></h3>
                <div style="display: flex; gap: 5px">
                    <input id="codigopac" type="text" name="codigopac" class="input" />
                    <a class="search codigoaa" translate="no"><span style="font-size: 4em"
                            class="material-symbols-sharp">search</span></a>
                </div>
            </div>
            <div class="input-group">
                <h3 for="NomPaciente">
                    Nombre Paciente <b style="color: red">*</b>
                </h3>
                <div style="display: flex; gap: 5px">
                    <input id="NomPaciente" type="text" name="NomPaciente" />
                    <a class="search nom" translate="no"><span style="font-size: 4em"
                            class="material-symbols-sharp">search</span></a>
                </div>
            </div>
        </div>

        <div class="input-group2">
            <div class="input-group">
                <h3 for="Paciente">Paciente <b style="color: red">*</b></h3>
                <input id="Paciente" type="text" name="Paciente" readonly />
            </div>
            <div class="input-group">
                <h3 for="MotivoCita">
                    Motivo de la Consutla <b style="color: red">*</b>
                </h3>
                <input style="
                font-family: 'Montserrat', sans-serif;
                font-size: 14px;
            " type="text" id="MotivoCita" name="MotivoCita" required />

            </div>
        </div>


        <div style="display: none" class="input-group">
            <h3 for="correo">correo<b style="color: red">*</b></h3>
            <input id="correo" type="text" name="correo" readonly />
        </div>
        <div style="display: none" class="input-group">
            <h3 for="telefono">telefono<b style="color: red">*</b></h3>
            <input id="telefono" type="text" name="telefono" readonly />
        </div>

        <div class="input-group2">
            <div class="input-group">
                <h3 for="EstadoCita">
                    Estado de la Cita <b style="color: red">*</b>
                </h3>
                <select style="width: 100%" class="input" id="EstadoCita" name="EstadoCita" required>
                    <option value="">Seleccione un Estado</option>
                    <option value="Se requiere confirmacion" selected>
                        Se requiere confirmacion
                    </option>
                    <option value="Confirmado">Confirmado</option>
                    <option value="Ausencia del paciente">
                        Ausencia del paciente
                    </option>
                </select>
            </div>
            <div class="input-group">
                <h3 for="ColorFondo">Color de Cita <b style="color: red">*</b></h3>
                <input type="color" value="#f38238" id="ColorFondo" name="ColorFondo" list="colorOptions"/>
                <datalist id="colorOptions">
                    <option value="#b4d77b">Rojo</option>
                    <option value="#9274b3">Verde</option>
                    <option value="#f38238">Azul</option>
                </datalist>
            </div>
        </div>
        <?php
        /* FECHA LIMITE  */
        date_default_timezone_set('America/Lima');
        $fechamin = date("Y-m-d")
            ?>
        <div class="input-group2">
            <div class="input-group">
                <h3 for="FechaInicioCita">
                    Fecha de Cita<b style="color: red">*</b>
                </h3>
                <input type="date" id="FechaInicioCita" name="FechaInicioCita" min="<?= $fechamin ?>"
                    value="<?= $fechamin ?>" />
            </div>
            <div class="input-group">
                <h3 for="HoraInicio">Hora de Cita <b style="color: red">*</b></h3>
                <input type="time" id="HoraInicio" name="HoraInicio" oninput="validarHora()" />
            </div>
        </div>
        <div class="input-group2">
            <div class="input-group">
                <h3 for="TipoCita">Tipo de Cita <b style="color: red">*</b></h3>
                <select class="input" id="TipoCita" name="TipoCita" required>
                    <option value="">Seleccione un Tipo</option>
                    <option value="Primera Visita">Primera Visita</option>
                    <option value="Visita de control" selected>Visita de control</option>
                </select>
            </div>
            <div class="input-group">
                <h3 for="DuracionCita" style="align-items: center">
                    Duracion <b style="color: red">*</b>
                </h3>
                <select style="width: 100%" class="input" id="DuracionCita" name="DuracionCita" required>
                    <option value="5'">5'</option>
                    <option value="10'">10'</option>
                    <option value="15'">15'</option>
                    <option value="20'">20'</option>
                    <option value="30'">30'</option>
                    <option value="40'">40'</option>
                    <option value="45'">45'</option>
                    <option value="50'">50'</option>
                    <option value="60'">60'</option>
                    <option value="90'">90'</option>
                    <option value="120'">120'</option>
                </select>
            </div>
        </div>
        <div class="input-group" style="display: none">
            <h3 for="FechaFin">FechaFin <b style="color: red">*</b></h3>
            <input id="FechaFin" type="text" name="FechaFin" readonly />
        </div>
        <div class="input-group2">
            <div class="input-group">
                <h3 for="CanalCita">
                    Canal de Atraccion <b style="color: red">*</b>
                </h3>
                <select class="input" id="CanalCita" name="CanalCita" required>
                    <option value="">Seleccione una Atraccion</option>
                    <option value="Cita Online" selected>Cita Online</option>
                    <option value="Marketing Directo">Marketing Directo</option>
                    <option value="Referidos">Referidos</option>
                </select>
            </div>
            <div class="input-group">
                <h3 for="EtiquetaCita">Etiqueta <b style="color: red">*</b></h3>
                <select class="input" id="EtiquetaCita" name="EtiquetaCita" required>
                    <option value="">Seleccione una Etiqueta</option>
                    <option value="Consulta" selected>Consulta</option>
                    <option value="Familia Referida">Familia Referida</option>
                    <option value="Prioridad">Prioridad</option>
                </select>
            </div>
        </div>
        <div class="input-group" style="display: none">
            <h3 for="IdPsicologo">IdPsicologo</h3>
            <input type="text" id="IdPsicologo" name="IdPsicologo" value="<?= $_SESSION['IdPsicologo'] ?>"
                placeholder="Ingrese algun Antecedente Medico" />
        </div>
        <div class="button-container">
            <button class="button" id="btnCloseModalNewAppointment">Cerrar</button>
            <button id="submitButton" class="button">Finalizar</button>
        </div>
    </form>
</div>
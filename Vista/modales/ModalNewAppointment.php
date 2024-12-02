<div class="checkout-information-modal" id="modalNewAppointment" style="padding: 1em;">
    <form class="form-crearCita" id="miFormulario" action="../Crud/Cita/guardarCita.php" method="post">
        <a style="display: none"></a>
        <div class="input-group2">
            <div class="input-group" style="display: none">
                <h3 for="IdPaciente">Id Paciente <b style="color: red">*</b></h3>
                <div style="display: flex; gap: 1px">
                    <input id="IdPaciente" type="text" name="IdPaciente" required />
                    <a class="search id"><span style="font-size: 4em" class="material-symbols-sharp">search</span></a>
                </div>
            </div>
            <div class="input-group" style="display: none;">
                <h3 for="codigopac">Codigo Paciente <b style="color: red">*</b></h3>
                <div style="display: flex; gap: 5px">
                    <input id="codigopac" type="text" name="codigopac" class="input" />
                    <a class="search codigoaa" translate="no"><span style="font-size: 4em"
                            class="material-symbols-sharp">search</span></a>
                </div>
            </div>
            <div class="input-group" style="display: none;">
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

        <div class="input-group2" style="display: flex; flex-direction: column; gap: 1rem;">
            <div class="input-group">
                <h3 for="Paciente">Paciente <b style="color: red">*</b></h3>
                <input id="Paciente" type="text" name="Paciente"  readonly data-error-target="error-paciente"/>
                <span class="error-message" id="error-paciente"></span>

            </div>
            <div class="input-group">
                <h3 for="MotivoCita">
                    Motivo de la Consutla <b style="color: red">*</b>
                </h3>
                <textarea style="
                font-family: 'Montserrat', sans-serif;
                font-size: 14px;
                resize: vertical;
                max-height: 100px;
                height: auto;
                min-height: 42px;
            " id="MotivoCita" name="MotivoCita" data-error-target="error-motivo"></textarea>
                <span class="error-message" id="error-motivo"></span>
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
                <select style="width: 100%" class="input" id="EstadoCita" name="EstadoCita"  data-error-target="error-estadoCita">
                    <option value="">Seleccione un Estado</option>
                    <option value="Se requiere confirmacion" selected>
                        Se requiere confirmacion
                    </option>
                    <option value="Confirmado">Confirmado</option>
                    <option value="Ausencia del paciente">
                        Ausencia del paciente
                    </option>
                </select>
                <span class="error-message" id="error-estadoCita"></span>

            </div>
            <div class="input-group">
                <h3 for="ColorFondo">Color de Cita <b style="color: red">*</b></h3>
                <input type="color" value="#f38238" id="ColorFondo" name="ColorFondo" list="colorOptions" data-error-target="error-colorFondo"/>
                <datalist id="colorOptions">
                    <option value="#b4d77b">Rojo</option>
                    <option value="#9274b3">Verde</option>
                    <option value="#f38238">Azul</option>
                </datalist>
                <span class="error-message" id="error-colorFondo"></span>
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
                    value="<?= $fechamin ?>"  data-error-target="error-fechaInicioCita"/>
                <span class="error-message" id="error-fechaInicioCita"></span>
            </div>
            <div class="input-group">
                <h3 for="HoraInicio">Hora de Cita <b style="color: red">*</b></h3>
                <input type="time" id="HoraInicio" name="HoraInicio" oninput="validarHora()" data-error-target="error-horaInicio"/>
                <span class="error-message" id="error-horaInicio"></span>
            </div>
        </div>
        <div class="input-group2">
            <div class="input-group">
                <h3 for="TipoCita">Tipo de Cita <b style="color: red">*</b></h3>
                <select class="input" id="TipoCita" name="TipoCita"  data-error-target="error-tipoCita">
                    <option value="">Seleccione un Tipo</option>
                    <option value="Primera Visita">Primera Visita</option>
                    <option value="Visita de control" selected>Visita de control</option>
                </select>
                <span class="error-message" id="error-tipoCita"></span>
            </div>
            <div class="input-group">
                <h3 for="DuracionCita" style="align-items: center">
                    Duracion <b style="color: red">*</b>
                </h3>
                <select style="width: 100%" class="input" id="DuracionCita" name="DuracionCita"  data-error-target="error-duracionCita">
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
                <span class="error-message" id="error-duracionCita"></span>
            </div>
        </div>
        <div class="input-group" style="display: none">
            <h3 for="FechaFin">FechaFin <b style="color: red">*</b></h3>
            <input id="FechaFin" type="text" name="FechaFin" readonly  />
        </div>
        <div class="input-group2">
            <div class="input-group">
                <h3 for="CanalCita">
                    Canal de Atraccion <b style="color: red">*</b>
                </h3>
                <select class="input" id="CanalCita" name="CanalCita"  data-error-target="error-canalAtraccion">
                    <option value="">Seleccione una Atraccion</option>
                    <option value="Cita Online" selected>Cita Online</option>
                    <option value="Marketing Directo">Marketing Directo</option>
                    <option value="Referidos">Referidos</option>
                </select>
                <span class="error-message" id="error-canalAtraccion"></span>
            </div>
            <div class="input-group">
                <h3 for="EtiquetaCita">Etiqueta <b style="color: red">*</b></h3>
                <select class="input" id="EtiquetaCita" name="EtiquetaCita"  data-error-target="error-etiquetaCita">
                    <option value="">Seleccione una Etiqueta</option>
                    <option value="Consulta" selected>Consulta</option>
                    <option value="Familia Referida">Familia Referida</option>
                    <option value="Prioridad">Prioridad</option>
                </select>
                <span class="error-message" id="error-etiquetaCita"></span>
            </div>
        </div>
        <div class="input-group" style="display: none">
            <h3 for="IdPsicologo">IdPsicologo</h3>
            <input type="text" id="IdPsicologo" name="IdPsicologo" value="<?= $_SESSION['IdPsicologo'] ?>"
                placeholder="Ingrese algun Antecedente Medico" />
        </div>
        <div class="button-container">
            <div class="button" id="btnCloseModalNewAppointment">Cerrar</div>
            <button id="submitButton" class="button">Finalizar</button>
        </div>
    </form>
</div>

<!-- Script en línea -->
<script src="../Issets/js/validationMessageGeneral.js" defer></script>
<script>
        // Llamada a la función que está en el archivo externo
        const fieldsConfig = {
          'MotivoCita': 'El motivo de la consulta es obligatorio.',
          "EstadoCita": "El estado de la cita es obligatorio.",
          "ColorFondo": "El color de la cita es obligatorio.",
          "TipoCita": "El tipo de cita es obligatorio.",
          "DuracionCita": "La duración de la cita es obligatoria.",
          "FechaInicioCita": "La fecha de inicio de la cita es obligatoria.",
          "HoraInicio": "La hora de inicio de la cita es obligatoria.",
          "CanalCita": "El canal de atraccion es obligatorio.",
          "EtiquetaCita": "La etiqueta de la cita es obligatoria.",
        //   'ApPaterno': 'El apellido paterno es obligatorio.',
        //   'ApMaterno': 'El apellido materno es obligatorio.',
        //   'FechaNacimiento': 'La fecha de nacimiento es obligatoria.',
        //   'GradoInstruccion': 'El grado de instrucción es obligatorio.',
        //   'Ocupacion': 'La ocupación es obligatoria.',
        //   'EstadoCivil': 'El estado civil es obligatorio.',
        //   'Genero': 'El género es obligatorio.',
        //   'Telefono': 'El teléfono es obligatorio.',
        //   'Email': 'El correo electrónico es obligatorio.',
        //   'Departamento': 'El departamento es obligatorio.',
        //   'Provincia': 'La provincia es obligatoria.',
        //   'Distrito': 'El distrito es obligatorio.',
        //   'Direccion': 'La dirección es obligatoria.',
        //   'AntecedentesMedicos': 'Los antecedentes médicos son obligatorios.',
        //   'MedicamentosPrescritos': 'Los medicamentos prescritos son obligatorios.'
        };

        document.getElementById('miFormulario').addEventListener('submit', function(e) {
          e.preventDefault();
          if (validateForm(fieldsConfig)) {
            e.target.submit();
          }
        });
</script>

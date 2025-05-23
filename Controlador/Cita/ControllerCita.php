<?php
class usernameControlerCita
{
    private $model;
    public function __construct()
    {
        require_once(__DIR__ . "/../../Modelo/Cita/ModelCita.php");
        $this->model = new UserModelCita();
    }

    // Guardar datos de la cita
    public function guardar($IdPaciente, $MotivoCita, $EstadoCita, $FechaInicioCita, $DuracionCita, $FechaFinCita, $TipoCita, $ColorFondo, $IdPsicologo, $CanalCita, $EtiquetaCita)
    {
        $id = $this->model->insertarCita($IdPaciente, $MotivoCita, $EstadoCita, $FechaInicioCita, $DuracionCita, $FechaFinCita, $TipoCita, $ColorFondo, $IdPsicologo, $CanalCita, $EtiquetaCita);
    }

    public function getAll($idPsicologo, $IdCita = null, $nomPaciente = null, $codigo = null, $dateStart = null, $dateEnd = null, $limit = 10, $offset = 0)
    {
        return $this->model->getAll($idPsicologo, $IdCita, $nomPaciente, $codigo, $dateStart, $dateEnd, $limit, $offset);

    }

    // Para ver datos completos de la cita
    public function ver($idUsuario, $page = 1, $rowsPerPage = 10)
    {
        $offset = ($page - 1) * $rowsPerPage;
        return $this->model->ver($idUsuario, $rowsPerPage, $offset);
    }

    // Eliminar cita seleccionada 
    public function eliminar($id)
    {
        return ($this->model->eliminar($id)) ? header("Location:../../Vista/TablaCitas.php") : header("Location:../../Vista/TablaCitas.php");
    }

    public function modificarCita($IdCita, $FechaInicio, $EstadoCita, $MotivoCita, $Duracioncita, $TipoCita, $CanalCita, $EtiquetaCita, $ColorFondo)
    {
        $result = $this->model->modificarCita($IdCita, $FechaInicio, $EstadoCita, $MotivoCita, $Duracioncita, $TipoCita, $CanalCita, $EtiquetaCita, $ColorFondo);
        if ($result) {
            header("Location: ../../Vista/TablaCitas.php?success=1");
        } else {
            header("Location: ../../Vista/TablaCitas.php?error=1");
        }
    }

    // Mostrar datos de cita seleccionada
    public function show($id)
    {
        $cita = $this->model->show($id);
        if ($cita != false) {
            $FechaCitaInicio = explode(" ", $cita['FechaInicioCita']);
            $FechaInicio = $FechaCitaInicio[0];
            $HoraInicio = $FechaCitaInicio[1];

            $datos = [
                'id' => $cita['IdCita'],
                'FechaInicio' => $FechaInicio,
                'HoraInicio' => $HoraInicio,
                'ColorFondo' => $cita['ColorFondo'],
                'MotivoCita' => $cita['MotivoCita'],
                'EstadoCita' => $cita['EstadoCita'],
                'TipoCita' => $cita['TipoCita'],
                'CanalCita' => $cita['CanalCita'],
                'EtiquetaCita' => $cita['EtiquetaCita'],
                'Duracioncita' => $cita['Duracioncita'],
                'Email' => $cita['Email'],
                'Telefono' => $cita['Telefono'],
            ];

            return $datos;
        } else {
            header("Location: ../../Vista/RegCitas.php");
        }
    }

    // Mostrar citas segun la fecha actual
    public function showByFecha($id)
    {
        return ($this->model->showByFecha($id));
    }

    // Contar el total de citas 
    public function totalCitas($idPsicologo, $IdCita = null, $nomPaciente = null, $codigo = null, $dateStart = null, $dateEnd = null)
    {
        return ($this->model->totalCitas($idPsicologo, $IdCita, $nomPaciente, $codigo, $dateStart, $dateEnd))[0];
    }
    public function contarRegistrosEnCitas($id)
    {
        return ($this->model->contarRegistrosEnCitas($id));
    }

    // Contar el total de citas confirmadas
    public function contarCitasConfirmadas($id)
    {
        return ($this->model->contarCitasConfirmadas($id));
    }

    // Contar el total de pacientes     
    public function contarRegistrosEnPacientes($id)
    {
        return ($this->model->contarRegistrosEnPacientes($id));
    }

    // Contar el total de pacientes de la fecha actual
    public function contarPacientesConFechaActual($id)
    {
        return ($this->model->contarPacientesConFechaActual($id));
    }

    // Contar el total de citas de la fecha actual
    public function obtenerFechasCitasConFechaActual($id)
    {
        return ($this->model->obtenerFechasCitasConFechaActual($id));
    }

    // Contar el total de citas de la hora actual
    public function obtenerHorasCitasConFechaActual($id)
    {
        return ($this->model->obtenerHorasCitasConFechaActual($id));
    }

    // Contar las citas con el nombre de pacientes y las horas    
    public function obtenerCitasConNombrePacienteHoraMinutos($id)
    {
        return ($this->model->obtenerCitasConNombrePacienteHoraMinutos($id));
    }
    public function contarCitasConfirmadasConCanal($id)
    {
        return ($this->model->contarCitasConfirmadasConCanal($id));
    }

    public function contarCitasConfirmadasConCanal2($id)
    {
        return ($this->model->contarCitasConfirmadasConCanal2($id));
    }

    public function contarCitasConfirmadasConCanal3($id)
    {
        return ($this->model->contarCitasConfirmadasConCanal3($id));
    }
    public function contarPacientesUltimoMes($id)
    {
        return ($this->model->contarPacientesUltimoMes($id));
    }

}
?>
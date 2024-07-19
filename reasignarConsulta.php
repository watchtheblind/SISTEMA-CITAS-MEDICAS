<?php
    function editarDatos(){
        $fechaCita = $_POST["start"];
        $fechaCitaVieja = $_POST["fechaCitaVieja"];
        $tipoConsulta = $_POST["tipoConsulta"];
        $tipoConsultaVieja = $_POST["tipoConsultaVieja"];
        $nomApeMedico = $_POST["docInfo"];
        $nomMedico = explode(" ", $nomApeMedico)[0];
        $apeMedico = implode(" ", array_slice(explode(" ", $nomApeMedico), 1));
        $cedula = $_POST["cedula"];
        $puesto = $_POST["nroPuesto"];
        $codigoCita = $puesto."-".$cedula;
        $titulo = $tipoConsulta."-".$cedula;
        $tituloViejo = $_POST["tituloViejo"];
        include "conectarBD.php";
        $stmt = $conn->prepare("UPDATE consultas SET 
        puesto=:puesto, 
        nombre_medico=:nombreMedico, 
        apellido_medico=:apellidoMedico, 
        especialidad_consulta=:especialidad, 
        codigo_cita=:codigoCita, 
        title=:titulo, 
        start=:inicio
        WHERE cedula_paciente=:cedula AND start=:inicioViejo AND especialidad_consulta=:especialidadVieja AND title=:tituloViejo");
        $stmt->bindParam(':puesto', $puesto);
        $stmt->bindParam(':nombreMedico', $nomMedico);
        $stmt->bindParam(':apellidoMedico', $apeMedico);
        $stmt->bindParam(':especialidad', $tipoConsulta);
        $stmt->bindParam(':codigoCita', $codigoCita);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':inicio', $fechaCita);
        $stmt->bindParam(':cedula', $cedula);
        $stmt->bindParam(':inicioViejo', $fechaCitaVieja);
        $stmt->bindParam(':especialidadVieja', $tipoConsultaVieja);
        $stmt->bindParam(':tituloViejo', $tituloViejo);
        $stmt->execute();
        $afectado = $stmt->rowCount();
        if($afectado ==1){
            header('Location: calendar.php?shSuccMsg=3');
            exit;
        }
    }
    if (isset($_POST["reasignar"])) {
        editarDatos();
    }
?>
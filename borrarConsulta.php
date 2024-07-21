<?php
    function borrarDatos(){
        include "conectarBD.php";
        $cedula = $_POST["cedula"];
        $fechaCita = $_POST["fechaCita"];
        $tituloCita = $_POST["tituloCita"];
        $especialidadCita = $_POST["especialidadCita"];
        $stmt = $conn->prepare("DELETE FROM consultas WHERE
        cedula_paciente = :cedula AND start = :fechaCita AND title = :tituloCita AND especialidad_consulta = :especialidad");
        $stmt->bindParam(':cedula', $cedula);
        $stmt->bindParam(':fechaCita', $fechaCita);
        $stmt->bindParam(':tituloCita', $tituloCita);
        $stmt->bindParam(':especialidad', $especialidadCita);
        $stmt->execute();
        $afectado = $stmt->rowCount();
        if($afectado >= 1){
            header('Location: calendar.php?shSuccMsg=2');
            exit;
        }
    }
    if (isset($_POST["cedula"])) {
        borrarDatos();
    }
?>
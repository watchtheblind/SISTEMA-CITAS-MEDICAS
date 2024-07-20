<?php
    function reasignarDatos(){
        include "conectarBD.php";
        $cedula = $_POST["cedula"];
        $fechaCita = $_POST["fechaCita"];
        $stmt = $conn->prepare("DELETE FROM consultas WHERE cedula_paciente = :cedula AND start = :fechaCita");
        $stmt->bindParam(':cedula', $cedula);
        $stmt->bindParam(':fechaCita', $fechaCita);
        $stmt->execute();
        $afectado = $stmt->rowCount();
        if($afectado ==1){
            header('Location: calendar.php?shSuccMsg=3');
            exit;
        }
    }
    if (isset($_POST["cedula"])) {
        reasignarDatos();
    }
?>
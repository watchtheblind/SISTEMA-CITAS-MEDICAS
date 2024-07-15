<?php
    function borrarDatos(){
        include "conectarBD.php";
        $cedula = $_POST["cedula"];
        $fechaCita = $_POST["fechaCita"];
        $stmt = $conn->prepare("UPDATE consultas SET cedula_paciente = :cedula AND start = :fechaCita");
        $stmt->bindParam(':cedula', $cedula);
        $stmt->bindParam(':fechaCita', $fechaCita);
        $stmt->execute();
        $afectado = $stmt->rowCount();
        if($afectado ==1){
            header('Location: calendar.php?shSuccMsg=2');
            exit;
        }
    }
    if (isset($_POST["cedula"])) {
        borrarDatos();
    }
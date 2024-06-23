<?php
    function borrarDatos(){
        include "conectarBD.php";
        $cedula = $_POST["cedula"];
        $stmt = $conn->prepare("DELETE FROM consultas WHERE cedula_paciente = :cedula");
        $stmt->bindParam(':cedula', $cedula);
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

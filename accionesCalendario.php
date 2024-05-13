<?php 
 include '../conectarBD.php';
 $pacNombre= $_POST['pacNombre'];
 $pacApellido= $_POST['pacApellido'];
 $tipoConsulta = $_POST['tipoConsulta'];
 $docNombre= $_POST['docNombre'];
 $pacCedula = $_POST['pacCedula'];
 $fechaCita = $_POST['fechaCita'];
 $title = $tipoConsulta."-".$pacCedula;

 try {
     // Your database code here
     $stmt = $conn->prepare("INSERT INTO consultas (nombre_medico, 
     apellido_medico, nombre_paciente, apellido_paciente, especialidad_consulta, title, 
     start, cedula_paciente)
     values (:nomMed, :apeMed, :nomPac, :apePac, :consulta, :titulo, :iniciaEn, :cedulaPac)");
     $stmt->bindParam(':nomMed', $docNombre);
     $stmt->bindParam(':apeMed', $docNombre);
     $stmt->bindParam(':apePac', $PacApellido);
     $stmt->bindParam(':consulta', $tipoConsulta);
     $stmt->bindParam(':titulo', $title);
     $stmt->bindParam(':iniciaEn', $fechaCita);
     $stmt->bindParam(':cedulaPac', $pacCedula);
     $stmt->execute();
 
     if ($stmt->rowCount() > 0) {
         header('Location: calendar.php?hola');
         exit;
     }
 } 
 catch (PDOException $e) {
     header('Location: calendar.php?shSuccMsg=0');
     exit;
 }
?>
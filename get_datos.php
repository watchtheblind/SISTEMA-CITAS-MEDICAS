<?php

include "conectarBD.php";
if (isset($_POST['cedula'])) {
    $cedula = $_POST['cedula'];
    $query = "SELECT nombre,apellido FROM paciente WHERE cedula = :cedula";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':cedula', $cedula);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($row);
  } else {
    echo '{"error": "No se encontraron resultados"}';
  }
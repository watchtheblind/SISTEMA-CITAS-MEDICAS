<?php
    $nombreHost = 'localhost';
    $baseDatos = 'citas_medicas';
    $usuario = 'root';
    $contrasena = "";
//$conexion = mysqli_connect($nombreHost, $usuario, '',$baseDatos);

try {
    $conn = new PDO("mysql:host=$nombreHost;dbname=$baseDatos", $usuario, $contrasena);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

/*$dsn = 'mysql:host=' . $nombreHost . ';dbname=' . $baseDatos;

$pdo = new PDO($dsn, $usuario, $contrasena);*/


?>
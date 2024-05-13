<?php 
 include 'conectarBD.php';
$fecha = $_GET["fecha"];
$stmt = $conn->prepare("SELECT * FROM consultas WHERE start = :fecha");
$stmt->bindParam(':fecha', $fecha);
$stmt->execute();

$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultados as $dato) {
    $posicionCita= $dato['puesto']; 
    $puestos = [1,2,3,4,5,6,7,8,9,10,11,12];
    for ($i=0; $i<12; $i++){
        if ($puestos[$i] == $posicionCita){
            $num = $i + 1;
            $puesto_res = "cita-".$num;
            echo "<script>  $('$puesto_res').attrs('disabled',true);</script>";
        }
    }
}
<?php 
 include 'conectarBD.php';
$fecha = $_GET["fecha"];
$stmt = $conn->prepare("SELECT * FROM consultas WHERE start = :fecha");
$stmt->bindParam(':fecha', $fecha);
$stmt->execute();
//el siguiente código desactiva la opción de registrar una cita si el puesto ya fue ocupado por un registro anterior
//si entre los doce puestos hay un paciente que ocupe alguno, entonces ya no se permitirá registrar a alguien en su puesto
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultados as $fila) {
    $puestoPaciente= $fila['puesto']; 
    $puestos = [1,2,3,4,5,6,7,8,9,10,11,12];
    for ($i=0; $i<12; $i++){
        if ($puestos[$i] == $puestoPaciente){
            $num = $i + 1;
            $puesto_res = "#cita-".$num;
            echo "<script>   $('$puesto_res').attr('disabled',true);
            $('$puesto_res').removeClass('btn-success').addClass('btn-secondary'); 
            </script>";
        }
    }
}
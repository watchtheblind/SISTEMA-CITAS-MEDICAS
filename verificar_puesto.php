<?php
//este archivo es manejado por calendario/configsCalendario.php
// Include the database connection file
include 'conectarBD.php';

$fecha = $_GET["fecha"];
$stmt = $conn->prepare("SELECT * FROM consultas WHERE start = :fecha");
$stmt->bindParam(':fecha', $fecha);
$stmt->execute();

$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

function deshabilitarBotonesCita($resultados) {
    $puestos = range(1, 14); //usar range para generar un array del 1 al 14
    foreach ($resultados as $fila) {
        $puestoPaciente = $fila['puesto'];
        if (in_array($puestoPaciente, $puestos)) {
            $num = $puestoPaciente;
            $puesto_res = "#".$fila['nombre_medico'].$fila['apellido_medico']."-".$num;
            echo "<script>  
                $('$puesto_res').prop('disabled', true);
                $('$puesto_res').removeClass('btn-outline-success');
                $('$puesto_res').prop('checked', true);
            </script>";
        }
    }
}

// Call the function
deshabilitarBotonesCita($resultados);
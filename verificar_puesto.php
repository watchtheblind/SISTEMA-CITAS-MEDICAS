
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
    $puestos = range(1, 12); //usar range para generar un array del 1 al 12
    foreach ($resultados as $fila) {
        $puestoPaciente = $fila['puesto'];
        if (in_array($puestoPaciente, $puestos)) {
            $num = $puestoPaciente;
            $puesto_res = "#cita-" . $num;
            echo "<script>  
                $('$puesto_res').attr('disabled', true);
                $('$puesto_res').removeClass('btn-success').addClass('btn-secondary'); 
            </script>";
        }
    }
}

// Call the function
deshabilitarBotonesCita($resultados);
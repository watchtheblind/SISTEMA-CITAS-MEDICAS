<?php
    include "conectarBD.php";
    $query = $conn->prepare("SELECT * FROM consultas");
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    $events = [];
    $datos = [];
    foreach ($results as $result) {
        $events[] = [
            'title' => $result['title'],
            'start' => $result['start'],
            'color' => $result['color']
        ];
        $datos[] = [
            'title' => $result['title'],
            'nombreMedico' => $result['nombre_medico'],
            'apellidoMedico' => $result['apellido_medico'],
            'nombrePaciente' => $result['nombre_paciente'],
            'apellidoPaciente' => $result['apellido_paciente'],
            'cedulaPaciente' => $result['cedula_paciente'],
            'estadoConsulta' => $result['estado_consulta'],
            'especialidadConsulta' => $result['especialidad_consulta']
        ];
    }
    echo json_encode(array('events' => $events, 'datos' => $datos));
?>

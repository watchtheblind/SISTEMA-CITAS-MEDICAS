<?php 
    $nombreHost = 'localhost';
    $baseDatos = 'citas_medicas';
    $usuario = 'root';
    $contrasena = "";

    try {
        // Create a PDO connection
        $conn = new PDO("mysql:host=$nombreHost;dbname=$baseDatos", $usuario, $contrasena);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $pacNombre = $_POST['pacNombre'];
        $pacApellido = $_POST['pacApellido'];
        $tipoConsulta = $_POST['tipoConsulta'];
        $docInfo = $_POST['docInfo'];
        list($docNombre, $docApe) = explode(' ', $docInfo); //separar el nombre y el apellido para guardarlos por separado
        $pacCedula = $_POST['pacCedula'];
        $fechaCita = $_POST['fechadeCita'];
        $title = $tipoConsulta.'-'.$pacCedula;
        $puesto = $_POST['nroPuesto'];
        $codigoCita= $puesto."-".$pacCedula;
        // Prepare and execute the SQL query
        $stmt = $conn->prepare("INSERT INTO consultas (nombre_medico, apellido_medico, nombre_paciente, apellido_paciente,
        especialidad_consulta, title, start, cedula_paciente, codigo_cita, puesto)
        VALUES (:nomMed, :apeMed, :nomPac, :apePac, :consulta, :titulo, :iniciaEn, :cedulaPac, :codigo, :puesto)");
        $stmt->bindParam(':nomMed', $docNombre);
        $stmt->bindParam(':apeMed', $docApe);
        $stmt->bindParam(':nomPac', $pacNombre);
        $stmt->bindParam(':apePac', $pacApellido);
        $stmt->bindParam(':consulta', $tipoConsulta);
        $stmt->bindParam(':titulo', $title);
        $stmt->bindParam(':iniciaEn', $fechaCita);
        $stmt->bindParam(':cedulaPac', $pacCedula);
        $stmt->bindParam(':codigo', $codigoCita);
        $stmt->bindParam(':puesto', $puesto);
        $stmt->execute();
        $afectado = $stmt->rowCount();
        if ($afectado == 1) {
            echo "<div class='text-center alert alert-success'>Registro correcto</div>";
        }

    } catch (PDOException $e) {
        echo "<div class='text-center alert alert-danger'>Error:". $e->getMessage();"</div>";
    }
<?php
    include 'conectarBD.php';
    $PacCedula = $_POST['pacCed'];
    $PacNombres = $_POST['pacNom'];
    $PacApellidos = $_POST['pacApe'];
    $PacTelefono = $_POST['pacTel'];
    $PacEstado = $_POST['pacEdo'];
    $PacMunicipio = $_POST['pacMun'];
    $PacParroquia = $_POST['pacParroq'];
    $PacComunidad = $_POST['pacCom'];
    $stmt = $conn->prepare("INSERT INTO paciente (cedula, nombre, apellido, telf, estado, municipio, parroquia, comunidad)
    values (:cedula, :nombre, :apellido, :telf, :estado, :municipio, :parroquia, :comunidad)");
    $stmt->bindParam(':cedula', $PacCedula);
    $stmt->bindParam(':nombre', $PacNombres);
    $stmt->bindParam(':apellido', $PacApellidos);
    $stmt->bindParam(':telf', $PacTelefono);
    $stmt->bindParam(':estado', $PacEstado);
    $stmt->bindParam(':municipio', $PacMunicipio);
    $stmt->bindParam(':parroquia', $PacParroquia);
    $stmt->bindParam(':comunidad', $PacComunidad );
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo '
        <script>
        //Alerta de Almacenamiento exitoso
        alert("Paciente registrado exitosamente");
        window.location.href= "login.php";
        </script>
        ';
    }
?> 

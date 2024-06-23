<?php
    function crearPaciente(){
        include '../conectarBD.php';
        $PacCedula = $_POST['pacCed'];
        $PacNombres = $_POST['pacNom'];
        $PacApellidos = $_POST['pacApe'];
        $PacTelefono = $_POST['pacTel'];
        $PacEstado = $_POST['pacEdo'];
        $PacMunicipio = $_POST['pacMun'];
        $PacParroquia = $_POST['pacParroq'];
        $PacComunidad = $_POST['pacCom'];
        try {
            // Your database code here
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
            $afectado = $stmt->rowCount();
            if ($afectado == 1) {
                header('Location: ../calendar.php?shSuccMsg=1');
                exit;
            }
        } 
        catch (PDOException $e) {
            ?><script>alert(<?php $e?>)</script><?php
            header('Location: ../calendar.php?shSuccMsg=0');
            exit;
        }
    }
    if (isset($_POST['regPaciente'])) {
        crearPaciente();
    }
?>    

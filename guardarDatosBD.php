
<?php
    include 'conectarBD.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="recursos/sweetalert2-11.12.0/src/sweetalert2.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script src="sweetalert2.all.min.js"></script>
</head>
<body>
<?php
    function crearPaciente(){
        include 'conectarBD.php';
        $PacCedula = $_POST['pacCed'];
        $PacNombres = $_POST['pacNom'];
        $PacApellidos = $_POST['pacApe'];
        $PacTelefono = $_POST['pacTel'];
        $PacEstado = $_POST['pacEdo'];
        $PacMunicipio = $_POST['pacMun'];
        $PacParroquia = $_POST['pacParroq'];
        $PacComunidad = $_POST['pacCom'];
        try {
            // Verificar si la cédula ya existe
            $stmt = $conn->prepare("SELECT * FROM paciente WHERE cedula = :cedula");
            $stmt->bindParam(':cedula', $PacCedula);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                header('Location: panelUsuario.php?shSuccMsg=0');
                exit;
            }
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
        
            if ($stmt->rowCount() == 1) {
                header('Location: panelUsuario.php?shSuccMsg=1');
                exit;
            }
        } 
        catch (PDOException $e) {
            header('Location: error.php?error='.urlencode($e->getMessage()));
            exit;
        }
    }
    function crearMedico(){
        include 'conectarBD.php';
        $MedCedula = $_POST['medCed'];
        $MedNombres = $_POST['medNom'];
        $MedApellidos = $_POST['medApe'];
        $MedTelefono = $_POST['medTel'];
        $MedCargo = $_POST['medCargo'];
        $MedEspecialidad = $_POST['medEspec'];
        $MedAtencion = $_POST['medAtencion'];
        try {
            // Verificar si la cédula ya existe
            $stmt = $conn->prepare("SELECT * FROM medicos WHERE cedula = :cedula");
            $stmt->bindParam(':cedula', $MedCedula);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                header('Location: panelUsuario.php?shSuccMsg=0');
                exit;
            }
            $stmt = $conn->prepare("INSERT INTO medicos (cedula, nombre, apellido, telf, especialidad, cargo, atiende)
            values (:cedula, :nombre, :apellido, :telf, :especialidad, :cargo, :atiende)");
            $stmt->bindParam(':cedula', $MedCedula);
            $stmt->bindParam(':nombre', $MedNombres);
            $stmt->bindParam(':apellido', $MedApellidos);
            $stmt->bindParam(':telf', $MedTelefono);
            $stmt->bindParam(':especialidad', $MedEspecialidad);
            $stmt->bindParam(':cargo', $MedCargo);
            $stmt->bindParam(':atiende', $MedAtencion);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                header('Location: panelUsuario.php?shSuccMsg=1');
                exit;
            }
        }
        catch (PDOException $e){
            header('Location: panelUsuario.php?shSuccMsg=0&shErrorMsg='.urlencode($e->getMessage()));
            exit;
        }
    }
    if (isset($_POST['regPaciente'])) {
        crearPaciente();
    }
    else if (isset($_POST['regMedico'])) {
        crearMedico();
    }

?>    
</body>
</html>

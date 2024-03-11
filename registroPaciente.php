
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
</head>
<body>
<script>
                Swal.fire({
  title: "The Internet?",
  text: "That thing is still around?",
  icon: "question"
});
                </script>
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

    if ($stmt->rowCount() > 0) {
        header('Location: login.php?shSuccMsg=1');
        exit;
    }
} catch (PDOException $e) {
    header('Location: login.php?shSuccMsg=0');
    exit;
}
?>    
</body>
</html>

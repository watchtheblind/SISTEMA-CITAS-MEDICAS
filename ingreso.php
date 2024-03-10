<?php
session_start();
include 'conectarBD.php';
$usuario = $_POST['txt_uname'];
$contrasena=$_POST['txt_pwd'];

$stmt = $conn->prepare("SELECT * FROM usuarios WHERE nombre_usuario = :usuario AND contrasena = :contrasena");
$stmt->bindParam(':usuario', $usuario);
$stmt->bindParam(':contrasena', $contrasena);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $_SESSION['user'] = $usuario;
    header("Location: login.php");
    exit();
}else{
echo '
<script>
//Alerta de Almacenamiento exitoso
alert("El usuario no esta existe, debe verificar los datos");
//Windows Location a index.php
window.location.href= "index.php";
</script>
';
//Cerrar el script
exit();
}
?>


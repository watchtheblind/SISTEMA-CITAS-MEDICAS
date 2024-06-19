<?php
    session_start(); 
    $usuario = $_SESSION['user'];
    $contraActual = $_POST['actual'];
    $contraNueva = $_POST['nueva'];
    $contraRepetir = $_POST['repetir'];
    include "conectarBD.php";
    try {
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE nombre_usuario = :usuario AND contrasena = :contrasena");
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':contrasena', $contraActual);
        $stmt->execute();
        $afectado = $stmt->rowCount();
        if ($afectado == 1) {
            $query = "UPDATE usuarios SET contrasena = :nuevaContrasena WHERE nombre_usuario = :usuario";
            $query->bindParam(':usuario', $usuario);
            $query->bindParam(':nuevaContrasena', $contraNueva);
            $query->execute();
            $afectado2 = $query->rowCount();
            if($afectado2 ==1){
                header('Location: ../panelUsuario.php?shSuccMsg=3');
                session_destroy();
                exit;
            }
        
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>
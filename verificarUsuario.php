<?php
$user = $_SESSION['user'];
$stmt = $conn->prepare('SELECT perfil FROM usuarios WHERE nombre_usuario = :username');
$stmt->bindParam(':username', $user);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
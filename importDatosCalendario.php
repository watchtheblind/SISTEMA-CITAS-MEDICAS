<?php
    include "conectarBD.php";
    $query = $conn->prepare("SELECT title,start,color FROM consultas");
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($results);
?>

<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <link rel="stylesheet" href="recursos/bootstrap-5.3.3/css/bootstrap.min.css">
    <script src="recursos/bootstrap-5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="recursos/jquery-3.7.1.min.js"></script>
    <script src='recursos/fullcalendar-6.1.14/dist/index.global.min.js'></script>
    <!-- PHP code separated from HTML -->
    <?php
    include "conectarBD.php";
    $stmt = $conn->prepare("SELECT * from medicos GROUP BY atiende");
    $stmt->execute();
    $atiendeOptions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt = $conn->prepare("SELECT * from medicos");
    $stmt->execute();
    $medicosOptions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    require "calendario/configsCalendario.php";
    ?>
    <style>
      body {
        padding: 20px;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div id='calendar'></div>
      </div>
    </div>
    <!-- modal para reservas -->
    <?php require "calendario/modal/reservas.php"?>
    <!-- modales de formulario de cita -->
    <?php require "calendario/modal/formularioCita.php"?>
    <!-- modal que muestra la información  -->
    <?php require "calendario/modal/mostrarInfo.php"?>
    <script src="assets/js/modal.js"></script>
    <!-- enviar datos con ajax -->
    <script src="assets/js/ajaxCalendario.js"></script>
  </body>
</html>
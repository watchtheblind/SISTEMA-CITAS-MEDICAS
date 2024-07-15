<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <link rel="stylesheet" href="recursos/bootstrap-5.3.3/css/bootstrap.min.css">
    <script src="recursos/sweetalert2-11.12.0/src/sweetalert2.js"></script>
    <script src="recursos/bootstrap-5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="recursos/jquery-3.7.1.min.js"></script>
    <script src='recursos/fullcalendar-6.1.14/dist/index.global.min.js'></script>
    <link rel="stylesheet" href="./assets/compiled/css/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="assets/css/sweetalert2.css">
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
    require "calendario/modal/registrarPacientes2.php";
    ?>
    <script src="assets/static/js/initTheme.js"></script>
    <style>
      body {
        padding: 20px;
      }
    </style>
  </head>
  <body>
    <?php
      require "alertas.php";
    ?>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div id='calendar'></div>
      </div>
    </div>
    <!-- modal para reservas -->
         <!-- modales de formulario de cita -->
    <?php require "calendario/modal/formularioCita.php"?>
    <?php require "calendario/modal/cantidadPuestos.php"?>
    <?php require "calendario/modal/reasignacionFecha.php"?>

    <!-- modal que muestra la información  -->
    <?php require "calendario/modal/mostrarInfo.php"?>
    <script src="assets/js/medicosSegunEspecialidad.js"></script>
    <!-- enviar datos con ajax -->
    <script src="assets/js/ajaxCalendario.js"></script>
    <script src="assets/js/sweetalert2.all.min.js"></script>
    <script>
      const estados = ['Aragua', 'Distrito Capital','Carabobo','Sucre','Amazonas','Anzoátegui','Apure','Barinas','Bolívar','Cojedes',
      'Delta Amacuro','Falcón','Guárico','Lara','Mérida','Miranda','Monagas','Nueva Esparta','Portuguesa',
      'Táchira','Trujillo','La Guaira','Yaracuy','Zulia'];
      const select = document.getElementById('estados');
      for (let i = 0; i < estados.length; i++) {
          const option = document.createElement('option');
          option.value = estados[i];
          option.textContent = estados[i];
          select.appendChild(option);
      }
    </script>
    <script src="assets/js/llenadoAutomaticoCalendario.js"></script>
    <script src="assets/js/seleccionarSoloUnPuesto.js"></script>
  </body>
</html>
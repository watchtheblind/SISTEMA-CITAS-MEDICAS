<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <style>
      /* Agregamos un poco de espacio entre el calendario y el borde de la página */
      body {
        padding: 20px;
      }
    </style>
    <script>
      let a;
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
          locale: "es", //poner idioma español
          editable: true,
          selectable: true,
          events: 'importDatosCalendario.php',
          navLinks: true, //fechas y semanas seleccionables
          //evitar seleccionar fechas pasadas y meses pasados:
          validRange: function (nowDate) {
            return {
              start: nowDate
            };
          },
          allDaySlot: false, //desactivar evento que dura todo el día
          hiddenDays: [0], //no se muestra el domingo
          //acciones que se dan al hacer click en una fecha:
          dateClick: function(info) {
            a = info.dateStr;
            const fechaComoCadena = a;
            let numeroDia = new Date (fechaComoCadena).getDay();
            let dias = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes']
            $('#modalReservas').modal('show');
            $('#diaSemana').html(dias[numeroDia] + " " + a);
        },
          headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay',
          },
          // dayMaxEventRows: true, // for all non-TimeGrid views
        views: {
          timeGrid: {
            dayMaxEventRows: 6 // adjust to 6 only for timeGridWeek/timeGridDay
          }
        }  
        });

        calendar.render();
      });
    </script>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div id='calendar'></div>
        </div>
      </div>
    </div>
    <!-- modal de informaciones -->
    <div class="modal fade" id="modalReservas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Reservar cita para el día <span id="diaSemana"></span></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"></span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <div class="d-flex justify-content-center">
                  <strong>turno mañana</strong>
                </div>
                <div class="d-grid gap-2 mt-4">
                  <!-- imprimir seis botones distintos -->
                  <?php for ($i=1; $i<=6; $i++){
                    ?> <button class="btn btn-success btn-block" data-bs-dismiss="modal" id="cita-<?php echo $i?>">reservar</button> <?php
                  }?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="d-flex justify-content-center">
                  <strong>turno tarde</strong>
                </div>
                <div class="d-grid gap-2 mt-4">
                  <!-- imprimir seis botones distintos -->
                  <?php for ($i=7; $i<=12; $i++){
                    ?> <button class="btn btn-success btn-block" data-bs-dismiss="modal" id="cita-<?php echo $i?>">reservar</button> <?php
                  }?>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modalFormulario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Reservar cita para el día <span id="diaSemana"></span></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"></span>
              </button>
            </div>
          <div class="modal-body">
            <form action="" method="post">
<!-- PHP code separated from HTML -->
<?php
include "conectarBD.php";

$stmt = $conn->prepare("SELECT * from medicos GROUP BY atiende");
$stmt->execute();
$atiendeOptions = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT * from medicos");
$stmt->execute();
$medicosOptions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- HTML code -->
<div class="row">
  <div class="col-md-6">
    <label for="">Nombre (paciente)</label>
    <input type="text" class="form-control">
  </div>
  <div class="col-md-6">
    <label for="">Tipo de consulta</label>
    <select id="atiende-select" class="form-select" aria-label="Default select example">
      <option hidden>Elija opción...</option>
      <?php foreach ($atiendeOptions as $row) {?>
        <option value="<?php echo $row['atiende'];?>"><?php echo $row['atiende'];?></option>
      <?php }?>
    </select>
  </div>
</div>
<div class="row mt-3">
  <div class="col-md-6">
    <label for="">Apellido (paciente)</label>
    <input type="text" class="form-control">
  </div>
  <div class="col-md-6">
    <label for="">Doctor que lo atenderá</label>
    <select  disabled id="medico-select" class="form-select" aria-label="Default select example">
      <option hidden>Elija opción...</option>
      <?php foreach ($medicosOptions as $row) {?>
        <option data-atiende="<?php echo $row['atiende'];?>" value="<?php echo  $row['nombre'].' '.$row['apellido'];?>"><?php echo $row['nombre'].' '.$row['apellido'];?></option>
      <?php }?>
    </select>
  </div>
</div>

<!-- JQuery code -->
<script>
  //el select del médico estará bloqueado hasta elegir una opción
   document.getElementById('atiende-select').addEventListener('change', function() {
    if (this.value!== '') {
      document.getElementById('medico-select').disabled = false;
    } else {
      document.getElementById('medico-select').disabled = true;
    }
  });
  //filtrar según la especialidad
  $(document).ready(function() {
    // When the document is ready, execute the following code
    
    // Select the element with the id "atiende-select" and listen to the change event
    $('#atiende-select').on('change', function() {
      // Get the value of the selected option in the "atiende-select" element
      var atiendeValue = $(this).val();
      
      // Hide all options in the "medico-select" element
      $('#medico-select option').hide();
      
      // Show only the options in the "medico-select" element that match the selected "atiende" value
      $('#medico-select option[data-atiende="' + atiendeValue + '"]').show();
    });
  });
</script>
<!-- script para deshabilitar el segundo select -->

              <div class="row mt-3">
                <div class="col-md-6">
                  <label for="">Cédula</label>
                  <input type="text" class="form-control">
                </div>
                <div class="col-md-6">
                  <label for="">Fecha de la cita</label>
                  <input type="text" class="form-control" id="fechaCita" disabled>
                </div> 
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    <script>
      $('#cita-1').click(function (){
        alert("añuña");
        $('#modalFormulario').modal('show');
        $('#fechaCita').val(a);
      })
    </script>
  </body>
</html>
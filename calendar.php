<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
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
      eventStartEditable: false,
      events: <?php require 'importDatosCalendario.php' ?>,
      maxEvents: 12,
      navLinks: true, //fechas y semanas seleccionables
      eventClick: function(info){
        let events = <?php echo json_encode($events); ?>;
        var datos = <?php echo json_encode($datos); ?>;
        const event = events.find(event => event.title === info.event.title);
        const datosEvento = datos.find(data => data.title === event.title);
        const pacienteNomApe = datosEvento.nombrePaciente+" "+datosEvento.apellidoPaciente;
        const cedulaPaciente = datosEvento.cedulaPaciente;
        const medicoNomApe =  datosEvento.nombreMedico+" "+datosEvento.apellidoMedico;
        const especialidad = datosEvento.especialidadConsulta;
        const estadoConsulta = datosEvento.estadoConsulta;
        const fechaCita = event.start;
         // contenido del modal para cada fecha
        document.getElementById('eventModalBody').innerHTML =
        `
        <form action="tickets/ticket.php" method="post" target="_blank">
          <div class="row text-center">
            <div class="col-md-6">
              <label>Paciente:</label>
              <strong><p>${pacienteNomApe}</p></strong>
              <input type="hidden" name="paciente" value="${pacienteNomApe}"/>
              <label>Médico que lo atiende:</label>
              <strong><p>${medicoNomApe}</p></strong>
              <input type="hidden" name="medico" value="${medicoNomApe}"/>
              <label>Especialidad a atender:</label>
              <strong><p>${especialidad}</p></strong>
              <input type="hidden" name="especialidad" value="${especialidad}"/>
            </div>
            <div class="col-md-6">
              <label>Cédula del paciente:</label>
              <strong><p>V-${cedulaPaciente}</p></strong>
              <input type="hidden" name="cedula" value="${cedulaPaciente}"/>
              <label>Estado de consulta:</label>
              <strong><p>${estadoConsulta}</p></strong>
              <label>Fecha de atención:</label>
              <strong><p>${fechaCita}</p></strong>
              <input type="hidden" name="fechaCita" value="${fechaCita}"/>
            </div>
            <div class="col-md-12">
              <button class="btn btn-primary" type="submit">Generar ticket</button>
            </div>
          </div>
        </form>
        `;
      // Show the modal
      var modal = new bootstrap.Modal(document.getElementById('eventModal'));
      modal.show();
      // Prevent the browser from navigating to the event's URL
      info.jsEvent.preventDefault();
      },
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
        // ajax para que los puestos se reserven
        let fecha = info.dateStr;
        let res ="";
        let url = "verificar_horario.php";
        $.get(url,{fecha:fecha}, function (datos){
          res = datos;
          for (let i = 1; i <= 12; i++) {
          $(`#respuesta-${i}`).html(res);
        }
        });
      },
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay',
    },
    // dayMaxEventRows: true, // for all non-TimeGrid views
    views: {
      timeGrid: {
        dayMaxEventRows: 12 // adjust to 6 only for timeGridWeek/timeGridDay
      }
    },
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
    <!-- modal para reservas -->
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
                  <?php for ($i=1; $i<=6; $i++):?>
                    <button class="btn btn-success btn-block" data-bs-dismiss="modal" id="cita-<?php echo $i?>">reservar</button>
                  <?php endfor; ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="d-flex justify-content-center">
                  <strong>turno tarde</strong>
                </div>
                <div class="d-grid gap-2 mt-4">
                  <?php for ($i=7; $i<=12; $i++):?>
                    <button class="btn btn-success btn-block" data-bs-dismiss="modal" id="cita-<?php echo $i?>">reservar</button> 
                  <?php endfor; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- modales de formulario de cita -->
    <?php for ($i=1; $i<=12; $i++):?>
      <div class="modal fade" id="modalFormulario-<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reservar cita para el día <?php echo $i ?><span id="diaSemana"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"  data-bs-toggle="modal" data-bs-target="#modalReservas" aria-label="Close">
                  <span aria-hidden="true"></span>
                </button>
              </div>
            <div class="modal-body">
              <form id="Formajax-<?php echo $i ?>" method="">
                <div class="row">
                  <div class="col-md-6">
                    <label for="">Nombre (paciente)</label>
                    <input type="text" class="form-control" name="pacNombre">
                  </div>
                  <div class="col-md-6">
                    <label for="">Tipo de consulta</label>
                    <select id="atiende-select-<?php echo $i ?>" class="form-select" name="tipoConsulta" aria-label="Default select example">
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
                    <input type="text" class="form-control" name="pacApellido">
                  </div>
                  <div class="col-md-6">
                    <label for="">Doctor que lo atenderá</label>
                    <select  disabled id="medico-select-<?php echo $i ?>" name="docInfo" class="form-select" aria-label="Default select example">
                      <option hidden>Elija opción...</option>
                      <?php foreach ($medicosOptions as $row) {?>
                        <option data-atiende="<?php echo $row['atiende'];?>" value="<?php echo  $row['nombre'].' '.$row['apellido'];?>"><?php echo $row['nombre'].' '.$row['apellido'];?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-md-6">
                    <label for="cedula">Cédula (paciente)</label>
                    <input type="text" name="pacCedula" class="form-control">
                  </div>
                  <div class="col-md-6">
                    <label for="fechaCita">Fecha de la cita</label>
                    <input type="text" class="form-control" name="fechadeCita" id="fechaCita-<?php echo $i ?>">
                    <input type="number" class="form-control" name="nroPuesto" id="puesto-<?php echo $i ?>" hidden>
                  </div> 
                </div>
                </div>
                <div class="modal-footer">
                  <p id="resultado"></p>
                  <div id="respuesta-<?php echo $i ?>"></div>
                  <button type="button" class="btn btn-primary" id="enviar-<?php echo $i ?>">Guardar Datos</button>
                </div>
              </form>
          </div>
        </div>
      </div>
    <?php endfor;?>
    <!-- modal que muestra la información  -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="eventModalLabel">Detalles de Consulta</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p id="eventModalBody"></p>
          </div>
        </div>
      </div>
    </div>
    <script src="calendario/modal.js"></script>
    <!-- enviar datos con ajax -->
    <script>
      for (let i = 1; i <= 12; i++) {
        $(`#enviar-${i}`).click(function(){
          $.ajax({
            url: 'datos.php',
            type: 'POST',
            data: $(`#Formajax-${i}`).serialize(),
          })
          .done(function(res){
            $(`#respuesta-${i}`).html(res);
            
            calendar.refetchEvents();
            calendar.render();
          })
        });
      }
    </script>
    <!-- el otro ajax -->
    <script>
    </script>
  </body>
</html>
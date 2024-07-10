<script>
  let a;
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      locale: "es", //poner idioma español
      editable: true,
      selectable: true,
      eventStartEditable: false,
      events: <?php require 'calendario/importDatosCalendario.php' ?>, //buscar en la base de datos todos los eventos
      eventMouseEnter: function(info) {
        info.el.style.cursor = 'pointer'; // cambiar el cursor a puntero
        info.el.style.backgroundColor = 'rgba(22, 83, 140, 1)'; 
      },
      // comportamiento del mouse cuando está encima de un evento y cuando no
      eventMouseLeave: function(info) {
        info.el.style.cursor = 'default'; // resetear el cursor al default
        info.el.style.backgroundColor = ''; // resetear el color del evento
      },
      navLinks: false, //fechas y semanas seleccionables
      // pasar variables de la base de datos a un modal (el de imprimir ticket)👇
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
        localStorage.setItem('ticketCounter', 0);
        // Cuando se imprime un ticket
         // contenido del modal de generación de tickets, en el archivo mostrarinfo.php
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
              <div class="d-flex align-items-center justify-content-center">
                <label>Nro. del ticket:</label>
                <select class="form-control w-25 ms-2 mt-2 text-center border border-primary" name="numero">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                  <option>6</option>
                  <option>7</option>
                  <option>8</option>
                  <option>9</option>
                  <option>10</option>
                  <option>11</option>
                  <option>12</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <label>Cédula del paciente:</label>
              <strong><p>V-${cedulaPaciente}</p></strong>
              <input type="hidden" name="cedula" value="${cedulaPaciente}"/>
              <label>Estado de consulta:</label>
              <strong><p>Por atender</p></strong>
              <label>Fecha de atención:</label>
              <strong><p>${fechaCita}</p></strong>
              <input type="hidden" name="fechaCita" value="${fechaCita}"/>
              <button class="btn btn-primary mt-2" type="submit">Generar ticket</button>
            </div>
          </div>
        </form>
        <form action="borrarConsulta.php" method="post">
          <div class="col-md-12 d-flex justify-content-center mt-3">
            <input type="hidden" name="cedula" value="${cedulaPaciente}"/>
            <input type="hidden" name="fechaCita" value="${fechaCita}"/>
            <button id="borrarEvento" class="btn btn-danger w-75">Borrar consulta</button>
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
      //acciones que se dan al hacer click en una fecha: 👇
      dateClick: function(info) {
        getFecha = info.dateStr;
        const fechaComoCadena = getFecha;
        let numeroDia = new Date (fechaComoCadena).getDay();
        let dias = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes']
        $('#modalFormulario').modal('show');
        // $('#diaSemana').html(dias[numeroDia] + " " + a);
        // ajax para que los puestos se reserven
        let fecha = info.dateStr;
        let res ="";
        let url = "verificar_puesto.php";
        $.get(url,{fecha:fecha}, function (datos){
          res = datos;
          for (let i = 1; i <= 12; i++) {
          $(`#respuesta-${i}`).html(res);
        }
        });
      },
    headerToolbar: {
      left: 'prev,next',
      center: 'title',
      right: 'today',
    },
    buttonText: {
      today: 'ir a mes actual'
    },
    // dayMaxEventRows: true, // for all non-TimeGrid views
    views: {
      timeGrid: {
        dayMaxEventRows: 12, // adjust to 6 only for timeGridWeek/timeGridDay
      }
    },
  });
  calendar.render();
  });
</script>
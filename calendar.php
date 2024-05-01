<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <style>
      /* Agregamos un poco de espacio entre el calendario y el borde de la página */
      body {
        padding: 20px;
      }
    </style>
    <script>
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
  </body>
</html>
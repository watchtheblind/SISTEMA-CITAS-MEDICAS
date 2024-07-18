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
        const paciente = {
            nombre: datosEvento.nombrePaciente,
            apellido: datosEvento.apellidoPaciente,
            cedula: datosEvento.cedulaPaciente
          };

          const medico = {
            nombre: datosEvento.nombreMedico,
            apellido: datosEvento.apellidoMedico
          };

          const cita = {
            titulo: datosEvento.title,
            especialidad: datosEvento.especialidadConsulta,
            estado: datosEvento.estadoConsulta,
            fecha: event.start
          };

        localStorage.setItem('ticketCounter', 0);
        // Cuando se imprime un ticket
         // contenido del modal de generación de tickets, en el archivo mostrarinfo.php
        document.getElementById('eventModalBody').innerHTML =
        `
        <form action="tickets/ticket.php" method="post" target="_blank">
          <div class="row text-center">
            <div class="col-md-6">
              <label>Paciente:</label>
              <strong><p>${paciente.nombre + " " + paciente.apellido}</p></strong>
              <input type="hidden" name="paciente" value="${paciente.nombre + " " + paciente.apellido}"/>
              <label>Médico que lo atiende:</label>
              <strong><p>${medico.nombre + " " + medico.apellido}</p></strong>
              <input type="hidden" name="medico" value="${medico.nombre + " " + medico.apellido}"/>
              <label>Especialidad a atender:</label>
              <strong><p>${cita.especialidad}</p></strong>
              <input type="hidden" name="especialidad" value="${cita.especialidad}"/>
              <div class="d-flex align-items-center justify-content-center">
                <label>Nro. del ticket:</label>
                <select class="form-control w-25 ms-2 mt-2 text-center border border-primary" name="numero">
                  <?php for ($i = 1; $i <= 14; $i++) {?>
                    <option><?= $i?></option>
                  <?php }?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <label>Cédula del paciente:</label>
              <strong><p>V-${paciente.cedula}</p></strong>
              <input type="hidden" name="cedula" value="${paciente.cedula}"/>
              <label>Estado de consulta:</label>
              <strong><p>Por atender</p></strong>
              <label>Fecha de atención:</label>
              <strong><p>${cita.fecha}</p></strong>
              <input type="hidden" name="fechaCita" value="${cita.fecha}"/>
              <button class="btn btn-primary mt-2" type="submit">Generar ticket</button>
            </div>
          </div>
        </form>
        <div class="mt-4 d-flex justify-content-around">
          <div class="row align-items-center">
            <div class="col-4">
              <form action="borrarConsulta.php" method="post">
                <input type="hidden" name="cedula" value="${paciente.cedula}"/>
                <input type="hidden" name="fechaCita" value="${cita.fecha}"/>
                <button id="borrarEvento" class="btn btn-danger">Eliminar </button>
              </form>
            </div>
            <div class="col-8">
              <button id="ReasignarEvento" type="button" class="btn btn-warning" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#reasignacionModal">Reasignar Consulta</button>
            </div>
          </div>
        </div>
        `;
        //seccion para la reasignacion de consulta
        async function textoModalReasignar(){
          document.getElementById('modal-reasignar').innerHTML =`
          <form action="reasignarConsulta.php" method="post" class="d-grid my-2">
            <div class="row">
              <div class="col-md-6">
                <input type='date' required id='dateInput' class='form-control w-100'  min="<?= date('Y-m-d'); ?>">
              </div>
              <div class="col-md-6">
                <div class="text-center">
                  <label>Tipo de consulta:</label>
                  <strong><p>${cita.especialidad}</p></strong>
                </div>
              </div>
            </div>
            <div class="row d-flex justify-content-center">
              <div class="col-md-6">
                <label for="atiende-select-2">Nueva consulta: </label>
                <select disabled id="atiende-select-2" required class="form-select" name="tipoConsulta" aria-label="Default select example"  required>
                  <option hidden>Elija opción...</option>
                  <?php foreach ($atiendeOptions as $row) {?>
                    <option value="<?php echo $row['atiende'];?>"><?php echo $row['atiende'];?></option>
                  <?php }?>
                </select>
              </div>
              <div class="col-md-6">
                <label for="medico-select-2"> Medico que lo atenderá:</label>
                <div class="d-flex">
                  <select disabled id="medico-select-2" required name="docInfo" class="form-select" aria-label="Default select example">
                    <option hidden data-atiende="default" value="one">Elija opción...</option>
                    <?php foreach ($medicosOptions as $row) {?>
                      <option data-atiende="<?php echo $row['atiende'];?>" value="<?php echo  $row['nombre'].' '.$row['apellido'];?>"><?php echo $row['nombre'].' '.$row['apellido'];?></option>
                    <?php }?>
                  </select>
                  <button class="btn"required type="button" hidden id="ver-medicos-2" data-bs-toggle="modal" 
                  data-bs-target="#modalReservas"><i class="bi bi-eye"></i></button>
                </div>
              </div>
              <button type="submit" class="btn btn-primary mt-3">Reasignar cita</button> 
            </div>
            <input type="hidden" name="pacienteApe" value="${paciente.apellido}">
            <input type="hidden" name="pacienteNom" value="${paciente.nombre}">
            <input type="hidden" name="medicoNom" value="${medico.nombre}">
            <input type="hidden" name="medicoApe" value="${medico.apellido}">
            <input type="hidden" name="especialidad" value="${cita.especialidad}">
            <input type="hidden" name="cedula" value="${paciente.cedula}">
            <input type="hidden" name="fechaCita" value="${cita.fecha}">
            <input type="hidden" name="titulo" value="${cita.titulo}">        
          </form>
        `;
        }
        async function eleccionDeMedico(){
          await textoModalReasignar();
          document.getElementById(`atiende-select-2`).addEventListener("change", function () {
            document.getElementById(`medico-select-2`).selectedIndex = 0;
          });
          //el select del médico estará bloqueado hasta elegir una opción
          document.getElementById(`atiende-select-2`).addEventListener("change", function () {
            if (this.value !== "") {
              document.getElementById(`medico-select-2`).disabled = false;
            } else {
              document.getElementById(`medico-select-2`).disabled = true;
            }
          });
          //filtrar médicos según la especialidad que yo seleccione
          $(document).ready(function () {
            $(`#atiende-select-2`).on("change", function () {
              var atiendeValue = $(this).val();
              $(`#medico-select-2 option`).hide();
              $(`#medico-select-2 option[data-atiende="${atiendeValue}"]`).show();
              //mostrar el botón del ojo solo cuando se seleccione un médico
              const select = document.getElementById("medico-select-2");
              select.addEventListener("change", () => {
                if (select.value !== "one") {
                  document.getElementById("ver-medicos-2").removeAttribute("hidden");
                }
              });
            });
          });
        }
        async function mostrarReasignacionModal(){
          await eleccionDeMedico();
          const selectElement = document.getElementById('medico-select-2');
          const buttonElement = document.getElementById('ver-medicos-2');
          selectElement.addEventListener('change', function() {
          const selectedOption = selectElement.options[selectElement.selectedIndex];
          const valor = selectedOption.value.replace(/\s+/g, '');
          buttonElement.dataset.bsTarget = `#modalReservas-${valor}`;
          });
        }
        async function bloquearPuestos(){
          await mostrarReasignacionModal();
          // Obtener el botón con el icono de ojo
          const eyeButton = document.getElementById('ver-medicos-2');

          // Agregar un evento de click al botón
          eyeButton.addEventListener('click', function() {
            // Obtener el valor del input date
            const dateInput = document.getElementById('dateInput');
            const dateValue = dateInput.value;
            
            // Obtener el día de la semana
            const fechaComoCadena = dateValue;
            let numeroDia = new Date(fechaComoCadena).getDay();
            let dias = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes'];
            let diaSemana = dias[numeroDia] + " " + a;

            // Mostrar el día de la semana en un elemento HTML
            document.getElementById('diaSemana').innerHTML = diaSemana;

            // Continúa con el código restante
            // Ajax para que los puestos se reserven
            let fecha = dateValue;
            let res ="";
            let url = "verificar_puesto.php";
            $.get(url,{fecha:fecha}, function (datos){
              res = datos;
              $(`#respuesta2`).html(res);
            });
        })
        const dateInput = document.getElementById('dateInput');
        dateInput.addEventListener('change', function() {
          const select = document.getElementById('atiende-select-2');
          select.disabled = false;
        });
      };
      async function cambiarComportamientoModales(){
        await bloquearPuestos();
        cambiarDataBsTarget('cerrar', "reasignacionModal");
        document.getElementById("cerrarReasignar").addEventListener('click', function() {
          $(document.getElementById("eventModal")).modal('show');
        });
      }
      cambiarComportamientoModales();
      //contenido del modal de elegir fecha para reasignacion

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
          $(`#respuesta`).html(res);
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
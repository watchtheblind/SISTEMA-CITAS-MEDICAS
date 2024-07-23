<script>
  let button;
</script>
<?php
foreach ($medicosOptions as $row) { ?>
  <?php $nombreCompletoDoctor = str_replace(" ", "", $row['nombre']).str_replace(" ", "", $row['apellido']);
?>
  <div class="modal fade" id="modalReservas-<?php echo $nombreCompletoDoctor?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document"  data-bs-backdrop="static">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Reservar cita con <span id="diaSemana"><?php echo $row['nombre']." ".$row['apellido']?></span></h5>
          <button type="button" class="btn-close cerrar"  data-bs-toggle="modal" aria-label="Close" hidden>
            <span aria-hidden="true"></span>
          </button>
        </div>
        <div class="modal-body">
          <div class="alert alert-danger" id="alerta-<?php echo $nombreCompletoDoctor?>" role="alert" hidden>
            <strong>Advertencia:</strong> Ha sobrepasado la cantidad de pacientes que atiende el/la doctor/a (<?php echo $row['cantidad_pacientes']; ?>). Se aconseja no añadir más citas.
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="d-flex justify-content-center">
                <strong>turno mañana</strong>
              </div>
              <div class="d-grid gap-2 mt-4">
                <?php for ($i=1; $i<=7; $i++):?>
                  <input type="checkbox" class="btn-check" id="<?php echo $nombreCompletoDoctor ?>-<?php echo $i?>">
                  <label class="btn btn-outline-success" for="<?php echo $nombreCompletoDoctor ?>-<?php echo $i?>"><i class="bi bi-person"></i></label>
                <?php endfor; ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="d-flex justify-content-center">
                <strong>turno tarde</strong>
              </div>
              <div class="d-grid gap-2 mt-4">
                <?php for ($i=8; $i<=14; $i++):?>
                  <input type="checkbox" class="btn-check" id="<?php echo $nombreCompletoDoctor ?>-<?php echo $i?>">
                  <label class="btn btn-outline-success" for="<?php echo $nombreCompletoDoctor ?>-<?php echo $i?>"><i class="bi bi-person"></i></label>
                <?php endfor; ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 my-4 d-flex justify-content-center">
              <button class="btn btn-primary cerrar" type="button" id="guardar-puesto-<?php echo $nombreCompletoDoctor?>" data-bs-dismiss="modal" data-bs-toggle="modal">Guardar puesto</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    button = document.querySelector("#guardar-puesto-<?php echo $nombreCompletoDoctor?>");
    button.addEventListener("click", () => {
      //obtengo la casilla marcada
      const checkboxes = document.querySelectorAll(`#modalReservas-<?php echo $nombreCompletoDoctor ?> input[type="checkbox"]:checked`);
      //la paso a un array y luego, paso su id a un array
      const checkboxId = Array.from(checkboxes).map(checkbox => checkbox.id);
      //seleccionamos el campo puesto de formularioCita.php
      const puesto = document.querySelector("#puesto");
      const puesto2 = document.querySelector("#puesto2");
      //pasamos el valor del checkbox a string 
      checkboxString = checkboxId.join(',');
      //obteniendo el numero de puesto del checkbox
      checkboxNumeroPuesto = checkboxString.replace(/[^0-9]/g, '');
      puesto.value = checkboxNumeroPuesto;
      puesto2.value = checkboxNumeroPuesto;
    });
    //verificar si la capacidad de los pacientes atendibles es excedida por las citas pendientes
    $('#modalReservas-<?php echo $nombreCompletoDoctor ?>').on('show.bs.modal', function (e) {
      let puestosOcupados = this.querySelectorAll('input[type="checkbox"][disabled]');
      const alerta = document.querySelector("#alerta-<?php echo $nombreCompletoDoctor?>");
      let cantidadPuestosOcupados = puestosOcupados.length;
      let cantidadPacientes = <?php echo $row['cantidad_pacientes']; ?>;
      if (cantidadPuestosOcupados > cantidadPacientes) {
        alerta.removeAttribute('hidden');
      }
    });
    //bloquear guardar puesto:
  // Seleccionamos el botón guardar puesto
    // Función que se ejecutará cuando se cambie el estado de un checkbox
    function verificarCheckbox() {
      guardarPuesto = document.querySelector("#guardar-puesto-<?php echo $nombreCompletoDoctor?>");
      // Obtenemos la cantidad de checkboxes seleccionados
      checkboxesTodas = document.querySelectorAll(`#modalReservas-<?php echo $nombreCompletoDoctor ?> input[type="checkbox"]:checked`);
      cantidadCheckboxSeleccionados = checkboxesTodas.length;
      console.log(cantidadCheckboxSeleccionados);
      // Si no hay checkboxes seleccionados, deshabilitamos el botón
      if (cantidadCheckboxSeleccionados === 0) {
        guardarPuesto.disabled = true;
      } else {
        // Si hay al menos uno seleccionado, habilitamos el botón
        guardarPuesto.disabled = false;
      }
    }
    // Ejecutamos la función cuando se cargue la página
    verificarCheckbox();
    // Ejecutamos la función cada vez que se cambie el estado de un checkbox
    checkboxesMarcadas = document.querySelectorAll(`#modalReservas-<?php echo $nombreCompletoDoctor ?> input[type="checkbox"]`);
    checkboxesMarcadas.forEach((checkbox) => {
      checkbox.addEventListener('change', verificarCheckbox);
    });
  </script>
<?php } ?>

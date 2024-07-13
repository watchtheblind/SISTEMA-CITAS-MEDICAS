<?php
  $optionsArray = array();
  function doctorSinEspacio($doctor){
    return str_replace(' ', '', $doctor);
  }
  foreach ($medicosOptions as $row) {
    $optionsArray[] = $row['nombre']." ".$row['apellido'];
  }
?>
<?php 
foreach ($optionsArray as $doctor) { ?>
  <div class="modal fade" id="modalReservas-<?php echo doctorSinEspacio($doctor)?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Reservar cita con <span id="diaSemana"><?php echo $doctor ?></span></h5>
          <button type="button" class="btn-close" id="cerrar" data-bs-dismiss="modal" aria-label="Close">
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
                  <input type="checkbox" class="btn-check" id="<?php echo $doctor ?>-<?php echo $i?>">
                  <label class="btn btn-outline-success" for="<?php echo $doctor ?>-<?php echo $i?>"><i class="bi bi-person"></i></label>
                <?php endfor; ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="d-flex justify-content-center">
                <strong>turno tarde</strong>
              </div>
              <div class="d-grid gap-2 mt-4">
                <?php for ($i=7; $i<=12; $i++):?>
                  <input type="checkbox" class="btn-check" id="<?php echo $doctor ?>-<?php echo $i?>">
                  <label class="btn btn-outline-success" for="<?php echo $doctor ?>-<?php echo $i?>"><i class="bi bi-person"></i></label>
                <?php endfor; ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 my-4 d-flex justify-content-center">
              <button class="btn btn-primary" type="button" id="guardar-puesto" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalFormulario">Guardar puesto</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
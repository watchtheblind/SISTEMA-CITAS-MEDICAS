<div class="modal fade" id="modalReservas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reservar cita para el día <span id="diaSemana"></span></h5>
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
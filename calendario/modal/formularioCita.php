<div class="modal fade" id="modalFormulario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Reservar cita</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"></span>
            </button>
          </div>
        <div class="modal-body">
          <form id="Formajax" method="">
            <div class="row">
              <div class="col-md-6">
                <label for="cedula">Cédula (paciente)</label>
                <input type="number" name="pacCedula" id="Cedula" class="form-control" pattern="[0-9]*" oninput="fetchData(<?php echo $i ?>)">
              </div>
              <div class="col-md-6">
                <label for="">Tipo de consulta</label>
                <select id="atiende-select" class="form-select" name="tipoConsulta" aria-label="Default select example"  required>
                  <option hidden>Elija opción...</option>
                  <?php foreach ($atiendeOptions as $row) {?>
                    <option value="<?php echo $row['atiende'];?>"><?php echo $row['atiende'];?></option>
                  <?php }?>
                </select>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                <label for="">Nombre (paciente)</label>
                <input type="text" class="form-control" name="pacNombre" id="Nombre" required>
              </div>
              <div class="col-md-6">
                <label for="">Doctor que lo atenderá</label>
                <select  disabled id="medico-select" name="docInfo" class="form-select" aria-label="Default select example">
                  <option hidden>Elija opción...</option>
                  <?php foreach ($medicosOptions as $row) {?>
                    <option data-atiende="<?php echo $row['atiende'];?>" value="<?php echo  $row['nombre'].' '.$row['apellido'];?>"><?php echo $row['nombre'].' '.$row['apellido'];?></option>
                  <?php }?>
                </select>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                  <label for="">Apellido (paciente)</label>
                  <input type="text" class="form-control" name="pacApellido" id="Apellido">
              </div>
              <div class="col-md-6">
                <label for="fechaCita">Fecha de la cita</label>
                <input type="text" class="form-control" name="fechadeCita" id="fechaCita"> 
              </div> 
            </div>
            </div>
            <div class="modal-footer">
              <p id="resultado"></p>
              <button type="button" class="btn btn-primary d-flex justify-content-center" id="enviar">Guardar Datos</button>
              <div id="respuesta"></div>
            </div>
          </form>
      </div>
    </div>
  </div>
</div>
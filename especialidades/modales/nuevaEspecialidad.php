<div class="modal fade" id="modalEspecialidad" tabindex="-1" aria-labelledby="editMedModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pacModalLabel text-danger">CEDOCABAR</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>                
                </div>
                <div class="modal-body">
                    <div class="row">
                            <div class="col-lg">
                                <div class="form-group">
                                    <form class="row center" action="especialidades/especialidadesCRUD.php" method="post">
                                        <h3 class="d-flex justify-content-center">Nueva Especialidad</h3>
                                        <div class="form-row col-md d-flex justify-content-center ">
                                            <div class="form-group w-50">
                                                <input type="text" required name="EspecNueva" class="form-control" placeholder="EJ: Traumatología" required>
                                            </div>
                                        </div>
                                        <h4 class="d-flex justify-content-center mt-2 mb-3">Registre un médico para dicha especialidad</h4>
                                        <div class="form-row col-md-6">
                                            <div class="form-group">
                                                <label for="inputNombre">Nombres</label>
                                                <input type="nombre" required  name="medNom" class="form-control" id="medNombre" placeholder="Ej: Maria José">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputTelefono">Telefono</label>
                                                <input type="number" required onkeydown="return event.keyCode !== 69" name="medTel" class="form-control" id="inputTel" placeholder="04XX-XXXXXXX">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputCedula">Cedula</label>
                                                <input type="number" required onkeydown="return event.keyCode !== 69" name="medCed" class="form-control" id="inputCed" placeholder="Ej: 5674123">
                                            </div>
                                        </div>
                                        <div class="form-row col-md-6">
                                            <div class="form-group">
                                                <label for="inputApellido">Apellidos</label>
                                                <input type="text" required name="medApe" class="form-control" id="inputApell" placeholder="Ej: Torres Pérez">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEspecialidad">Cargo</label>
                                                <input type="text" required name="medCargo" class="form-control" id="inputCargo" placeholder="Ej: Director, R1, R2, etc.">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEspecialidad">Especialidad (que tiene, no la que atiende)</label>
                                                <input type="text" required name="medEspec" class="form-control" id="inputEspec" placeholder="Ej: Pediatra, Cardiólogo, etc.">
                                            </div>
                                        </div>
                                        <div class=" d-flex justify-content-center mt-3">           
                                            <button type="submit" class="btn bg-c-blue w-75 text-dark mt-2" id="aceptar" name="crearEspecialidad">Aceptar</button>        
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
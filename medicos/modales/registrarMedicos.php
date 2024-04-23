<div class="modal fade" id="medModal" tabindex="-1" aria-labelledby="MedModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pacModalLabel text-danger">CEDOCABAR</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>                
                </div>
                <div class="modal-body">
                    <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <form class="row center" action="guardarDatosBD.php" method="POST">
                                        <h3>Registrar Médicos</h3>
                                        <div class="form-row col-md-6">
                                            <div class="form-group">
                                                <label for="inputNombre">Nombres</label>
                                                <input type="nombre" name="medNom" class="form-control" id="medNombre" placeholder="Ej: Maria José">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputTelefono">Telefono</label>
                                                <input type="number" onkeydown="return event.keyCode !== 69" name="medTel" class="form-control" id="inputTel" placeholder="04XX-XXXXXXX">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputCedula">Cedula</label>
                                                <input type="number" onkeydown="return event.keyCode !== 69" name="medCed" class="form-control" id="inputCed" placeholder="Ej: 5674123">
                                            </div>
                                        </div>
                                        <div class="form-row col-md-6">
                                            <div class="form-group">
                                                <label for="inputApellido">Apellidos</label>
                                                <input type="text" name="medApe" class="form-control" id="inputApell" placeholder="Ej: Torres Pérez">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEspecialidad">Cargo</label>
                                                <input type="text" name="medCargo" class="form-control" id="inputCargo" placeholder="Ej: Director, R1, R2, etc.">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEspecialidad">Especialidad</label>
                                                <input type="text" name="medEspec" class="form-control" id="inputEspec" placeholder="Ej: Pediatra, Cardiólogo, etc.">
                                            </div>
                                        </div>
                                        <div class="div d-flex justify-content-center">
                                            <div class="form-row col-md-6 text-center">
                                                <label for="inputEspecialidad">Especialidad que atiende</label>
                                                <select required class="form-select" name="medAtencion" id="especialidades" aria-label="Default select example">
                                                    <option  value="" disabled selected hidden>Escoja especialidad</option>
                                                </select>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn bg-c-blue w-60 text-dark mt-4" id="aceptar" name="regMedico">Aceptar</button>        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 

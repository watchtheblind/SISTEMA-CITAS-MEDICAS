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
                                    <form class="row center" action="guardarDatosBD.php" method="POST" role="application">
                                        <h3>Registrar Médicos</h3>
                                        <div class="form-row col-md-6">
                                            <div class="form-group">
                                                <label for="inputCedula">Cedula</label>
                                                <input type="number" required onkeydown="return event.keyCode !== 69" name="medCed" class="form-control" id="inputCed" oninput="this.value = this.value.slice(0, 8)"   onpaste="setTimeout(() => this.value = this.value.slice(0, 8), 0)" placeholder="Ej: 5674123" tabindex="1">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputApellido">Apellidos</label>
                                                <input type="text" required name="medApe" class="form-control" id="inputApell" placeholder="Ej: Torres Pérez" tabindex="3">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputTelefono">Telefono</label>
                                                <input type="number" required onkeydown="return event.keyCode !== 69" name="medTel" class="form-control" id="inputTel" oninput="this.value = this.value.slice(0, 11)"  onpaste="setTimeout(() => this.value = this.value.slice(0, 11), 0)" placeholder="04XX-XXXXXXX" tabindex="5">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEspecialidad">Cantidad de pacientes que atiende</label>
                                                <input type="number" required name="medCantidad" class="form-control" id="inputEspec" oninput="this.value = this.value.slice(0, 2)"  onpaste="setTimeout(() => this.value = this.value.slice(0, 2), 0)" placeholder="Ej: 10" tabindex="7">
                                            </div>  
                                        </div>
                                        <div class="form-row col-md-6">
                                            <div class="form-group">
                                                <label for="inputNombre">Nombres</label>
                                                <input type="nombre" required  name="medNom" class="form-control" id="medNombre" placeholder="Ej: Maria José" tabindex="2">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEspecialidad">Cargo</label>
                                                <input type="text" required name="medCargo" class="form-control" id="inputCargo" placeholder="Ej: Director, R1, R2, etc." tabindex="4">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEspecialidad">Especialidad</label>
                                                <input type="text" required name="medEspec" class="form-control" id="inputEspec" placeholder="Ej: Pediatra, Cardiólogo, etc." tabindex="6">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEspecialidad">Especialidad que atiende</label>
                                                <select required class="form-select" name="medAtencion" id="especialidades" aria-label="Default select example" tabindex="8">
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

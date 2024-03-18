
<div class="modal fade" id="editMedModal" tabindex="-1" aria-labelledby="editMedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pacModalLabel text-danger">CEDOCABAR</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>                
            </div>
            <div class="modal-body">
                <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <form class="row center" action="medicos/funcionesCRUD.php" method="post">
                                    <h3>Editar médico</h3>
                                    <div class="form-row col-md-6">
                                        <div class="form-group">
                                            <label for="inputTelefono">Telefono</label>
                                            <input type="number" onkeydown="return event.keyCode !== 69" name="medTel" class="form-control" id="inputTel" placeholder="04XX-XXXXXXX">
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
                                    <button type="submit" name="editar" class="btn bg-c-blue w-60 text-dark mt-4" id="aceptar" name="regMedico">Aceptar</button>        
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
.try label::before {
    content: ' * ';
    color: red;
    font-size: 15px;
}
.editMed label::after {
    content: 'Obligatorio';
    color: red;
    font-size: 14px;
    font-style: italic;
    margin-bottom: 50px;

}

</style>

<div class="modal fade try" id="editMedModal" tabindex="-1" aria-labelledby="editMedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pacModalLabel text-danger">CEDOCABAR</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>                
            </div>
            <div class="modal-body">
                <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <form class="row center" action="medicos/funcionesCRUD.php" method="post">
                                    <h3 class="d-flex justify-content-center">Editar Médico</h3>
                                    <div class="form-row col-md-12 mt-4">
                                        <div class="form-group">
                                            <label for="inputTelefono">Telefono</label>
                                            <input required type="number" onkeydown="return event.keyCode !== 69" name="medTel" class="form-control" id="inputTel" placeholder="04XX-XXXXXXX">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEspecialidad">Cargo</label>
                                            <input required type="text" name="medCargo" class="form-control" id="inputCargo"  value="<?php $fila['cedula'] ?>" placeholder="Ej: Director, R1, R2, etc." >
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEspecialidad">Especialidad</label>
                                            <input required type="text" name="medEspec" class="form-control" id="inputEspec" placeholder="Ej: Pediatra, Cardiólogo, etc.">
                                        </div>
                                    </div>
                                    <div class="editMed"><label></label></div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" name="editar" class="btn bg-c-blue w-75 text-dark mt-3" id="aceptar" name="regMedico">Aceptar</button>
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

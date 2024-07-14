<?php echo '
<div class="modal fade" id="editCantModal-'.$fila['cedula'].'" tabindex="-1" aria-labelledby="editMedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pacModalLabel text-danger">CEDOCABAR</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>                
            </div>
            <div class="modal-body">
                <div class="row">
                        <div class="col-lg">
                            <div class="form-group">
                                <h5 class="d-flex justify-content-center">Editar cantidad que atiende</h5>
                                <div class="form-row col-md">
                                    <div class="form-group">
                                        <input type="number" max=15 oninput="this.value = this.value.slice(0, 2)"  onpaste="setTimeout(() => this.value = this.value.slice(0, 2), 0)" onkeydown="return event.keyCode !== 69" name="medCantidad" class="form-control" id="inputTel" placeholder="EJ: 12">
                                    </div>
                                </div>
                                <div class=" d-flex justify-content-center">
                                <button type="submit" name="editarCantidad" class="btn bg-c-blue w-75 text-dark mt-2" id="aceptar">Aceptar</button>        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
</td>
';
?>
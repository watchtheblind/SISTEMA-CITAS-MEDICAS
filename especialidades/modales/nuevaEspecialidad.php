<div class="modal fade" id="modalEspecialidad" tabindex="-1" aria-labelledby="editMedModalLabel" aria-hidden="true">
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
                                    <form class="row center" action="especialidades/especialidadesCRUD.php" method="post">
                                        <h3 class="d-flex justify-content-center">Nueva Especialidad</h3>
                                        <div class="form-row col-md">
                                            <div class="form-group">
                                                <input type="text" name="EspecNueva" class="form-control" placeholder="EJ: Traumatología" required>
                                            </div>
                                        </div>
                                        <div class=" d-flex justify-content-center">           
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
<?php echo '
                    <div class="modal fade" fade" id="editMedModal-'.$fila['cedula'].'" tabindex="-1" aria-labelledby="editMedModalLabel" aria-hidden="true">
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
                                                    <form class="row center" action="medicos/funcionesCRUD.php" method="post">
                                                        <h3 class="d-flex justify-content-center">Editar Teléfono</h3>
                                                        <div class="form-row col-md">
                                                            <div class="form-group">
                                                                <input type="number" onkeydown="return event.keyCode !== 69" name="medTel" class="form-control" id="inputTel" placeholder="EJ: 04243552252">
                                                                <input type="hidden" value="'.$fila['telf'].'">
                                                            </div>
                                                        </div>
                                                        <div class=" d-flex justify-content-center">
                                                        <button type="submit" name="editar" class="btn bg-c-blue w-75 text-dark mt-2" id="aceptar" name="regMedico">Aceptar</button>        
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
                    </form>
                    </td>
                    ';
                    ?>
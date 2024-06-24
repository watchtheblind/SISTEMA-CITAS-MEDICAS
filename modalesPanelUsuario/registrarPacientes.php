<div class="modal fade" id="pacModal" tabindex="-1" aria-labelledby="pacModalLabel" aria-hidden="true">
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
                            <h3>Registrar pacientes</h3>
                                <div class="form-row col-md-6">
                                    <div class="form-group">
                                        <label for="inputNombre1">Nombres</label>
                                        <input required type="nombre" name="pacNom" class="form-control" id="inputEmail4" placeholder="Ej: Pedro José">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress2">Telefono</label>
                                        <input required type="number" onkeydown="return event.keyCode !== 69" name="pacTel" class="form-control" id="inputTel" placeholder="04XX-XXXXXXX">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress">Cedula</label>
                                        <input required type="number" onkeydown="return event.keyCode !== 69" name="pacCed" class="form-control" id="inputTel2" placeholder="Ej: 5674123">
                                    </div>
                                </div>
                                <div class="form-row col-md-6">
                                    <div class="form-group">
                                        <label for="inputPassword4">Apellidos</label>
                                        <input required type="apellido" name="pacApe" class="form-control" id="inputPassword4" placeholder="Ej: Fernández Contreras">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress3">Estado</label>
                                        <select required class="form-select" name="pacEdo" id="estados" aria-label="Default select example">
                                            <option  value="" disabled selected hidden>Escoja estado</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress4">Municipio</label>
                                        <input required type="text" name="pacMun" class="form-control" id="inputMunicipio" placeholder="Ej: Girardot">
                                    </div>
                                </div>
                                <div class="form-row col-md-12 text-center">
                                    <div class="form-group">
                                        <label for="inputAddress2">Parroquia</label>
                                        <input required type="text" name="pacParroq" class="form-control" id="inputAddress2" placeholder="Ej: Las Delicias">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress2">Comunidad</label>
                                        <input required type="text" name="pacCom" class="form-control" id="inputAddress2" placeholder="Ej: La Pedrera">
                                    </div>
                                </div>
                                <button type="submit" class="btn bg-c-blue w-60 text-dark" id="aceptar" name="regPaciente">Aceptar</button>   
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
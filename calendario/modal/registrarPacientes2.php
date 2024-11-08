<div class="modal fade" id="pacModal2" tabindex="-1" aria-labelledby="pacModalLabel" aria-hidden="true">
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
                            <form class="row center" action="calendario/guardarDatosBD2.php" method="POST" role="application">
                            <h3>Registrar pacientes</h3>
                                <div class="form-row col-md-6">
                                    <div class="form-group">
                                        <label for="inputNombre1">Nombres</label>
                                        <input required type="nombre" name="pacNom" class="form-control" id="inputEmail4" placeholder="Ej: Pedro José" tabindex="1">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress2">Telefono</label>
                                        <input required type="number" oninput="this.value = this.value.slice(0, 11)"  onpaste="setTimeout(() => this.value = this.value.slice(0, 11), 0)" onkeydown="return event.keyCode !== 69" name="pacTel" class="form-control" id="inputTel" placeholder="04XX-XXXXXXX" tabindex="3">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress">Cedula</label>
                                        <input required type="number" oninput="this.value = this.value.slice(0, 8)"  onpaste="setTimeout(() => this.value = this.value.slice(0, 8), 0)" onkeydown="return event.keyCode !== 69" name="pacCed" class="form-control" id="inputTel2" placeholder="Ej: 5674123" tabindex="5">
                                    </div>
                                </div>
                                <div class="form-row col-md-6">
                                    <div class="form-group">
                                        <label for="inputPassword4">Apellidos</label>
                                        <input required type="apellido" name="pacApe" class="form-control" id="inputPassword4" placeholder="Ej: Fernández Contreras" tabindex="2" >
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress3">Estado</label>
                                        <select required class="form-select" name="pacEdo" id="estados" aria-label="Default select example" tabindex="4">
                                            <option  value="" disabled selected hidden>Escoja estado</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress4">Municipio</label>
                                        <input required type="text" name="pacMun" class="form-control" id="inputMunicipio" placeholder="Ej: Girardot" tabindex="6"> 
                                    </div>
                                </div>
                                <div class="form-row col-md-12 text-center">
                                    <div class="form-group">
                                        <label for="inputAddress2">Parroquia</label>
                                        <input required type="text" name="pacParroq" class="form-control" id="inputAddress2" placeholder="Ej: Las Delicias" tabindex="7">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress2">Comunidad</label>
                                        <input required type="text" name="pacCom" class="form-control" id="inputAddress2" placeholder="Ej: La Pedrera" tabindex="8">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                 <button type="submit" class="btn btn-primary w-50 bg-c-blue text-dark mt-4" id="aceptar" name="regPaciente">Aceptar</button>   
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
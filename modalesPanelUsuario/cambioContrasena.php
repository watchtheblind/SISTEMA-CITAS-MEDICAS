<div class="modal fade" id="pacModal2" tabindex="-1" aria-labelledby="pacModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pacModalLabel text-danger">CEDOCABAR <span id="pass" style="display: none;">
                        <?php echo $_SESSION['password'];?>
                    </span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Contraseña Actual </label>
                            <input type="text" id="actual" name="actual" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Contraseña Nueva</label>
                            <input type="password" id="nueva" name="nueva" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Repetir Contraseña </label>
                            <input type="password" id="repetir" name="repetir" class="form-control">
                        </div>
                        <button class="btn bg-c-blue w-100 text-dark" id="cambiar"
                            data-bs-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
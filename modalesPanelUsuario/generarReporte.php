<div class="modal" tabindex="-1" id="reportModal" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">CEDOCABAR</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="reportes/reporte.php" method="post" target="_blank">
                <div class="row justify-content-center text-center">
                    <div class="col-md-6">
                        <label for="startDate">Fecha de inicio:</label>
                        <input id="startDate" class="form-control mt-2" name="fecha1" type="date" required/>
                    </div>
                    <div class="col-md-6">
                        <label for="endDate">Fecha de fin:</label>
                        <input id="endDate" class="form-control mt-2" name="fecha2" type="date" required/>
                    </div>
                </div>
                <div class="modal-footer mt-2">
                    <button class="btn btn-primary" type="submit">Crear reporte</button>
                </div>
            </form>
        </div>
    </div>
</div>
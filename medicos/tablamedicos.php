<!-- //aplicar datatables a la tabla ppal -->
<script>
    $(document).ready( function () 
    {
        $('#myTable').DataTable(
            {
                "language":
                {
                           "url":"recursos/Datatables/es-ES.json"
                    // "url":"https://cdn.datatables.net/plug-ins/2.0.3/i18n/es-ES.json"
                }
            }
        );
    } );
</script>

<div class="container d-flex justify-content-start mb-3">
    <button class="btn btn-success " data-bs-toggle="modal" data-bs-target="#medModal">Registrar Médico</button>
    <button class="btn btn-success ms-2" onclick="openInPopup('calendar.php')">Nueva Cita</button>
    <button class="btn btn-success ms-2" data-bs-toggle="modal" data-bs-target="#reportModal">Generar Reporte</button>
</div>
<div>
    <div class="table-responsive">
        <table id="myTable" class="display">
            <thead class="thead-light">
                <tr class="text-center">
                    <th scope="col">Cedula</th>
                    <th scope="col">Nombres</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Especialidad</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Atiende</th>
                    <th scope="col">Acciones</th>
                    <th scope="col">Cantidad pacientes</th>
                </tr>
            </thead>
            <tbody>
                <?php include "medicos/medicosCRUD.php";
                    leerDatos();
                ?>
            </tbody>
        </table>
    </div>
</div>

   <!-- Modal de registro de médicos -->
   <?php require "medicos/modales/registrarMedicos.php" ?>
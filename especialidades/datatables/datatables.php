<!-- tabla principal de la sección especialidades -->
<script>
    $(document).ready( function () {
    $('#myTable').DataTable(
        {
            "language":{
                "url":"recursos/Datatables/es-ES.json"
                // "url":"https://cdn.datatables.net/plug-ins/2.0.3/i18n/es-ES.json"
            }
            
        }
    );
} );
</script>
<!-- se le pasa el formato datatable a los modales de las especialidades en "ver médico": -->
<?php 
$query = $conn->prepare("SELECT atiende, nombre, apellido, COUNT(*) as num_doctors FROM medicos GROUP BY atiende");
$query->execute();
$results = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($results as $fila):?>
<!-- hacer una tabla para cada especialidad de la base de datos -->
<script>
    $(document).ready( function () {
        $('#myTable<?php echo str_replace(' ', '', $fila['atiende']); ?>').DataTable(
            {
                "searching": false,
                "language":{
                    "url":"recursos/Datatables/es-ES.json"
                    // "url":"https://cdn.datatables.net/plug-ins/2.0.3/i18n/es-ES.json"
                }
            }
        );
    } );
</script>
<?php endforeach;?>
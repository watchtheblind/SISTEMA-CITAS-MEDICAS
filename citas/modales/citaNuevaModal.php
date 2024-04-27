<script>
$(document).ready(function(){
  $('#citaNueva').on('shown.bs.modal', function () {
    $('.variable').slick({
      dots: true,
      arrows: true,
      infinite: false,
      speed: 300,
      slidesToShow: 1,
      slidesToScroll: 1
    });
  });
  // Add a click event listener to the "Aceptar" button
  $('#aceptar').click(function(e) {
    e.preventDefault();
    // Advance to the next slide
    $('.variable').slick('slickNext');
  });
});
</script>
<!-- una tabla para cada especialidad c/u con una especialidad diferente -->
<?php 
$query = $conn->prepare("SELECT atiende, nombre, apellido FROM medicos GROUP BY atiende");
$query->execute();
$results = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($results as $fila):?>
<!-- hacer una tabla para cada especialidad de la base de datos -->
<script>
    $(document).ready( function () {
        $('#myTable<?php echo str_replace(' ', '', $fila['atiende']); ?>').DataTable(
            {
                "searching": false, //barra de busqueda
                "pageLength": 6, //items por pagina
                "pagingType": 'numbers',
                "lengthChange": false, //"mostrar X registros" 
                "language":{
                    "url":"https://cdn.datatables.net/plug-ins/2.0.3/i18n/es-ES.json"
                }
            }
        );
    } );
</script>

<?php endforeach;?>

<!-- tabla de la sección de citas -->

<div class="modal fade" id="citaNueva" tabindex="-1" aria-labelledby="editMedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pacModalLabel text-danger">CEDOCABAR</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>                
            </div>
            <div class="modal-body">
                <div class="row">
                        <div class="col-lg">
                            <div class="form-group">
                                <form class="row center" method="post">
                                    <div class="variable slider">
                                        <div>
                                            <!-- cuadro para seleccionar la cita -->
                                            <h3 class="d-flex justify-content-center">¿De qué es su cita?</h3>
                                            <div class="form-row col-md">
                                                <?php include "conectarBD.php"; 
                                                    $query = $conn->prepare("SELECT atiende FROM medicos GROUP BY atiende");
                                                    $query->execute();
                                                    $results = $query->fetchAll(PDO::FETCH_ASSOC);
                                                ?>
                                                <div class="form-group d-flex mt-3 justify-content-center">
                                                    <select name="especialidadesCita" id="opcionesCita" class="form-select w-50">
                                                        <option selected disabled hidden>Seleccione opción...</option>
                                                    <?php foreach ($results as $fila):?>
                                                        <option value="<?php echo $fila['atiende'];?>"><?php echo $fila['atiende'];?></option>
                                                    <?php endforeach; ?>
                                                    </select>                       
                                                </div>
                                            </div>
                                            <!-- generación de las tablas  -->
                                            <?php foreach ($results as $fila):?>
                                                <div class="tabla-medicos mt-4" style="display:none">
                                                    <h4 class="d-flex justify-content-center d-none"><?= $fila['atiende']?></h4>
                                                    <table id="myTable<?php echo str_replace(' ', '', $fila['atiende']); ?>" class="display w-100">
                                                        <thead>
                                                        <tr>
                                                            <th>Nombre</th>
                                                            <th>Apellido</th>
                                                            <th>Cedula</th>
                                                            <th>Selección</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        // Aquí debes hacer otra consulta para obtener los datos de los médicos asociados a la especialidad
                                                        $queryMedicos = $conn->prepare("SELECT * FROM medicos WHERE atiende = :atiende");
                                                        $queryMedicos->bindParam(':atiende', $fila['atiende']);
                                                        $queryMedicos->execute();
                                                        $resultsMedicos = $queryMedicos->fetchAll(PDO::FETCH_ASSOC);
                                                        foreach ($resultsMedicos as $medico):?>
                                                            <tr>
                                                                <td><?= $medico['nombre'] ?></td>
                                                                <td><?= $medico['apellido'] ?></td>
                                                                <td><?= $medico['cedula'] ?></td>
                                                                <td>
                                                                    <button type="button" class="btn" style="color: green">
                                                                        <i class="bi bi-check-circle"></i>
                                                                    </button>
                                                                    <button type="button" class="btn" style="color: red">
                                                                        <i class="bi bi-x-circle"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach;?>
                                                        </tbody>
                                                    </table>                                     
                                                </div>
                                            <?php endforeach;?>
                                            <div class="d-flex justify-content-center mt-2">
                                                <button type="submit" name="editar" class="btn bg-c-blue w-25 text-dark mt-2" id="aceptar" name="regMedico" style="display:none">Aceptar</button>        
                                            </div>         
                                        </div>
                                        <div>
                                            a
                                        </div>
                                        <div>
                                            your content3
                                        </div>
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

<script>

const select = document.querySelector('select');
const tablasMedicos = document.querySelectorAll('.tabla-medicos');
const botonAceptar = document.querySelector('#aceptar');


select.addEventListener('change', () => {

  // obtener la opción seleccionada del select
  const selectedOption = select.options[select.selectedIndex];

  // obtener el texto de la opción seleccionada
  const selectedText = selectedOption.textContent.trim();

  //recorrer todos los elementos de tabla-medicos
  tablasMedicos.forEach((tablaDeEspecialidad) => {
    const h4 = tablaDeEspecialidad.querySelector('h4');
    // confirmar si el h4 coincide con el texto del select, para hacer el filtro
    if (h4.textContent === selectedText) {
      // si coincide se muestra
      tablaDeEspecialidad.style.display = '';
      botonAceptar.style.display = '';
    } 
    else {
      // sino, pues no!
      tablaDeEspecialidad.style.display = 'none';
    }
  });
});
</script>
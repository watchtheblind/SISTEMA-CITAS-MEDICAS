
<div class="modal fade" id="verMedicos-<?php echo str_replace(' ', '', $fila['atiende']); ?>-modal" tabindex="-1" aria-labelledby="verMedicosLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pacModalLabel text-danger">CEDOCABAR (<?=$fila['atiende']?>)</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg">
            <div class="form-group">
              <table id="myTable<?php echo str_replace(' ', '', $fila['atiende']); ?>" class="display">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Telefono</th>
                    <th>Cedula</th>
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
                      <td><?= $medico['telf'] ?></td>
                      <td><?= $medico['cedula'] ?></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

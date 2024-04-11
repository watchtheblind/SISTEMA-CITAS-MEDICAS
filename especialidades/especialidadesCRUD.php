
<?php
    function leerDatos() {
        include "conectarBD.php";
        // $query = $conn->query("SELECT especialidad FROM especialidades");
        $query = $conn->prepare("SELECT atiende, nombre, apellido, COUNT(*) as num_doctors FROM medicos GROUP BY atiende");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $fila):?>
            <tr class="mt-4">
                <td>
                    <?= $fila['atiende']?>
                </td>
                <td>
                    <form action='especialidades/especialidadesCRUD.php' method='post'>
                        <div class='d-flex justify-content-start'>
                            <input  type="hidden" name='espe' value=<?=$fila['atiende']?> >
                            <button type='submit' name='eliminar' class='btn btn-danger'>Borrar</button>  
                            <button type='button' name='edit' data-bs-toggle='modal' data-bs-target='#editEspecialidadModal-<?=$fila['atiende']?>' class='btn btn-primary' data-especialidad="<?= $fila['atiende'] ?>">Editar</button>
                        </div>
                        <?php require "especialidades/modales/editEspecialidad.php" ?>
                        <?php require "especialidades/modales/verMedicos.php" ?>
                    </form>
                </td>
                <td>
                    <div class="d-flex justify-content-between">
                        <p class>Médicos disponibles: <?=$fila['num_doctors']?></p>    
                        <button type='button' data-bs-toggle='modal' data-bs-target='#verMedicos-<?= $fila['atiende']?>-modal' class='btn btn-warning'>Ver médicos</button>
                    </div>
                </td>
            </tr>
        <?php endforeach;?>
        
        <?php
        
        }
    function borrarDatos(){
        include "../conectarBD.php";
        $especialidad = $_POST["especialidad"];
        $stmt = $conn->prepare("DELETE FROM especialidades WHERE especialidad = :especialidad");
        $stmt->bindParam(':especialidad', $especialidad);
        $stmt->execute();
        $afectado = $stmt->rowCount();
        if($afectado ==1){
            header('Location: ../panelUsuario.php?shSuccMsg=2');
            exit;
        }
    }
    function editarDatos(){
        include "../conectarBD.php";
        $especialidad = $_POST["especialidad"];
        $nuevaespecialidad = 
        $stmt = $conn->prepare("UPDATE especialidades SET especialidad = :new_especialidad WHERE especialidad = :especialidad");
        $stmt->bindParam(':new_especialidad', $new_especialidad);
        $stmt->bindParam(':especialidad', $especialidad);
        $stmt->execute();
        $afectado = $stmt->rowCount();
        if($afectado ==1){
            header('Location: ../panelUsuario.php?shSuccMsg=3');
            exit;
        }
    }

    if (isset($_POST["eliminar"])) {
        borrarDatos();
    }
    else if (isset($_POST["editar"])){
        editarDatos();
    }
?>

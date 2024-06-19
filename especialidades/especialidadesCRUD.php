
<?php
    function crearEspecialidad(){
        include "../conectarBD.php";
        $especialidad = $_POST["EspecNueva"];
        $stmt = $conn->prepare("INSERT INTO medicos (atiende) VALUES (:especialidad)");
        $stmt->bindParam(':especialidad', $especialidad);
        $stmt->execute();
        $afectado = $stmt->rowCount();
        if($afectado > 0){
            header('Location: ../especialidades.php?shSuccMsg=1');
            exit;
        }
    }
    function leerDatos() {
        include "conectarBD.php";
        // $query = $conn->query("SELECT especialidad FROM especialidades");
        $query = $conn->prepare("SELECT atiende, nombre, apellido, COUNT(*) as num_doctors FROM medicos GROUP BY atiende");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $fila):?>
            <tr class="mt-4">
                <td>
                    <?= $fila['atiende']; ?>
                </td>
                <td>
                    <form action='especialidades/especialidadesCRUD.php' method='post'>
                        <div class='d-flex justify-content-start'>
                            <input type="hidden" name="especialidad" value="<?= $fila['atiende']; ?>">
                            <button type='submit' name='eliminar' class='btn btn-danger mx-1'><i class="bi bi-trash"></i></button>  
                            <button type='button' name='edit' data-bs-toggle='modal' data-bs-target='#editEspecialidadModal-<?php echo str_replace(' ', '', $fila['atiende']); ?>' class='btn btn-primary' data-especialidad="<?= $fila['atiende'] ?>"><i class="bi bi-pen"></i></button>
                        </div>
                        <?php require "especialidades/modales/editEspecialidad.php" ?>
                        <?php require "especialidades/modales/verMedicos.php" ?>
                    </form>
                </td>
                <td>
                    <div class="d-flex justify-content-between">
                        <p class>Médicos disponibles: <?=$fila['num_doctors']?></p>    
                        <button type='button' data-bs-toggle='modal' data-bs-target='#verMedicos-<?php echo str_replace(' ', '', $fila['atiende']); ?>-modal' class='btn btn-warning'>Ver médicos</button>
                    </div>
                </td>
            </tr>
        <?php endforeach;
    }
    function borrarDatos(){
        include "../conectarBD.php";
        $especialidad = $_POST["especialidad"];
        $stmt = $conn->prepare("DELETE FROM medicos WHERE atiende = :especialidad");
        $stmt->bindParam(':especialidad', $especialidad);
        $stmt->execute();
        $afectado = $stmt->rowCount();
        echo "<script>alert(".$afectado.")</script>";
        if($afectado > 0){
            header('Location: ../especialidades.php?shSuccMsg=2');
            exit;
        }
    }
    function editarDatos(){
        include "../conectarBD.php";
        $especialidad = $_POST["especialidad"];
        $nuevaespecialidad = $_POST["nuevaEspecialidad"];
        $stmt = $conn->prepare("UPDATE medicos SET atiende = :nueva_especialidad WHERE atiende = :especialidad");
        $stmt->bindParam(':nueva_especialidad', $nuevaespecialidad);
        $stmt->bindParam(':especialidad', $especialidad);
        $stmt->execute();
        $afectado = $stmt->rowCount();
        if($afectado > 0){
            header('Location: ../especialidades.php?shSuccMsg=3');
            exit;
        }
    }

    if (isset($_POST["eliminar"])) {
        borrarDatos();
    }
    else if (isset($_POST["crearEspecialidad"])){
        crearEspecialidad();
    }
    else if (isset($_POST["editar"])){
        editarDatos();
    }
?>

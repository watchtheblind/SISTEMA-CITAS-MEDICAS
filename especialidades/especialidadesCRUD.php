<?php
    function leerDatos() {
        include "conectarBD.php";
        $query = $conn->query("SELECT especialidad FROM especialidades");
        foreach ($query as $fila): ?>
            <tr class="mt-4">
                <td>
                    <?= $fila['especialidad'] ?>
                </td>
                <td>
                    <form action='especialidades/especialidadesCRUD.php' method='post'>
                        <div class='d-flex justify-content-center'>
                            <input type='hidden' name='especialidad' value=<?=$fila['especialidad']?>>
                            <button type='submit' name='eliminar' class='btn btn-danger'>Borrar</button>  
                            <button type='button' name='edit' data-bs-toggle='modal' data-bs-target='#editEspecialidadModal-<?=$fila['especialidad']?>' class='btn btn-primary'>Editar</button>
                        </div>
                        <?php require "modales/editEspecialidad.php" ?>
                </td>
            </tr>
        <?php endforeach;
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

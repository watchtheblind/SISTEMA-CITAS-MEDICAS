<?php
    function leerDatos(){
        include "conectarBD.php";
        $query = $conn->query("SELECT * FROM medicos");
        foreach ($query as $fila){
            echo '<tr class="mt-4">';
                echo '<td>'.$fila['cedula']."</td>";
                echo "<td>".$fila['nombre']."</td>";
                echo "<td>".$fila['apellido']."</td>";
                echo "<td>".$fila['telf']."</td>";
                echo "<td>".$fila['especialidad']."</td>";
                echo "<td>".$fila['cargo']."</td>";
                // este input permite que se obtenga el valor cedula de cada fila BORRALE EL DFLEX LUIS
                echo "<td class='d-flex align-middle justify-content-center'> 
                    <form action='medicos/funcionesCRUD.php' method='post'>
                        <input type='hidden' name='cedula'  value='".$fila['cedula']."'>
                        <button type='submit' name='eliminar' class='btn btn-danger'>Borrar</button>  
                        <button type='button' name='edit' data-bs-toggle='modal' data-bs-target='#editMedModal' class='btn btn-primary'>Editar</button>";                        
                        include "modales/editMedico.php";
                echo"</form>
                    </td>";
            echo "</tr>";
        }
    }

    function borrarDatos(){
        include "../conectarBD.php";
        $cedula = $_POST["cedula"];
        $stmt = $conn->prepare("DELETE FROM medicos WHERE cedula = :cedula");
        $stmt->bindParam(':cedula', $cedula);
        $stmt->execute();
        $afectado = $stmt->rowCount();
        if($afectado ==1){
            header('Location: ../panelUsuario.php?shSuccMsg=2');
            exit;
        }
    }

    function editarDatos(){
        $MedTelefono = $_POST['medTel'];
        $MedCargo = $_POST['medCargo'];
        $MedEspecialidad = $_POST['medEspec'];
        $cedula = $_POST["cedula"];
        include "../conectarBD.php";
        $stmt = $conn->prepare("UPDATE medicos SET telf=:telefono, cargo=:cargo, especialidad=:especialidad WHERE cedula = :cedula");
        $stmt->bindParam(':cedula', $cedula);
        $stmt->bindParam(':telefono', $MedTelefono);
        $stmt->bindParam(':cargo', $MedCargo);
        $stmt->bindParam(':especialidad', $MedEspecialidad);

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

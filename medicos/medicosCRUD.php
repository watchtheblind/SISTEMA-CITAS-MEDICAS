<?php
    function leerDatos(){
        include "conectarBD.php";
        $query = $conn->query("SELECT * FROM medicos ");
        foreach ($query as $fila){
            echo '<tr class="mt-4">';
                echo '<td>'.$fila['cedula']."</td>";
                echo "<td>".$fila['nombre']."</td>";
                echo "<td>".$fila['apellido']."</td>";
                echo "<td>".$fila['telf']."</td>";
                echo "<td>".$fila['especialidad']."</td>";
                echo "<td>".$fila['cargo']."</td>";
                echo "<td>".$fila['atiende']."</td>";
                // este input permite que se obtenga el valor cedula de cada fila BORRALE EL DFLEX LUIS
                echo "<td class='d-flex align-items-center justify-content-center'> 
                    <form action='medicos/medicosCRUD.php' method='post'>
                        <div class='d-flex'>
                        <input type='hidden' name='cedula'  value='".$fila['cedula']."'>
                        <button type='submit' name='eliminar' class='btn btn-danger mx-1'><i class='bi bi-trash'></i></button>  
                        <button type='button' name='edit' data-bs-toggle='modal' data-bs-target='#editMedModal-".$fila['cedula']."' class='btn btn-primary'><i class='bi bi-pen'></i></button>
                        </div>";
                    require "modales/editTelefono.php";
                    
                    echo "<td>
                        <form action='medicos/medicosCRUD.php' method='post'>
                            <div class='d-flex justify-content-around'>
                            <input type='hidden' name='cedula'  value='".$fila['cedula']."'>
                            ".$fila['cantidad_pacientes']."
                            <button type='button' name='edit' data-bs-toggle='modal' data-bs-target='#editCantModal-".$fila['cedula']."' class='btn btn-primary'><i class='bi bi-pen'></i></button>
                            </div>";
                        require "modales/editCantidad.php";
                        echo "
                        </form>
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

    function editarDatosTelefono(){
        $MedTelefono = $_POST['medTel'];
        $cedula = $_POST["cedula"];
        include "../conectarBD.php";
        $stmt = $conn->prepare("UPDATE medicos SET telf = :telefono WHERE cedula = :cedula");
        $stmt->bindParam(':cedula', $cedula);
        $stmt->bindParam(':telefono', $MedTelefono);
        $stmt->execute();
        $afectado = $stmt->rowCount();
        if($afectado ==1){
            header('Location: ../panelUsuario.php?shSuccMsg=3');
            exit;
        }
    }
    function editarDatosCantidad(){
        $MedCantidad = $_POST['medCantidad'];
        $cedula = $_POST["cedula"];
        include "../conectarBD.php";
        $stmt = $conn->prepare("UPDATE medicos SET cantidad_pacientes = :cantidad WHERE cedula = :cedula");
        $stmt->bindParam(':cedula', $cedula);
        $stmt->bindParam(':cantidad', $MedCantidad);
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
        editarDatosTelefono();
    }
    else if (isset($_POST["editarCantidad"])){
        editarDatosCantidad();
    }
?>

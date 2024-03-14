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
                echo "<td> 
                    <form action='medicos/funcionesCRUD.php' method='post'>
                        <input type='hidden' name='cedula'  value='".$fila['cedula']."'>
                        <input type='hidden' name='nombre' value='".$fila['nombre']."'>
                        <button type='submit' name='eliminar' class='btn btn-danger'>Borrar</button> 
                        <button type='button' class='btn btn-primary'>Editar</button> 
                    </form>
                    </td>";
            echo "</tr>";
        }
    }

    function borrarDatos(){
        include "../conectarBD.php";
        if (isset($_POST["eliminar"])){
            $cedula = $_POST["cedula"];
            $nombre = $_POST["nombre"];
            $stmt = $conn->prepare("DELETE FROM medicos WHERE cedula = :cedula");
            $stmt->bindParam(':cedula', $cedula);
            $stmt->execute();
            $afectado = $stmt->rowCount();
            if($afectado ==1){
                header('Location: ../panelUsuario.php?shSuccMsg=2');
                exit;
            }
            else{
                echo "
                <script>alert('el medico [$nombre] no se ha eliminado.'); location.href=../panelUsuario.php;</script>
                ";
            }
        }
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        borrarDatos();
    }
    

?>
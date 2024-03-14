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
                    <button type='button' class='btn btn-primary'>Editar</button> 
                    <form action="">
                        <button type='button' class='btn btn-danger'>Borrar</button> 
                    </form>
                    </td>";
            echo "</tr>";
        }
    }

?>
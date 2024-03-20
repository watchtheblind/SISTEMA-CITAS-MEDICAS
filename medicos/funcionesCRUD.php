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
                        echo '
                        <div class="modal fade try" id="editMedModal" tabindex="-1" aria-labelledby="editMedModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="pacModalLabel text-danger">CEDOCABAR</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>                
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <form class="row center" action="medicos/funcionesCRUD.php" method="post">
                                                            <h3 class="d-flex justify-content-center">Editar Médico</h3>
                                                            <div class="form-row col-md-12 mt-4">
                                                                <div class="form-group">
                                                                    <label for="inputTelefono">Telefono</label>
                                                                    <input required type="number" onkeydown="return event.keyCode !== 69" name="medTel" class="form-control" id="inputTel" placeholder="EJ: 04243552206">
                                                                </div>
                                                            </div>
                                                            <div class="editMed"><label></label></div>
                                                            <div class="d-flex justify-content-center">
                                                                <button type="submit" name="editar" class="btn bg-c-blue w-75 text-dark mt-3" id="aceptar" name="regMedico">Aceptar</button>
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
                        ';
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

<?php 
include "conectarBD.php";
session_start(); 
//consulta para obtener los datos de los médicos
require "verificarUsuario.php"; 
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibos de Pago</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="shortcut icon" href="./assets/compiled/png/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./assets/compiled/css/app.css">
    <link rel="stylesheet" href="./assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="./assets/compiled/css/iconly.css">
    <link rel="stylesheet" href="./assets/compiled/css/estilo.css">
    <link rel="stylesheet" type="text/css" href="assets/css/sweetalert2.css">
    <link rel="stylesheet" href="./assets/compiled/css/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
</head>
<script>
    $(document).ready( function () {
    $('#myTable').DataTable(
                {
            "language":{
                "url":"https://cdn.datatables.net/plug-ins/2.0.3/i18n/es-ES.json"
            }
        }
    );
} );
</script>
<script>
    import Swal from 'sweetalert2';
</script>
<body>
    <?php include "alertas.php"?>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo" class="text-center">
                            <h2 class="text-danger">CEDOCABAR</h2>
                            <div class="theme-toggle d-flex gap-2  align-items-center mt-2 text-end">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20"
                                    height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                                    <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                                            opacity=".3"></path>
                                        <g transform="translate(-210 -1)">
                                            <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                            <circle cx="220.5" cy="11.5" r="4"></circle>
                                            <path
                                                d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                                <div class="form-check form-switch fs-6">
                                    <input class="form-check-input  me-0" type="checkbox" id="toggle-dark"
                                        style="cursor: pointer">
                                    <label class="form-check-label"></label>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20"
                                    preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                                    </path>
                                </svg>
                            </div>

                        </div>

                        <div class="sidebar-toggler  x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>
                        <?php if ($result['perfil'] == 1): ?>
                            <li class="sidebar-item active ">
                            <a href="index.html" class="sidebar-link bg-c-blue">
                                <i class="bi bi-grid-fill"></i>
                                <span>Médicos</span>
                            </a>
                            </li>
                            <li class="sidebar-item op1">
                            <a href="#" class="sidebar-link"  data-bs-toggle="modal" data-bs-target="#pacModal">
                                <i class="bi bi-file-earmark-medical-fill"></i>
                                <span>Ingresar paciente</span>
                            </a>
                            </li>
                            <li class="sidebar-item  op1">
                                <a href="#" class="sidebar-link" data-bs-toggle="modal" data-bs-target="#medModal">
                                    <i class="bi bi-file-earmark-medical-fill"></i>
                                    <span>Registrar médico</span>
                                </a>
                            </li>';
                            <li class="sidebar-item  op1">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-file-earmark-medical-fill"></i>
                                    <span>ARC</span>
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="sidebar-item">
                            <a href="panelUsuario.php" class="sidebar-link">
                                <i class="bi bi-grid-fill"></i>
                                <span>Control de citas</span>
                            </a>
                            </li>
                            <li class="sidebar-item op1">
                            <a href="#" class="sidebar-link"  data-bs-toggle="modal" data-bs-target="#pacModal">
                                <i class="bi bi-file-earmark-medical-fill"></i>
                                <span>Pacientes</span>
                            </a>
                            </li>
                            <li class="sidebar-item  op1">
                                <a href="#" class="sidebar-link" data-bs-toggle="modal" data-bs-target="#medModal">
                                    <i class="bi bi-file-earmark-medical-fill"></i>
                                    <span>Consultar citas</span>
                                </a>
                            </li>
                            <li class="sidebar-item  op1 active">
                                <a href="#" class='sidebar-link bg-c-blue'>
                                    <i class="bi bi-file-earmark-medical-fill"></i>
                                    <span>Especialidades</span>
                                </a>
                            </li>
                        <?php endif ?>
                        <li class="sidebar-item  ">
                            <a href="#" class='sidebar-link' data-bs-toggle="modal" data-bs-target="#pacModal2">
                                <i class="bi bi-file-earmark-medical-fill"></i>
                                <span>Cambiar Contraseña</span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="cerrarSesion.php" class='sidebar-link text-danger '>
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Cerrar Sesion</span>
                            </a>
                        </li>


                    </ul>
                </div>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <img src="assets/compiled/svg/recibo2.png" alt="" width="100%">
            </div>
            <div>
                <div class="card order-card">
                    <div class="card-block p-2">
                        <h4 class="d-flex justify-content-center mb-10">
                            PROGRAMA DE CONTROL DE CITAS MÉDICAS CEDOCABAR
                        </h4>
                        <h4 >
                           <?php 
                            if (isset($_SESSION['user'])) {
                                $nombreUsuario = $_SESSION['user'];
                                echo "¡Bienvenido, $nombreUsuario!";
                            } else {
                                // Redirige al usuario a la página de inicio de sesión si no ha iniciado sesión
                                echo "error";
                                exit;
                            }
                           ?>
                        </h4>
                        <h4 class="mt-0 ">
                             PERFIL: 
                             <?php 
                                if ($result['perfil'] == 1) {
                                    echo "Administrador";
                                } else {
                                    echo "Usuario";
                                }
                             ?>
                        </h4>
                        <h6 id="cedula" style="display: none;">                        
                        </h6>
                    </div>
                </div>
            </div>
            <div class="page-content">
                <section class="row" id="opciones">
                    <div class="col-12 col-lg-12">
                        <?php "verificarUsuario.php"; if($result['perfil'] == 1): ?>
                        <div class="row">
                            <div class="col-md-6 col-lg-4">
                                <div class="card bg-c-blue order-card">
                                    <div class="card-block p-5">
                                        <h6 class="text-center"><i class=""></i>
                                        <span class="text-white text-center">xxxx</span>
                                    </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="card bg-c-green order-card">
                                    <div class="card-block p-5">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#medModal">
                                            <h6 class="text-center text-white"><i class=""></i><span>Registrar Médico</span></h6>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="card bg-c-yellow order-card">
                                    <div class="card-block p-5">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#pacModal">
                                            <h6 class="text-center text-white"><i class=""></i><span>Ingresar Paciente</span></h6>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php "verificarUsuario.php"; if($result['perfil'] == 0): ?>
                        <div class="row">
                            <div class="col-md-6 col-lg-4">
                                <div class="card bg-c-blue order-card">
                                    <div class="card-block p-5">
                                        <h6 class="text-center"><i class=""></i>
                                        <span class="text-white text-center">Pacientes registrados</span>
                                    </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="card bg-c-green order-card">
                                    <div class="card-block p-5">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#medModal">
                                            <h6 class="text-center text-white"><i class=""></i><span>Citas para hoy: X</span></h6>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="card bg-c-yellow order-card">
                                    <div class="card-block p-5">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#pacModal">
                                            <h6 class="text-center text-white"><i class=""></i><span>Citas por atender: Y</span></h6>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </section>
            </div>
            <?php if($result['perfil'] == 1): include_once "medicos/tablamedicos.php";?><?php endif;?>
            <div class="container d-flex justify-content-start mb-3">
                <button class="btn btn-success " data-bs-toggle="modal" data-bs-target="#modalEspecialidad">Crear Especialidad</button>
            </div>
            <div>
            <table id="myTable" class=" w-75 display text-center">
                <thead class="thead-light">
                    <tr class="text-center">
                        <th scope="col">Especialidad</th>
                        <th scope="col">Acciones</th>
                        <th scope="col">Médicos en Atención</th>
                    </tr>
                </thead>
            <tbody>
                <?php include "especialidades/especialidadesCRUD.php";
                    leerDatos();
                ?>
            </tbody>
        </table>
            </div>
        </div>
    </div>

    <!-- modal de especialidad nueva  -->
    <div class="modal fade" id="modalEspecialidad" tabindex="-1" aria-labelledby="editMedModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pacModalLabel text-danger">CEDOCABAR</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>                
                </div>
                <div class="modal-body">
                    <div class="row">
                            <div class="col-lg">
                                <div class="form-group">
                                    <form class="row center" action="medicos/funcionesCRUD.php" method="post">
                                        <h3 class="d-flex justify-content-center">Nueva Especialidad</h3>
                                        <div class="form-row col-md">
                                            <div class="form-group">
                                                <input type="text" name="EspecNueva" class="form-control" placeholder="EJ: Traumatología">
                                            </div>
                                        </div>
                                        <div class=" d-flex justify-content-center">
                                            <button type="submit" name="editar" class="btn bg-c-blue w-75 text-dark mt-2" id="aceptar" name="regMedico">Aceptar</button>        
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


    <!-- script para mostrar especialidades-->
    <script>
        const especialidades = ['Medicina interna','Cardiología','endocrinología','fisiatría','nefrología','nutrición','psicología'];
        const select2 = document.getElementById('especialidades');
        for (let i = 0; i < especialidades.length; i++) {
            const option2 = document.createElement('option');
            option2.value = especialidades[i];
            option2.textContent = especialidades[i];
            select2.appendChild(option2);
        }
    </script>
    <script src="assets/static/js/components/dark.js"></script>
    <script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/compiled/js/app.js"></script>
    <script src="assets/js/buscador.js"></script>
    <!-- Need: Apexcharts -->
    <script src="assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="assets/static/js/pages/dashboard.js"></script>
    <script src="assets/js/sweetalert2.all.min.js"></script>
</body>



</html>
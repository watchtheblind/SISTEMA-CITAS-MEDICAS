<?php include "conectarBD.php"; session_start(); 
//consulta para obtener los datos de los médicos
require "verificarUsuario.php"; ?>

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
        <!-- librería slick -->
        <link rel="stylesheet" href="./assets/slick.css">
        <link rel="stylesheet" href="./assets/slick-theme.css">
        <!-- jquery -->
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-migrate-3.4.1.js"></script>
        <!-- librería datatables -->
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />
        <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    </head>
    <body>
            <!-- alertas con sweetalert2 -->
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
                            <?php else: ?>
                                <li class="sidebar-item active ">
                                    <a href="index.html" class="sidebar-link bg-c-blue">
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
                                <li class="sidebar-item  op1">
                                    <a href="especialidades.php" class='sidebar-link'>
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
                            <!-- mostrando el nombre de usuario -->
                            <?php if  (isset($_SESSION['user'])): $nombreUsuario = $_SESSION['user'];?>
                            <h4  class="mt-0 ">
                            ¡Bienvenido, <?=$nombreUsuario?>! <br><br>
                            <?php endif; ?>
                            <!-- mostrando si es admin o usuario -->
                            PERFIL: <?php $statusPerfil =($result['perfil'] == 1) ? "administrador": "usuario"; echo $statusPerfil?>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="page-content">
                    <section class="row" id="opciones">
                        <div class="col-12 col-lg-12">
                            <!-- solo se muestra para admin -->
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
                            <!-- solo se muestra para usuarios comunes -->
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
                <!-- mostramos los médicos existentes si se está como administrador -->
                <?php if($result['perfil'] == 1): include_once "medicos/tablamedicos.php";?><?php endif;?>
                <!-- módulo de citas para perfil de usuario: -->
                <?php if($result['perfil'] == 0): ?>
                    <div class="container d-flex justify-content-start mb-3">
                        <button class="btn btn-success " data-bs-toggle="modal" data-bs-target="#citaNueva">Cita Nueva</button>
                    </div>
                    <?php require "citas/modales/citaNuevaModal.php" ?>
                <?php endif;?>
            </div>
        </div>
        <!-- Modal de pacientes-->
        <?php require "modalesPanelUsuario/registrarPacientes.php" ?>
        <!-- Modal de cambio de contraseña-->
        <?php require "modalesPanelUsuario/cambioContrasena.php" ?>
        <script>
            const estados = ['Aragua', 'Distrito Capital','Carabobo','Sucre','Amazonas','Anzoátegui','Apure','Barinas','Bolívar','Cojedes',
            'Delta Amacuro','Falcón','Guárico','Lara','Mérida','Miranda','Monagas','Nueva Esparta','Portuguesa',
            'Táchira','Trujillo','La Guaira','Yaracuy','Zulia'];
            const select = document.getElementById('estados');
            for (let i = 0; i < estados.length; i++) {
                const option = document.createElement('option');
                option.value = estados[i];
                option.textContent = estados[i];
                select.appendChild(option);
            }
        </script>
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
        <script src="assets/js/bloquearTeclaEnter.js"></script>
        <!-- Need: Apexcharts -->
        <script src="assets/extensions/apexcharts/apexcharts.min.js"></script>
        <script src="assets/slick.js"></script>
        <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script> -->
        <script src="assets/static/js/pages/dashboard.js"></script>
        <script src="assets/js/sweetalert2.all.min.js"></script>
    </body>
</html>
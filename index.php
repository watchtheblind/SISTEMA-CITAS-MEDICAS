<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibos de Pago</title>
    
    
    
    <link rel="shortcut icon" href="./assets/compiled/png/logo.png" type="image/x-icon">

  <link rel="stylesheet" href="./assets/compiled/css/app.css">
  <link rel="stylesheet" href="./assets/compiled/css/app-dark.css">
  <link rel="stylesheet" href="./assets/compiled/css/auth.css">
  <link rel="stylesheet" type="text/css" href="assets/css/sweetalert2.css">
  <link rel="stylesheet" href="./assets/compiled/css/estilo.css">
</head>

<body>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="auth">
        
<div class="row h-100 bg-primary-subtle">
    <div class="col-lg-5 col-12">
        <div id="auth-left">
            <div class="">
                <!--   <a href="index.html"><img src="./assets/compiled/png/logo2.png" alt="Logo" width=""></a>-->
            </div>
            <h1 class="auth-title">Iniciar Sesión</h1>
            <p class="auth-subtitle mb-5"><b>Inicie sesión con los datos que ingresó durante el registro.</b></p>

            <form action="ingreso.php" method="POST">
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" class="form-control form-control-xl" placeholder="Nombre de Usuario" name="txt_uname" id="txt_uname">
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" class="form-control form-control-xl" placeholder="Contraseña" name="txt_pwd" id="txt_pwd">
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>
                <div class="form-check form-check-lg d-flex align-items-end">
                    <!--  <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label text-gray-600" for="flexCheckDefault">
                        Keep me logged in
                    </label>-->
                </div>
                <button type="submit" class="btn bg-c-blue btn-block btn-lg shadow-lg mt-5 text-dark" name="but_submit">Entrar</button>
                
            </form>
            <div class="text-center mt-5 text-lg fs-4">
               <!--  <p class="text-gray-600">Don't have an account? <a href="auth-register.html" class="font-bold">Sign
                        up</a>.</p>
                <p><a class="font-bold" href="auth-forgot-password.html">Forgot password?</a>.</p>-->
            </div>
        </div>
    </div>
    <div class="col-lg-7 bg-c-blue">
         <div class="row text-center justify-content-center align-items-center vh-100">
            <div id="" class="" id="auth-right">
                <img src="./assets/compiled/png/logo2.png" alt="Logo" width="50%">
            </div>
        </div>
       
    </div>
</div>

    </div>

    <script src="assets/js/jquery.js"></script>
<script src="assets/js/jquery.mask.js"></script>
<script src="assets/js/sweetalert2.all.min.js"></script>
<script src="app/app.js"></script>
</body>
 
</body>

</html>
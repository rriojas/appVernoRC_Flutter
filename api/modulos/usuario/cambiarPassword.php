<?php
?>
<!doctype html>
<html lang="es" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Verano de la Ciencia de la Región Centro</title>
    <link href="../../css/bootstrap.css" rel="stylesheet" />


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="../../css/starter-template.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/all.min.css">
    <link rel="stylesheet" href="../../css/bootstrap-datepicker.min.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
          <a class="navbar-brand" href="javascript:;">
            <img src="../../img/logo_navbar.png" onerror='this.src="../../img/no-image.png"' width="32" height="auto" alt="">
            Verano de la Ciencia de la Región Centro - <?php echo $modulo; ?>
          </a>
          <div class="d-flex">
            <a href="../../inicio.php" id="btnCerrarSesion" class="btn btn-primary mr-2">Inicio</a>&nbsp;
            <a href="../usuario/cambiarPassword.php" id="" class="btn btn-info mr-2">Cambiar Password</a>&nbsp;
            <a href="javascript:application.CerrarSesion();" id="btnCerrarSesion" class="btn btn-danger">Cerrar sesion</a>
          </div>      
      </div>
    </nav>

<main role="main" id="divPrincipal" class="container pt-2 mb-2">
    <h3>Cambio de password</h3>
    <form>
        <div class="mb-3">
            <label for="txtPassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="txtPassword" aria-describedby="PasswordHelp">
        </div>
        <div class="mb-3">
            <label for="txtConfirmaPassword" class="form-label">Confirma Password</label>
            <input type="password" class="form-control" id="txtConfirmaPassword">
        </div>
        <div class="text-end">
            <button id="btnAceptar" type="button" class="btn btn-primary">Aceptar</button>
        </div>
    </form>
</main><!-- /.container -->
<script src="../../js/jquery.min.js"></script>
<script src="../../js/bootstrap.bundle.min.js"></script>
<script src="../../js/bootstrap-datepicker.min.js"></script>
<script src="../../js/bootstrap-datepicker.es.min.js"></script>
<script src="../../js/application.js"></script>
<script src="../../js/catalog.js"></script>
<script src="../../js/mensaje.js"></script>
<script src="cambiarPassword.js"></script>
</body>
</html>
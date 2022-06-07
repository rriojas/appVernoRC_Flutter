
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="vagv">
    <title>Verano</title>    

    <!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet" />
<meta name="theme-color" content="#7952b3" />
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form id="frmLogin">
    <img class="mb-4" src="img/logo_navbar.png" alt="" width="100%" height="100%">
    <h1 class="h3 mb-3 fw-normal">Ingresar</h1>

    <div class="form-floating">
      <input type="email" class="form-control" id="txtCorreo" name="correo" placeholder="nombre@servidor.com">
      <label for="txtCorreo">Correo/Usuario</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="txtPassword" name="password" placeholder="Password">
      <label for="txtPassword">Clave</label>
    </div>
    <button id="btnAceptar" class="w-100 btn btn-lg btn-primary" type="button">Aceptar</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2022</p>
  </form>
</main>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/bootstrap-datepicker.min.js"></script>
<script src="js/bootstrap-datepicker.es.min.js"></script>
<script src="js/application.js"></script>
<script src="js/catalog.js"></script>
<script src="js/mensaje.js"></script>
<script src="login.js"></script>
  </body>
</html>

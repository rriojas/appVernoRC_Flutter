<?php header('Content-Type: text/html; charset=UTF-8');?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Verano de la Ciencia de la Región Centro</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/pricing/">

    <!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet" />
<meta name="theme-color" content="#7952b3">


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
    <link href="css/pricing.css" rel="stylesheet">
  </head>
  <body>

<div class="container py-3">
  <header>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top mb-3">
      <div class="container-fluid">
          <a class="navbar-brand" href="javascript:;">
            <img src="img/logo_navbar.png" onerror='this.src="img/no-image.png"' width="32" height="auto" alt="">
            Verano de la Ciencia de la Región Centro
          </a>
          <div class="d-flex">
          <a href="login.php" id="btnCerrarSesion" class="btn btn-primary float-start mr-2">Iniciar Sesion</a>
          </div>      
      </div>
    </nav>

    <div class="pricing-header p-3 pb-md-4 mx-auto text-center mt-5">
      <h1 class="display-4 fw-normal">Bienvenido</h1>
      <p class="fs-5 text-muted">al sitio web del verano de la ciencia de la Región Centro.</p> <p class="fs-5 text-muted">Para comenzar elige tu categoria</p>
    </div>
  </header>

  <main>
    <div class="row row-cols-1 row-cols-md-2 mb-3 text-center">
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Soy Alumno</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">Requisitos</h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>Ser estudiante activo</li>
              <li>Tener al menos el 50% de la carrera cursada</li>
              <li>Promedio mínimo de 80</li>
              <li>Disponibilidad de horario</li>
            </ul>
            <!--a type="button" href="registroalumno.php" style="pointer-events: none;" class="w-100 btn btn-lg btn-outline-primary" disabled >Registrarme</a>
             <a type="button" href="registroalumno.php"  class="w-100 btn btn-lg btn-outline-primary"  >Registrarme</a-->
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Soy Investigador</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">Requisitos</h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>Ser Investigador activo</li>
              <li>Nivel de SNI y/o</li>
              <li>Estar adscrito al PRODEP y/o</li>
              <li>Investigador institucional</li>
            </ul>
            <!--a type="button" href="registroinvestigador.php" style="pointer-events: none;" class="w-100 btn btn-lg btn-outline-primary" disabled >Registrarme</a-->
          </div>
        </div>
      </div>
    </div>
  </main>

  <footer class="pt-4 my-md-5 pt-md-5 border-top">
    <div class="row">
      <div class="col-12 col-md">
        <img class="mb-2" src="img/no-image.png" alt="" width="24" height="19">
        <small class="d-block mb-3 text-muted">&copy; 2022</small>
      </div>
    </div>
  </footer>
</div>
  </body>
</html>

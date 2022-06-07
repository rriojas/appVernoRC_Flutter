<?php
if(session_status() != PHP_SESSION_ACTIVE)
  session_start();
include 'carrera.class.php';
use CarreraNamespace\Carrera as           Carrera;
use CommonFuncNamespace\CommonFunc as   CommonFunc;
$Carrera =       new Carrera();
$funciones =    new CommonFunc();
if($_SESSION['idTipoUsuario'] == "1")
  $rsCarrera = $Carrera->SelectAll("vw_carrera", "idCarrera, nombre as Nombre, campus as Campus");
else if($idCampusPadre == 0)
    $rsCarrera = $Carrera->SelectAll("vw_carrera", "idCarrera, nombre as Nombre, campus as Campus", "idCampus=".$_SESSION['idCampus']);
else
    $rsCarrera = $Carrera->SelectAll("vw_carrera", "idCarrera, nombre as Nombre, campus as Campus", "idCampus=".$idCampusPadre);
    
    $_SESSION['idCampusPadre'] = $idCampusPadre;
?>
<h4>Administracion de Carrera</h4>
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand"></a>
    <form class="d-flex float-end">
      <!--input id="txtBuscar" class="me-2" type="search" placeholder="Search" aria-label="Search">
      <button id="btnBuscar" class="btn btn-outline-success me-1" type="button">Buscar <span class="fas fa-search"></span></button-->
      <button id="btnAgregar" type="button" class="btn btn-primary">Agregar <span class="fas fa-plus-circle"></span></button>
    </form>
  </div>
</nav>
<div class="col-sm-12 mb-2 text-right">
    
</div>
<?php
    echo $funciones->ArrayToTable($rsCarrera, "buttonDelete");
?>
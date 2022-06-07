<?php
if (session_status() != PHP_SESSION_ACTIVE)
  session_start();
include 'campus.class.php';
use CampusNamespace\Campus as           Campus;
use CommonFuncNamespace\CommonFunc as   CommonFunc;
$campus =       new Campus();
$funciones =    new CommonFunc();
if($_SESSION['idTipoUsuario'] == "1")
  $rsCampus = $campus->SelectAll("vw_campus", "idCampus, nombre as Nombre, institucion as Institucion, municipio as Municipio");
else if($_SESSION['idTipoUsuario'] == "2") //coordinador investigador
  $rsCampus = $campus->SelectAll("vw_campus", "idCampus, nombre as Nombre, institucion as Institucion, municipio as Municipio", "idInstitucion=".$_SESSION['idInstitucion']);
else if($_SESSION['idTipoUsuario'] == "3") //coordinador investigador
  $rsCampus = $campus->SelectAll("vw_campus", "idCampus, nombre as Nombre, institucion as Institucion, municipio as Municipio", "idCampus=".$_SESSION['idCampus']);
else 
  die('No tienes permiso de estar aqui');
?>
<h4>Administracion de Campus</h4>
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
<?php
    echo $funciones->ArrayToTable($rsCampus, "buttonDeleteAggCarrera");
?>
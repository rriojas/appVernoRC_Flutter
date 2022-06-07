<?php
include 'coordinador.class.php';
use CoordinadorNamespace\Coordinador as           Coordinador;
use CommonFuncNamespace\CommonFunc as   CommonFunc;
$Coordinador =  new Coordinador();
$funciones =    new CommonFunc();
$rsCoordinador = $Coordinador->Select("select idCoordinador, usuario as Coordinador, correo as Correo, telefono as Telefono, puesto as Puesto from vw_coordinador where estatus=1");
?>
<h4>Administracion de Coordinador</h4>
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
    echo $funciones->ArrayToTable($rsCoordinador, "buttonDelete");
?>
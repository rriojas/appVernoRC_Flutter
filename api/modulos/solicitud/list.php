<?php
include 'solicitud.class.php';
use SolicitudNamespace\Solicitud as           Solicitud;
use CommonFuncNamespace\CommonFunc as   CommonFunc;
$Solicitud =       new Solicitud();
$funciones =    new CommonFunc();
$rsSolicitud = $Solicitud->SelectAll("solicitud", "*");
?>
<h4>Administracion de Solicitud</h4>
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand">Acciones</a>
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
    echo $funciones->ArrayToTable($rsSolicitud, "buttonDelete");
?>
<?php
include 'institucion.class.php';
use InstitucionNamespace\Institucion as           Institucion;
use CommonFuncNamespace\CommonFunc as   CommonFunc;
$Institucion =       new Institucion();
$funciones =    new CommonFunc();
$rsInstitucion = $Institucion->SelectAll("institucion", "idInstitucion, nombre as Nombre, abreviatura");
?>
<h4>Administracion de Institucion</h4>
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
    echo $funciones->ArrayToTable($rsInstitucion, "buttonDelete");
?>
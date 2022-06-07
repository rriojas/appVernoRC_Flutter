<?php
include 'municipio.class.php';
//include (__DIR__).'/../../lib/CommonFunc.class.php';
use MunicipioNamespace\Municipio as           Municipio;
use CommonFuncNamespace\CommonFunc as   CommonFunc;
$Municipio =       new Municipio();
$funciones =    new CommonFunc();
$rsMunicipio =     $Municipio->SelectAll("vw_municipio", "`idMunicipio`, `nombre`, `estado` as idEstado");

?>
<h4>Administracion de Municipio</h4>
<div class="col-sm-12 mb-2 text-right">
    <button id="btnAgregar" class="btn btn-primary">Agregar nuevo <span class="fas fa-plus-circle"></span></button>
</div>
<?php
    echo $funciones->ArrayToTable($rsMunicipio, "button");
?>
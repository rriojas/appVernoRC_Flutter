<?php
include 'estado.class.php';
use EstadoNamespace\Estado as           Estado;
use CommonFuncNamespace\CommonFunc as   CommonFunc;
$Estado =       new Estado();
$funciones =    new CommonFunc();
$rsEstado =     $Estado->SelectAll("estado", "idestado, nombre");
?>
<h4>Administracion de Estado</h4>
<div class="col-sm-12 mb-2 text-right">
    <button id="btnAgregar" class="btn btn-primary">Agregar nuevo <span class="fas fa-plus-circle"></span></button>
</div>
<?php
    echo $funciones->ArrayToTable($rsEstado, "button");
?>
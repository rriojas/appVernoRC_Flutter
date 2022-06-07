<?php
include (__DIR__).'/../../lib/CommonFunc.class.php';
include (__DIR__).'/estado.class.php';

use EstadoNamespace\Estado as           Estado;
use CommonFuncNamespace\CommonFunc as   CommonFunc;
$commonFunc =   new CommonFunc();
$id =           0;
if($_POST && isset($_POST['id']))
    $id =   $_POST['id'];
$Estado =          new Estado($id);
$EstadoVal =       $Estado->GetValues();
$countEstadoVal = 0;
if($id > 0)
    $countEstadoVal =  count($EstadoVal);
//$optJefe = $commonFunc->ArrayToOption($Estado->Select("select curp as id, nombre as descripcion from empleado where status = 1"), $Estado->idjefe);
//print_r($Ciudad);
?>
<h4>Estado <span class="fas fa-city"></span></h4>
<form id="frmEstado" class="mb-4">
    <input type="hidden" value="<?php echo ($id > 0 ? $Estado->idEstado : '') ?>" name="idEstado" id="idestado">
    <div class="form-group">
        <label for="nombre">Nombre Estado</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo ($id > 0 ? $Estado->nombre : '') ?>">
    </div>
    <div class="text-end mt-1">
        <?php 
        if($id > 0)
        {
            echo '<button class="btn btn-danger mr-1 float-start" type="button" id="btnEliminar">Eliminar <span class="fas fa-trash-alt"></span></button>';
        }
        ?>
        <button class="btn btn-secondary mr-1" type="button" id="btnCancelar">Cancelar <span class="fas fa-times-circle"></span></button>
        <button class="btn btn-primary" type="button" id="btnAceptar" data-editando="<?php echo ($id > 0 ? "1" : "0"); ?>">Aceptar <span class="fas fa-check-circle"></span></button>
    </div>
</form>
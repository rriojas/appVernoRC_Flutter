<?php
include (__DIR__).'/../../lib/CommonFunc.class.php';
include (__DIR__).'/municipio.class.php';

use MunicipioNamespace\Municipio as     Municipio;
use CommonFuncNamespace\CommonFunc as   CommonFunc;
$commonFunc =   new CommonFunc();
$id =           0;
if($_POST && isset($_POST['id']))
    $id =   $_POST['id'];
$Municipio =          new Municipio($id);
$MunicipioVal =       $Municipio->GetValues();
$countMunicipioVal = 0;
if($id > 0)
    $countMunicipioVal =  count($MunicipioVal);
$optEstado = $commonFunc->ArrayToOption($Municipio->Select("select idEstado as id, nombre as descripcion from estado where estatus = 1"), $Municipio->idEstado);
//print_r($Ciudad);
?>
<h4>Municipio <span class="fas fa-city"></span></h4>
<form id="frmMunicipio" class="mb-4">
    <input type="hidden" value="<?php echo ($id > 0 ? $Municipio->idMunicipio : '') ?>" name="idmunicipio" id="idmunicipio">
    <div class="form-group">
        <label for="nombre">Nombre Municipio</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo ($id > 0 ? $Municipio->nombre : '') ?>">
    </div>
    <div class="form-group">
        <label for="idestado">Estado</label>
        <select class="form-select" id="idestado" name="idestado">
            <?php echo $optEstado; ?>
        </select>
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
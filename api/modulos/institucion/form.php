<?php
include 'institucion.class.php';
use InstitucionNamespace\Institucion as           Institucion;
use CommonFuncNamespace\CommonFunc as   CommonFunc;
$funciones =    new CommonFunc();
$id =           0;
if($_POST && isset($_POST['id']))
{
    $id =   $_POST['id'];
    $Institucion =       new Institucion($id);
    //$InstitucionVal =    $Institucion->GetValues();
}
else
{
    $Institucion = new Institucion();
}
?>
<form class="row g-3">
    <input type="hidden" id="idInstitucion" name="" value="<?php echo $Institucion->idInstitucion; ?>" />
  <div class="col-md-9">
    <label for="txtNombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="txtNombre" value="<?php echo $Institucion->nombre; ?>" />
  </div>
  <div class="col-md-3">
    <label for="txtAbreviatura" class="form-label">Abreviatura</label>
    <input type="text" class="form-control" id="txtAbreviatura" value="<?php echo $Institucion->abreviatura; ?>" />
  </div>
  <div class="col-12 text-end">
    <button id="btnCancelar" type="button" class="btn btn-outline-secondary">Cancelar</button>
    <button id="btnAceptar" type="button" class="btn btn-primary">Aceptar</button>
  </div>
</form>
<?php
if(session_status() != PHP_SESSION_ACTIVE)
  session_start();
include 'campus.class.php';
use CampusNamespace\Campus as           Campus;
use CommonFuncNamespace\CommonFunc as   CommonFunc;
$campus =       new Campus();
$funciones =    new CommonFunc();
$id =           0;
if($_POST && isset($_POST['id']))
{
    $id =   $_POST['id'];
    $Campus =       new Campus($id);
    //$CampusVal =    $Campus->GetValues();
}
else
{
    $Campus = new Campus();
}
$optInstitucion = $funciones->ArrayToOption($Campus->Select("select idInstitucion as id, nombre as descripcion from institucion where estatus = 1 ".($_SESSION['idTipoUsuario'] == 1 ? "" : " and idInstitucion=".$_SESSION['idInstitucion'])), $Campus->idInstitucion);
$rsEstado = $Campus->Select("select idEstado from institucion where idInstitucion=".$_SESSION['idInstitucion']."");
$idEstado = $rsEstado[0]['idEstado'];
$optEstado = $funciones->ArrayToOption($Campus->Select("select idEstado as id, nombre as descripcion from estado where estatus = 1"), $idEstado);
$optMunicipio = $funciones->ArrayToOption($Campus->Select("select idMunicipio as id, nombre as descripcion from municipio where estatus = 1 and idEstado=".$idEstado), $Campus->idMunicipio);
?>
<form class="row g-3">
    <input type="hidden" id="idCampus" name="" value="<?php echo $Campus->idCampus; ?>" />
  <div class="col-md-9">
    <label for="txtNombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="txtNombre" value="<?php echo $Campus->nombre; ?>" />
  </div>
  <div class="col-md-3">
    <label for="txtAbreviatura" class="form-label">Abreviatura</label>
    <input type="text" class="form-control" id="txtAbreviatura" value="<?php echo $Campus->abreviaturaCampus; ?>" />
  </div>
  <div class="col-md-12">
    <label for="cmbInstitucion" class="form-label">Institucion</label>
    <select id="cmbInstitucion" class="form-select">
      <?php echo $optInstitucion; ?>
    </select>
  </div>
  <div class="col-md-6">
    <label for="cmbEstado" class="form-label">Estado</label>
    <select id="cmbEstado" class="form-select" <?php echo $_SESSION['idTipoUsuario'] != "1" ? "disabled" : ""; ?>>
      <?php echo $optEstado; ?>
    </select>
  </div>
  <div class="col-md-6">
    <label for="cmbMunicipio" class="form-label">Municipio</label>
    <select id="cmbMunicipio" class="form-select">
      <?php echo $optMunicipio; ?>
    </select>
  </div>
  <div class="col-12 text-end">
    <button id="btnCancelar" type="button" class="btn btn-outline-secondary">Cancelar</button>
    <button id="btnAceptar" type="button" class="btn btn-primary">Aceptar</button>
  </div>
</form>
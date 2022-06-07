<?php
if(session_status() != PHP_SESSION_ACTIVE)
  session_start();
include 'carrera.class.php';
use CarreraNamespace\Carrera as           Carrera;
use CommonFuncNamespace\CommonFunc as   CommonFunc;
$funciones =    new CommonFunc();
$id =           0;
if($_POST && isset($_POST['id']))
{
    $id =   $_POST['id'];
    $Carrera =       new Carrera($id);
    //$CarreraVal =    $Carrera->GetValues();
}
else
{
    $Carrera = new Carrera();
}
$optCampus = $funciones->ArrayToOption($Carrera->Select("select idCampus as id, nombre as descripcion from campus where estatus = 1 ".($_SESSION['idTipoUsuario'] != 1 ? "and idCampus=".$_SESSION['idCampus'] : "")), $Carrera->idCampus);
$idCampusPadre = $_SESSION['idCampusPadre'];
unset($_SESSION['idCampusPadre']);
?>
<form class="row g-3">
    <input type="hidden" id="idCarrera" name="" value="<?php echo $Carrera->idCarrera; ?>" />
    <input type="hidden" id="idCampus" name="" value="<?php echo $idCampusPadre; ?>" />
  <div class="col-md-12">
    <label for="txtNombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="txtNombre" value="<?php echo $Carrera->nombre; ?>" />
  </div>
  <!--div class="col-md-12">
    <label for="cmbCampus" class="form-label">Campus</label>
    <select id="cmbCampus" class="form-select">
      
    </select>
  </div-->
  <div class="col-12 text-end">
    <button id="btnCancelar" type="button" class="btn btn-outline-secondary">Cancelar</button>
    <button id="btnAceptar" type="button" class="btn btn-primary">Aceptar</button>
  </div>
</form>
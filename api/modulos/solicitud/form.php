<?php
include 'solicitud.class.php';
use SolicitudNamespace\Solicitud as     Solicitud;
use CommonFuncNamespace\CommonFunc as   CommonFunc;

$funciones =    new CommonFunc();
$id =           0;
$_POST['idProyecto'] = 3;
if($_POST && isset($_POST['id']))
{
    $id =   $_POST['id'];
    $Solicitud =       new Solicitud($id);
    //$SolicitudVal =    $Solicitud->GetValues();
}
else if($_POST && isset($_POST['idProyecto']))
{
    $Solicitud = new Solicitud();
    $Solicitud->idProyecto = $_POST['idProyecto'];
}
else
{
    echo "Acceso no autorizado<br/>";
    die('<button id="btnCancelar" type="button" class="btn btn-outline-secondary">Aceptar</button>');
}
//$optProyecto = $funciones->ArrayToOption($Solicitud->Select("select idProyecto as id, titulo as descripcion from proyecto where estatus = 1 and idProyecto=".$Solicitud->idProyecto), $Solicitud->idProyecto);
$optProyecto = $funciones->ArrayToOption($Solicitud->SelectAll("proyecto","idProyecto as id, titulo as descripcion","estatus = 1 and idProyecto=".$Solicitud->idProyecto), $Solicitud->idProyecto);
?>
<form class="row g-3">
    <input type="hidden" id="idSolicitud" name="idSolicitud" value="<?php echo $id; ?>" />
  <div class="col-md-9">
    <label for="txtComentario" class="form-label">Comentario</label>
    <input type="text" class="form-control" id="txtComentario" name="comentario" value="<?php echo $Solicitud->comentario; ?>" />
  </div>
  <div class="col-md-12">
    <label for="cmbProyecto" class="form-label">Proyecto</label>
    <select id="cmbProyecto" name="idProyecto" class="form-select">
      <?php echo $optProyecto; ?>
    </select>
  </div>
  <div class="col-12 text-end">
    <button id="btnCancelar" type="button" class="btn btn-outline-secondary">Cancelar</button>
    <button id="btnAceptar" type="button" class="btn btn-primary">Aceptar</button>
  </div>
</form>
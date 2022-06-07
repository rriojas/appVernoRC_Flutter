<?php
include '../usuario/usuario.class.php';
include 'coordinador.class.php';
use UsuarioNamespace\Usuario as           Usuario;
use CoordinadorNamespace\Coordinador as   Coordinador;
use CommonFuncNamespace\CommonFunc as   CommonFunc;

$Coordinador = new Coordinador();
$funciones =    new CommonFunc();
$id =           0;
if($_POST && isset($_POST['id']))
{
    $id =   $_POST['id'];
    $Coordinador =       new Coordinador($id);
    //$CoordinadorVal =    $Coordinador->GetValues();
}
else
{
    $Coordinador = new Coordinador();
}
if(isset($idUsuario))
{
    $Usuario =      new Usuario($idUsuario);
}
else if($id != 0)
{
    $Usuario =      new Usuario($Coordinador->idUsuario);
}
?>
<div class="col-12">
    <div class="mb-3 row">
        <label for="staticNombre" class="col-sm-2 col-form-label">Nombre</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticNombre" value="<?php echo $Usuario->nombre.' '.$Usuario->apellidoPaterno.' '.$Usuario->apellidoMaterno; ?>">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="staticDireccion" class="col-sm-2 col-form-label">Direccion</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticDireccion" value="<?php echo $Usuario->calle.' '.$Usuario->numero.' '.$Usuario->colonia.' '.$Usuario->codigoPostal; ?>">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="staticTelefono" class="col-sm-2 col-form-label">Telefono</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticTelefono" value="<?php echo $Usuario->telefono; ?>">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="staticCorreo" class="col-sm-2 col-form-label">Correo</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticCorreo" value="<?php echo $Usuario->correo; ?>">
        </div>
    </div>
</div>
<form id="frmCoordinador">
    <input type="hidden" id="idCoordinador" name="idCoordinador" value="<?php echo $id; ?>" />
    <input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo $Usuario->idUsuario; ?>" />
  <div class="row mb-3">
    <label for="txtPuesto" class="col-sm-2 col-form-label">Puesto</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="txtPuesto" name="puesto" value="<?php echo $Coordinador->puesto; ?>">
    </div>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" value="" id="chkEsCoordinadorInstitucional" name="esCoordinadorInstitucional" <?php echo $Coordinador->esCoordinadorInstitucional == 1 ? "checked" : ""; ?>>
  <label class="form-check-label" for="chkEsCoordinadorInstitucional">
    Es Institucional?
  </label>
</div>
  <div class="text-end">
    <button id="btnCancelar" type="button" class="btn btn-secondary">Cancelar</button>
    <button id="btnAceptar" type="button" class="btn btn-primary">Registrar</button>
  </div>
</form>
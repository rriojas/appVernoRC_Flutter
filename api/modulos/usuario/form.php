<?php
if(session_status() != PHP_SESSION_ACTIVE)
  session_start();
include 'usuario.class.php';
use UsuarioNamespace\Usuario as           Usuario;
use CommonFuncNamespace\CommonFunc as   CommonFunc;
$Usuario =      new Usuario();
$funciones =    new CommonFunc();
$id =           0;
$idTipoUsuario = 0;
if($_POST && isset($_POST['id']))
{
    $id =   $_POST['id'];
    $Usuario =       new Usuario($id);
    $idTipoUsuario = $Usuario->idTipoUsuario;
    //$UsuarioVal =    $Usuario->GetValues();
}
else
{
    $Usuario = new Usuario();
}
if($_POST && isset($_POST['idTipoUsuario']))
{
  $idTipoUsuario = $_POST['idTipoUsuario'];
}
else if($id == 0)
{
  echo "Acceso no autorizado<br/>";
    die('<button id="btnCancelar" type="button" class="btn btn-outline-secondary">Aceptar</button>');
}
$sql = "";
if(isset($_SESSION['idTipoUsuario']) && $_SESSION['idTipoUsuario'] == "2")
{
    $sql = "Select idInstitucion as id, nombre as descripcion from institucion where estatus = 1 AND idInstitucion >1 AND idInstitucion=".$_SESSION['idInstitucion']." order by descripcion";
}
else
{
    $sql = "Select idInstitucion as id, nombre as descripcion from institucion where estatus = 1 AND idInstitucion >1 order by descripcion";
}
$rsInstitucion = $Usuario->Select($sql);
$optInstitucion = $funciones->ArrayToOption($rsInstitucion, $rsInstitucion[0]['id']);
$optUsuario = $funciones->ArrayToOption($Usuario->Select("select idCampus as id, nombre as descripcion from campus where estatus = 1 AND idCampus > 1 and idInstitucion=".$rsInstitucion[0]['id']), $Usuario->idCampus);
?>
<form id="frmUsuario" class="row g-3">
  <input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo $Usuario->idUsuario; ?>" />
  <input type="hidden" name="idTipoUsuario" id="idTipoUsuario" value="<?php echo $idTipoUsuario; ?>" />
  <div class="col-md-4">
    <label for="txtNombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="txtNombre" name="nombre" value="<?php echo $Usuario->nombre; ?>">
  </div>
  <div class="col-md-4">
    <label for="txtApellidoPaterno" class="form-label">Apellido Paterno</label>
    <input type="text" class="form-control" id="txtApellidoPaterno" name="apellidoPaterno" value="<?php echo $Usuario->apellidoPaterno; ?>">
  </div>
  <div class="col-md-4">
    <label for="txtApellidoMaterno" class="form-label">Apellido Materno</label>
    <input type="text" class="form-control" id="txtApellidoMaterno" name="apellidoMaterno" value="<?php echo $Usuario->apellidoMaterno; ?>">
  </div>
  <div class="col-9">
    <label for="txtCalle" class="form-label">Calle</label>
    <input type="text" class="form-control" id="txtCalle" placeholder="Calle" name="calle" value="<?php echo $Usuario->calle; ?>">
  </div>
  <div class="col-3">
    <label for="txtNumero" class="form-label">Numero</label>
    <input type="text" class="form-control" id="txtNumero" placeholder="Numero" name="numero" value="<?php echo $Usuario->numero; ?>">
  </div>
  <div class="col-9">
    <label for="txtColonia" class="form-label">Colonia</label>
    <input type="text" class="form-control" id="txtColonia" placeholder="Colonia" name="colonia" value="<?php echo $Usuario->colonia; ?>">
  </div>
  <div class="col-3">
    <label for="txtCodigoPostal" class="form-label">Codigo Postal</label>
    <input type="text" class="form-control" id="txtCodigoPostal" placeholder="Codigo Postal" name="codigoPostal" value="<?php echo $Usuario->codigoPostal; ?>">
  </div>
  <div class="col-md-6">
    <label for="txtFechaNacimiento" class="form-label">Fecha de Nacimiento</label>
    <input type="date" class="form-control" id="txtFechaNacimiento" name="fechaNacimiento" value="<?php echo $Usuario->fechaNacimiento; ?>">
  </div>
  <div class="col-md-6">
    <label for="txtGenero" class="form-label">Genero</label>
    <select name="genero" id="cmbGenero" class="form-select">
          <option value="0">Masculino</option>
          <option value="1">Femenino</option>
    </select>
  </div>
  <div class="col-md-12">
    <label for="txtTelefono" class="form-label">Teléfono</label>
    <input type="text" class="form-control" id="txtTelefono" name="telefono" value="<?php echo $Usuario->telefono; ?>" />
  </div>
  <div class="col-md-6">
    <label for="cmbInstitucion" class="form-label">Institucion</label>
    <select id="cmbInstitucion" onchange="ActualizaCampus(event)" class="form-select">
      <?php echo $optInstitucion; ?>
    </select>
  </div>
  <div class="col-md-6">
    <label for="cmbCampus" class="form-label">Escuela/ Facultad / Centro de Investigación</label>
    <select id="cmbCampus" name="idCampus" class="form-select">
      <?php echo $optUsuario; ?>
    </select>
  </div>
  <div class="col-12">
    <label for="txtCorreo" class="form-label">Correo</label>
    <input type="text" class="form-control" id="txtCorreo" placeholder="Correo" name="correo" value="<?php echo $Usuario->correo; ?>">
  </div>
  <div class="col-12">
    <label for="txtPassword" class="form-label">Contraseña</label>
    <input type="password" class="form-control" id="txtPassword" placeholder="Contraseña" name="clave">
  </div>
  <div class="col-12">
    <label for="txtConfirmaPassword" class="form-label">Confirma Contraseña</label>
    <input type="password" class="form-control" id="txtConfirmaPassword" placeholder="Confirma Contraseña">
  </div>
  <div class="col-12 text-end">
  <button id="btnCancelar" type="button" class="btn btn-primary">Cancelar</button>
    <button id="btnAceptar" type="button" class="btn btn-primary">Continuar</button>
  </div>
</form>
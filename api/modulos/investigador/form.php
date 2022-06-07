<?php
if(session_status() != PHP_SESSION_ACTIVE)
  session_start();
include '../usuario/usuario.class.php';
include 'investigador.class.php';
use UsuarioNamespace\Usuario as           Usuario;
use InvestigadorNamespace\Investigador as   Investigador;
use CommonFuncNamespace\CommonFunc as   CommonFunc;

$Investigador = new Investigador();
$funciones =    new CommonFunc();
$id =           0;
if($_POST && isset($_POST['id']))
{
    $id =   $_POST['id'];
    $Investigador =       new Investigador($id);
    //$InvestigadorVal =    $Investigador->GetValues();
}
else
{
    $Investigador = new Investigador();
}
$EsAdministrador = ($_SESSION['idTipoUsuario'] < 3);
$Usuario = new Usuario();
if(isset($_POST['idUsuario']))
  $idUsuario = $_POST['idUsuario'];
if(isset($idUsuario))
{
    $Usuario =      new Usuario($idUsuario);
}
else if($id != 0)
{
    $Usuario =      new Usuario($Investigador->idUsuario);
    $idUsuario = $Investigador->idUsuario;
}
else
{
  die('No tienes permiso de estar aqui');
}
$opcionesTitulo='';
for ($i=0; $i < count($Investigador->varTitulo) ; $i++)
{
    $selected= $Investigador->titulo == $i ? 'selected' : '';
    $opcionesTitulo.='<option value="'.$i.'" '. $selected.'>'.$Investigador->varTitulo[$i].'</option>';
}
$opcionesSNI='';
for ($i=0; $i < count($Investigador->varSNI) ; $i++)
{
    $selected= $Investigador->nivelSNI == $i ? 'selected' : '';
    $opcionesSNI.='<option value="'.$i.'" '. $selected.'>'.$Investigador->varSNI[$i].'</option>';
}
$opcionesPRODEP='';
for ($i=0; $i < count($Investigador->varPRODEP) ; $i++)
{
    $selected= $Investigador->PRODEP == $i ? 'selected' : '';
    $opcionesPRODEP.='<option value="'.$i.'" '. $selected.'>'.$Investigador->varPRODEP[$i].'</option>';
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
<form id="frmInvestigador">
    <input type="hidden" id="idInvestigador" name="idInvestigador" value="<?php echo $Investigador->idInvestigador; ?>"/>
    <input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo $idUsuario; ?>" />
  <div class="row mb-3">
    <label for="titulo" class="col-sm-2 col-form-label">Grado</label>
    <div class="col-sm-10">
      <!--input type="text" class="form-control" id="txtTitulo" name="titulo" value="<?php //echo $Investigador->titulo; ?>"-->
      <select name="titulo" id="cmbTitulo" class="form-select">
         <?php echo  $opcionesTitulo; ?>
      </select>
    </div>
  </div>
  <div class="row mb-3">
    <label for="txtDepartamento" class="col-sm-2 col-form-label">Adscripción</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="txtDepartamento" name="departamento" value="<?php echo $Investigador->departamento; ?>">
    </div>
  </div>
  <div class="row mb-3">
    <label for="cmbNivelSNI" class="col-sm-2 col-form-label">Nivel SNI</label>
    <div class="col-sm-4">
      <select name="nivelSNI" id="cmbNivelSNI" class="form-select">
          <?php echo  $opcionesSNI; ?>
      </select>
    </div>
    <label for="cmbPRODEP" class="col-sm-2 col-form-label">PRODEP</label>
    <div class="col-sm-4">
      <select name="PRODEP" id="cmbPRODEP" class="form-select">
          <?php echo  $opcionesPRODEP; ?>
      </select>
    </div>
  </div>
  <div class="text-end">
    <button id="btnCancelar" type="button" class="btn btn-primary">Cancelar</button>
    <button id="btnAceptar" type="button" class="btn btn-primary">Registrar</button>
  </div>
</form>
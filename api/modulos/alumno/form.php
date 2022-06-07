<?php
header('Content-Type: application/json; charset=utf-8');
if(session_status() != PHP_SESSION_ACTIVE)
session_start();
include '../usuario/usuario.class.php';
include 'alumno.class.php';
use UsuarioNamespace\Usuario as           Usuario;
use AlumnoNamespace\Alumno as   Alumno;
use CommonFuncNamespace\CommonFunc as   CommonFunc;

$funciones =    new CommonFunc();
$id =           0;
if($_POST && isset($_POST['id']))
{
  $id =   $_POST['id'];
  $Alumno =       new Alumno($id);
  //$AlumnoVal =    $Alumno->GetValues();
}
else
{
  $Alumno = new Alumno();
}
//
//$Usuario = new Usuario();
if(isset($_POST['idUsuario']))
  $idUsuario = $_POST['idUsuario'];
if(isset($idUsuario))
{
    $Usuario =      new Usuario($idUsuario);
}
else if($id != 0)
{
    $Usuario =      new Usuario($Alumno->idUsuario);
    $idUsuario = $Alumno->idUsuario;
}
else
{
  die('No tienes permiso de estar aqui');
}
$optCarrera = $funciones->ArrayToOption($Usuario->Select("select idCarrera as id, nombre as descripcion from carrera where estatus = 1 and idCampus=".$Usuario->idCampus), $Alumno->idCarrera);
$rsVerano = $Alumno->Select("SELECT idVerano from verano where estatus=1");
?>
<form id="frmAlumno" class="row g-3">
  <input type="hidden" id="idAlumno" name="idAlumno" value="<?php echo $Alumno->idAlumno; ?>" />
  <input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo $idUsuario; ?>" />
  <input type="hidden" id="idVerano" name="idVerano" value="<?php echo $rsVerano[0]['idVerano']; ?>" />
  <div class="col-md-4">
    <label for="txtMatricula" class="form-label">Matricula</label>
    <input type="text" class="form-control" id="txtMatricula" name="matricula" value="<?php echo $Alumno->matricula; ?>">
  </div>
  <div class="col-md-4">
    <label for="txtCURP" class="form-label">CURP</label>
    <input type="text" class="form-control" id="txtCURP" name="CURP" value="<?php echo $Alumno->CURP; ?>">
  </div>
  <div class="col-md-4">
    <label for="txtSemestre" class="form-label">Semestre</label>
    <input type="text" class="form-control" id="txtSemestre" name="semestre" value="<?php echo $Alumno->semestre; ?>">
  </div>
  <div class="col-9">
    <label for="txtPromedio" class="form-label">Promedio</label>
    <input type="text" class="form-control" id="txtPromedio" placeholder="Promedio" name="promedio" value="<?php echo $Alumno->promedio; ?>">
  </div>
  <div class="col-3">
    <label for="txtPorcentajeAvanceCarrera" class="form-label">Porcentaje Avance Carrera</label>
    <input type="text" class="form-control" id="txtPorcentajeAvanceCarrera" placeholder="PorcentajeAvanceCarrera" name="porcentajeAvanceCarrera" value="<?php echo $Alumno->porcentajeAvanceCarrera; ?>">
  </div>
  <div class="col-12">
    <label for="txtNombreInvestigadorRecomienda" class="form-label">Nombre del investigador y/o docente que lo recomienda</label>
    <input type="text" class="form-control" id="txtNombreInvestigadorRecomienda" placeholder="Nombre del investigador y/o docente que lo recomienda" name="nombreInvestigadorRecomienda" value="<?php echo $Alumno->nombreInvestigadorRecomienda; ?>">
  </div>
  <div class="col-6">
    <label for="txtCorreoInvestigadorRecomienda" class="form-label">Correo Investigador Recomienda</label>
    <input type="text" class="form-control" id="txtCorreoInvestigadorRecomienda" placeholder="CorreoInvestigadorRecomienda" name="correoInvestigadorRecomienda" value="<?php echo $Alumno->correoInvestigadorRecomienda; ?>">
  </div>
  <div class="col-6">
    <label for="txtTelefonoInvestigadorRecomienda" class="form-label">Telefono Investigador Recomienda</label>
    <input type="text" class="form-control" id="txtTelefonoInvestigadorRecomienda" placeholder="TelefonoInvestigadorRecomienda" name="telefonoInvestigadorRecomienda" value="<?php echo $Alumno->telefonoInvestigadorRecomienda; ?>">
  </div>
  <!--div class="col-md-6">
    <label for="txtFechaNacimiento" class="form-label">Fecha de Nacimiento</label>
    <input type="date" class="form-control" id="txtFechaNacimiento" name="fechaNacimiento" value="<?php echo $Alumno->fechaNacimiento; ?>">
  </div-->
  <div class="col-md-6">
    <label for="cmbCarrera" class="form-label">Carrera</label>
    <!--input type="text" class="form-control" id="txtGenero" name="genero" value="<?php //echo $Usuario->genero; ?>"/>
    <select id="cmbCarrera" name="idGenero" class="form-select"-->
    <select id="cmbCarrera" name="idCarrera" class="form-select">
          <?php echo $optCarrera; ?>
    </select>
  </div>
  <div class="col-12 text-end">
  <button id="btnCancelar" type="button" class="btn btn-primary">Cancelar</button>
    <button id="btnAceptar" type="button" class="btn btn-primary">Continuar</button>
  </div>
</form>
<?php
if(session_status() !== PHP_SESSION_ACTIVE)
    session_start();
include 'proyectodisponible.class.php';
use ProyectoDisponibleNameSpace\ProyectoDisponible as ProyectoDisponible;
if(!$_POST)
{
    die("Error no puedes estar aqui");
}
extract($_POST);
$proyecto = new ProyectoDisponible($id);
?>
<h4><?php echo $proyecto->titulo; ?></h4>
<div class="col-12">
    <b>Actividades a realizar:</b><br/><?php echo $proyecto->actividad; ?>
</div>
<div class="col-12">
    <b>Habilidades necesarias:</b><br/><?php echo $proyecto->habilidad; ?>
</div>
<div class="col-12">
    <b>Area:</b><br/><?php echo $proyecto->area; ?>
</div>
<div class="col-12">
    <b>Carrera:</b><br/><?php echo $proyecto->carrera; ?>
</div>
<div class="col-12">
    <b>Cantidad de alumnos requeridos:</b><br/><?php echo $proyecto->cantidadAlumnos; ?>
</div>
<div class="col-12">
    <b>Modalidad:</b><br/><?php echo ($proyecto->modalidad == 'V' ? 'VIRTUAL' : 'PRESENCIAL'); ?>
</div>
<hr />
<form id="frmSolicitud" class="row g-3">
    <input type="hidden" id="idVerano" name="idVerano" value="<?php echo $_SESSION['idVerano']; ?>" />
    <input type="hidden" id="idUsuarioAlumno" name="idUsuarioAlumno" value="<?php echo $_SESSION['idUsuario']; ?>" />
    <input type="hidden" id="idProyecto" name="idProyecto" value="<?php echo $id; ?>" />
    <input type="hidden" id="numeroVuelta" name="numeroVuelta" value="<?php echo 0; ?>" />
    <input type="hidden" id="orden" name="orden" value="<?php echo 1; ?>" />
    <input type="hidden" id="idSolicitud" name="idSolicitud" value="<?php echo 0; ?>" />
  <div class="col-md-9">
    <!--label for="txtComentario" class="form-label">Comentario</label-->
    <input type="hidden" class="form-control" id="txtComentario" name="comentario" value="" />
  </div>
  <div class="col-12 text-end">
    <button id="btnCancelar" type="button" class="btn btn-outline-secondary">Cancelar</button>
    <button id="btnAceptar" type="button" class="btn btn-primary">Aceptar</button>
  </div>
</form>
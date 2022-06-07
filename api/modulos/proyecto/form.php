<?php
if (session_status() != PHP_SESSION_ACTIVE)
  session_start();
include 'proyecto.class.php';
use ProyectoNamespace\Proyecto as           Proyecto;
use CommonFuncNamespace\CommonFunc as   CommonFunc;

$funciones =    new CommonFunc();
$id =           0;
if($_POST && isset($_POST['id']))
{
    $id =   $_POST['id'];
    $Proyecto =       new Proyecto($id);
    //$ProyectoVal =    $Proyecto->GetValues();
}
else
{
    $Proyecto = new Proyecto();
}


$optArea = $funciones->ArrayToOption($Proyecto->Select("select idarea as id, descripcion from area where estatus = 1"), $Proyecto->idarea);
?>
<h4>Registro de proyecto</h4>
<form id="frmProyecto" class="row g-3">
    <input type="hidden" name="idProyecto" id="idProyecto" value="<?php echo $id; ?>">
    <input type="hidden" name="idCampus" id="idCampus" value="<?php echo $idCampus; ?>">
    <input type="hidden" name="idInstitucion" id="idInstitucion" value="<?php echo $idInstitucion; ?>">
    <div class="col-12">
        <label for="txtTitulo" class="form-label">Titulo</label>
        <input type="text" name="titulo" class="form-control" id="txtTitulo" placeholder="Titulo Proyecto" value="<?php echo $Proyecto->titulo; ?>" />
    </div>
    <div class="col-md-12">
    <label for="cmbArea" class="form-label">Area</label>
    <select id="cmbArea" name="idarea" class="form-select">
      <?php echo $optArea; ?>
    </select>
  </div>
  
  <div class="col-md-8">
    <label for="txtCarrera" class="form-label">Carrera</label>
    <input type="text" name="carrera" class="form-control" id="txtCarrera" value="<?php echo $Proyecto->carrera; ?>"/>
  </div>
  <div class="col-md-2">
    <label for="porcentajeAvanceCarrera" class="form-label">Avance Carrera %</label>
    <input type="number" class="form-control" name="porcentajeAvanceCarrera" id="porcentajeAvanceCarrera" min="50" max="90" value="<?php echo $Proyecto->porcentajeAvanceCarrera; ?>"/>
  </div>
  <div class="col-md-2">
    <label for="cmbCantidadAlumnos" class="form-label">CantidadAlumnos</label>
    <input type="number" class="form-control" name="cantidadAlumnos" id="cantidadAlumnos" min="1" max="3" value="<?php echo $Proyecto->cantidadAlumnos; ?>"/>
  </div>
  <div class="col-12">
    <label for="txtActividad" class="form-label">Actividades a realizar</label>
    <input type="text" class="form-control" id="txtActividad" name="actividad" placeholder="" value="<?php echo $Proyecto->actividad; ?>"/>
  </div>
  <div class="col-md-12">
    <!--label for="txtPerfil" class="form-label">Perfil</label-->
    <input type="hidden" name="perfil" class="form-control" id="txtPerfil"value="<?php echo $Proyecto->perfil; ?>"/>
  </div>
  <div class="col-12">
    <label for="txtHabilidad" class="form-label">Habilidades del estudiante</label>
    <input type="text" class="form-control" name="habilidad" id="txtHabilidad" placeholder="" value="<?php echo $Proyecto->habilidad; ?>"/>
  </div>
  <div class="col-12">
    <label for="txtModalidad" class="form-label">Modalidad</label> <b>Nota: Sujeto a regulaciones sanitarias y de la institución.</b>
    <!--input type="text" class="form-control" name="modalidad" id="txtModalidad" placeholder="" value="<?php //echo $Proyecto->modalidad; ?>"/-->
    <select name="modalidad" id="txtModalidad" class="form-select">
          <option value="V">Virtual</option>
          <option value="H">Híbrido</option>
          <option value="P">Presencial</option>
    </select>
  </div>
  <div class="col-12">
    <label for="txtObservaciones" class="form-label">Observaciones</label>
    <input type="text" class="form-control" name="observaciones" id="txtObservaciones" placeholder="..." value="<?php echo $Proyecto->observaciones; ?>"/>
  </div>
  
  <div class="col-12 text-end">
    <button id="btnCancelar" type="button" class="btn btn-secondary">Cancelar</button>
    <button id="btnAceptar" type="button" class="btn btn-primary">Aceptar</button>
  </div>
</form>
<?php
if(session_status() != PHP_SESSION_ACTIVE)
session_start();
include '../usuario/usuario.class.php';
include 'alumno.class.php';
use UsuarioNamespace\Usuario as           Usuario;
use AlumnoNamespace\Alumno as   Alumno;
use CommonFuncNamespace\CommonFunc as   CommonFunc;

$funciones =    new CommonFunc();
$Alumno =       "";
  $Usuario =    "";
if($_POST && isset($_POST['id']))
{
  $id =   $_POST['id'];
  $Alumno =       new Alumno($id);
  $Usuario = new Usuario($Alumno->idUsuario);
  //$AlumnoVal =    $Alumno->GetValues();
}
else
{
      die('No tienes permiso de estar aqui');
}
$CountDocumentoAlumno = $Usuario->Select("select count(idDocumentoAlumno) as cantidadDocumentos from documentoalumno where estatus =1 and idAlumno = $Usuario->idUsuario");
$CountProyectosSeleccionadosAlumno = $Usuario->Select("select count(idsolicitud) as cantidad from solicitud where estatus =1 and idUsuarioAlumno = $Usuario->idUsuario");
?>
<h4>Validar Alumno 

<?php 

if($Usuario->validado == "0" && $CountDocumentoAlumno[0]['cantidadDocumentos'] >= 7 && $CountProyectosSeleccionadosAlumno[0]['cantidad'] >= 1)
{
?>
    <button class="btn btn-success float-end" data-accion="AceptarValidar" data-value="<?php echo $Usuario->idUsuario; ?>">Validar</button>
<?php
}
else if($Usuario->validado == "1" && $CountDocumentoAlumno[0]['cantidadDocumentos'] >= 7)
{
?>
    <button class="btn btn-danger float-end" data-accion="AceptarInValidar" data-value="<?php echo $Usuario->idUsuario; ?>">Invalidar</button>
<?php
}
?></h4>
<div class="col-12">
    <div class="mb-3 row">
        <label for="staticMatricula" class="col-sm-2 col-form-label">Matricula</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticNombre" value="<?php echo $Alumno->matricula; ?>">
        </div>
    </div>
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
     <div class="mb-3 row">
        <label for="staticCorreo" class="col-sm-2 col-form-label">Cantidad de Proyectos Seleccionados</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="cantidadProyectosSeleccionados" value="<?php 
            $impideValidacion="";
            if ($CountProyectosSeleccionadosAlumno[0]['cantidad']==0){ $impideValidacion=" - Esto Impide Validar al Alumno";}
            echo $CountProyectosSeleccionadosAlumno[0]['cantidad'].' ' .$impideValidacion; ?>">
        </div>
    </div>
</div>
<div class="col-12" id="divDocumento">
    <?php
    $Documento = $Usuario->Select("select * from documento where estatus=1");

$countDocumento = count($Documento);
echo '<div class="col-12">';
$buttonGroup = '<div class="btn-group" role="group" aria-label="Basic example">';
for($i =0; $i < $countDocumento; $i++)
{
    $DocumentoAlumno = $Usuario->Select("select * from documentoalumno where estatus =1 and idAlumno = $Usuario->idUsuario and idDocumento=".$Documento[$i]['idDocumento']);
    if(count($DocumentoAlumno) == 0)
    {
        $buttonGroup.= '<button class="btn btn-outline-info disabled mr-1" data-accion="Ver" data-value="'.$Usuario->idUsuario.'/'.$Documento[$i]['prefijo'].'.pdf">Ver '.$Documento[$i]['descripcion'].'</button>';
    }
    else
    {
        $buttonGroup.= '<button class="btn btn-outline-info mr-1" data-accion="Ver" data-value="'.$Usuario->idUsuario.'/'.$Documento[$i]['prefijo'].'.pdf">Ver '.$Documento[$i]['descripcion'].'</button>';
    }
        //echo '<button class="btn btn-info" data-accion="Ver" data-value="'.$Usuario->idUsuario.'/'.$Documento[$i]['prefijo'].'.pdf">Ver '.$Documento[$i]['descripcion'].'</button>';
    
}
$buttonGroup.= '</div>';
echo $buttonGroup;
echo '</div>';
echo '<div class="col-12 mt-3">';
echo '<embed id="embedFile" src="" width="100%" height="500px" alt="pdf" />';
echo '</div>';

if($Usuario->validado == "0" && $CountDocumentoAlumno[0]['cantidadDocumentos'] == 7)
{
?>
    <button class="btn btn-success float-end" data-accion="AceptarValidar" data-value="<?php echo $Usuario->idUsuario; ?>">Validar</button>
<?php
}
else if($Usuario->validado == "0" && $CountDocumentoAlumno[0]['cantidadDocumentos'] == 7)
{
?>
    <button class="btn btn-danger float-end" data-accion="AceptarInValidar" data-value="<?php echo $Usuario->idUsuario; ?>">Invalidar</button>
<?php
}
?>
</div>
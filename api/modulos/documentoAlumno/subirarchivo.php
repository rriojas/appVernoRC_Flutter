<?php
if(session_status() != PHP_SESSION_ACTIVE)
    session_start();
include '../usuario/usuario.class.php';
include '../alumno/alumno.class.php';
include 'documentoAlumno.class.php';
use UsuarioNamespace\Usuario as           Usuario;
use AlumnoNamespace\Alumno as   Alumno;
use DocumentoAlumnoNamespace\DocumentoAlumno as DocumentoAlumno;
use CommonFuncNamespace\CommonFunc as   CommonFunc;

$funciones =    new CommonFunc();
$Usuario = new Usuario($_SESSION['idUsuario']);
$Documento = $Usuario->Select("select * from documento where estatus=1");

$countDocumento = count($Documento);
echo '<div class="col-12">';
for($i =0; $i < $countDocumento; $i++)
{
    $DocumentoAlumno = $Usuario->Select("select * from documentoalumno where estatus =1 and idAlumno = $Usuario->idUsuario and idDocumento=".$Documento[$i]['idDocumento']);
    if(count($DocumentoAlumno) == 0)
    {
        echo '<div class="btn-group-vertical p-1">';
        echo '<button class="btn btn-info" data-accion="Seleccionar" data-value="'.$Documento[$i]['idDocumento'].'">Subir '.$Documento[$i]['descripcion'].'</button>';
        echo '<button class="btn btn-info disabled" data-accion="Ver" data-value="'.$Usuario->idUsuario.'/'.$Documento[$i]['prefijo'].'.pdf">Ver '.$Documento[$i]['descripcion'].'</button>';
        echo '</div>';
    }
    else
    {
        $disabled = "";
        if($Usuario->validado == "1")
            $disabled = "disabled";
        echo '<div class="btn-group-vertical p-1">';
        echo '<button class="btn btn-secondary '.$disabled.'" data-accion="Seleccionar" data-value="'.$Documento[$i]['idDocumento'].'">Reemplazar '.$Documento[$i]['descripcion'].'</button>';
        echo '<button class="btn btn-info" data-accion="Ver" data-value="'.$Usuario->idUsuario.'/'.$Documento[$i]['prefijo'].'.pdf">Ver '.$Documento[$i]['descripcion'].'</button>';
        echo '</div>';
    }
        //echo '<button class="btn btn-info" data-accion="Ver" data-value="'.$Usuario->idUsuario.'/'.$Documento[$i]['prefijo'].'.pdf">Ver '.$Documento[$i]['descripcion'].'</button>';
    
}
echo '</div>';
echo '<div class="col-12 mt-3">';
echo '<embed id="embedFile" src="" width="100%" height="1000px" alt="pdf" />';
echo '</div>'; 
?>
<input type="file" id="uploadFile" class="invisible">  
 
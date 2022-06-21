<?php
if (session_status() != PHP_SESSION_ACTIVE)
session_start();
include 'alumno.class.php';
use AlumnoNamespace\Alumno as           Alumno;
use CommonFuncNamespace\CommonFunc as   CommonFunc;
$Alumno =       new Alumno();
$funciones =    new CommonFunc();
if($_SESSION['idTipoUsuario'] == "1")
  $rsAlumno = $Alumno->SelectAll("vw_alumno", "idAlumno, matricula, idUsuario, campus, validado");
else if($_SESSION['idTipoUsuario'] == "2") //coordinador investigador
  $rsAlumno = $Alumno->SelectAll("vw_alumno", "idAlumno, matricula, idUsuario, idCarrera, campus,validado", "idInstitucion=".$_SESSION['idInstitucion']);
else if($_SESSION['idTipoUsuario'] == "3") //coordinador investigador
  $rsAlumno = $Alumno->SelectAll("vw_alumno", "idAlumno, matricula, idUsuario, idCarrera, campus,validado", "idCampus=".$_SESSION['idCampus']);
else 
  die('No tienes permiso de estar aqui');
?>
<h4>Administracion de Alumno</h4>
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand"></a>
    <form class="d-flex float-end">
      <button id="btnAgregar" type="button" class="btn btn-primary">Agregarrr <span class="fas fa-plus-circle"></span></button>
    </form>
  </div>
</nav>
<?php
    //echo $funciones->ArrayToTable($rsAlumno, "buttonDeleteValidar");
    $table =    '<table class="table">';
    $thead =    '<thead>';
    $keys =     array_keys( $rsAlumno[0] );
    $thead .=   '<tr>';
    $thead .=   '<th></th>';
    $inicio =   1;
    for ($i = $inicio; $i < count($keys)-1; $i++)
    {
        $element =  utf8_decode($keys[$i]);
        $thead .=   '<th>' .( $element ). '</th>';
    }
    $thead .=   '</tr></thead>';
    $tbody =    '<tbody>';
    for ($i = 0; $i < count($rsAlumno); $i++) {
        $element = $rsAlumno[$i];
        $tbody .=   '<tr class="'.($element['validado'] == '1' ? 'table-success' : 'table-warning').'">';
        $tbody .=   '<td class="text-center"><div class="btn-group" role="group" aria-label="Botones de accion"><button type="button" class="btn btn-warning btn-xs" data-accion="Seleccionar" data-value="' . $element[$keys[0]] . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"><span class="fas fa-edit"></span></button>'.
            ($element['validado'] == 0 ? '<button type="button" data-accion="Validar" class="btn btn-success btn-xs" data-value="' . $element[$keys[0]] . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Validar"><span class="fas fa-check"></span></button>' : 
                '<button type="button" data-accion="Ver" class="btn btn-info btn-xs" data-value="' . $element[$keys[0]] . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver"><span class="fas fa-eye"></span></button>
                <button type="button" data-accion="Invalidar" class="btn btn-secundary btn-xs" data-value="' . $element[$keys[0]] . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Rechazar"><span class="fas fa-ban"></span></button>').
            ($element['validado'] == "0" ? '<button type="button" data-accion="Eliminar" class="btn btn-danger btn-xs" data-value="' . $element[$keys[0]] . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"><span class="fas fa-trash"></span></button>' : "").'</div></td>';
        for($j = $inicio; $j < count($keys)-1; $j++) {
            $tbody .=   '<td>' .( $element[$keys[$j]]) . '</td>';
        }
        $tbody .=   '</tr>';
    }
    $tbody .=   '</tbody>';
                
    $table .=   $thead . $tbody . '</table>';
    echo $table;
?>
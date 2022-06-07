<?php
if (session_status() != PHP_SESSION_ACTIVE)
  session_start();
include 'proyecto.class.php';
use ProyectoNamespace\Proyecto as           Proyecto;
use CommonFuncNamespace\CommonFunc as   CommonFunc;
$funciones =    new CommonFunc();
$Proyecto =     new Proyecto();
if($_SESSION['idTipoUsuario'] == "1")
{
    $rsProyecto = $Proyecto->SelectAll("vw_proyecto", "idProyecto, UsuarioInvestigador as Investigador, titulo as Titulo, perfil as Perfil, modalidad as Modalidad, cantidadAlumnos as 'Cantidad de Alumnos', porcentajeAvanceCarrera as 'Avance Carrera %', validado");
}
else if($_SESSION['idTipoUsuario'] == "2")
{
    $rsProyecto = $Proyecto->SelectAll("vw_proyecto", "idProyecto, UsuarioInvestigador as Investigador, titulo as Titulo, modalidad as Modalidad, cantidadAlumnos as 'Cantidad de Alumnos', porcentajeAvanceCarrera as 'Avance Carrera %', validado", "idInstitucion=".$_SESSION['idInstitucion']);
}
else if($_SESSION['idTipoUsuario'] == "3")
{
    $rsProyecto = $Proyecto->SelectAll("vw_proyecto", "idProyecto, UsuarioInvestigador as Investigador, titulo as Titulo,  modalidad as Modalidad, cantidadAlumnos as 'Cantidad de Alumnos', porcentajeAvanceCarrera as 'Avance Carrera %', validado", "idCampus=".$_SESSION['idCampus']);
}
else if($_SESSION['idTipoUsuario'] == "4")
{
    $rsProyecto = $Proyecto->SelectAll("vw_proyecto", "idProyecto, UsuarioInvestigador as Investigador, titulo as Titulo,  modalidad as Modalidad, cantidadAlumnos as 'Cantidad de Alumnos', porcentajeAvanceCarrera as 'Avance Carrera %', validado", "idUsuarioInvestigador=".$_SESSION['idUsuario']);
    
}
//$CantidadProyecto = $Proyecto->Select("select")
?>
<h4>Administracion de Proyecto</h4>
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand"></a>
    <form class="d-flex float-end">
      <!--input id="txtBuscar" class="me-2" type="search" placeholder="Search" aria-label="Search">
      <button id="btnBuscar" class="btn btn-outline-success me-1" type="button">Buscar <span class="fas fa-search"></span></button-->
      <?php
      if(count($rsProyecto) < 2)
      {
        echo '<button id="btnAgregar" type="button" class="btn btn-primary">Agregar <span class="fas fa-plus-circle"></span></button>';
      }
      ?>
    </form>
  </div>
</nav>
<div class="col-sm-12 mb-2 text-right">
    
</div>
<?php
$countRenglones = count($rsProyecto);
$table =    '<table class="table">';
    $thead =    '<thead>';
    $keys =     array_keys( $rsProyecto[0] );
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
    for ($i = 0; $i < $countRenglones; $i++) {
        $element = $rsProyecto[$i];
        $tbody .=   '<tr class="'.($element['validado'] == '1' ? 'table-success' : 'table-warning').'">';
        $tbody .=   '<td class="text-center"><div class="btn-group" role="group" aria-label="Botones de accion"><button type="button" class="btn btn-warning btn-xs" data-accion="Seleccionar" data-value="' . $element[$keys[0]] . '"><span class="fas fa-edit"></span></button>'.
            ($element['validado'] == 0 ? '<button type="button" data-accion="Validar" class="btn btn-success btn-xs" data-value="' . $element[$keys[0]] . '"><span class="fas fa-check"></span></button>' : '<button type="button" data-accion="Invalidar" class="btn btn-info btn-xs" data-value="' . $element[$keys[0]] . '"><span class="fas fa-ban"></span></button>').
            '<button type="button" data-accion="Eliminar" class="btn btn-danger btn-xs" data-value="' . $element[$keys[0]] . '"><span class="fas fa-trash"></span></button></div></td>';
        for($j = $inicio; $j < count($keys)-1; $j++) {
            $tbody .=   '<td>' .( $element[$keys[$j]]) . '</td>';
        }
        $tbody .=   '</tr>';
    }
    $tbody .=   '</tbody>';
                
    $table .=   $thead . $tbody . '</table>';
    echo $table;
?>
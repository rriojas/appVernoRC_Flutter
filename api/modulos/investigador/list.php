<?php
if (session_status() != PHP_SESSION_ACTIVE)
    session_start();
include 'investigador.class.php';
//include (__DIR__).'/../../lib/CommonFunc.class.php';
use InvestigadorNamespace\Investigador as           Investigador;
use CommonFuncNamespace\CommonFunc as   CommonFunc;
$Investigador =       new Investigador();
$funciones =    new CommonFunc();
//$rsInvestigador =     $Investigador->Select("select * from vw_investigador where estatus=1");
if($_SESSION['idTipoUsuario'] == "1")
  $rsInvestigador = $Investigador->SelectAll("vw_investigador", "idInvestigador, usuario as Nombre, telefono as Teléfono, correo as Correo, cantidadProyecto as 'Proyectos registrados', concat(campus, ' - ', institucion) as campus, validado ", "estatus=1");
    //$rsInvestigador =     $Investigador->Select("select idInvestigador, usuario, telefono, correo, validado, concat(campus, ' - ', institucion) as campus from vw_investigador where estatus=1");
else if($_SESSION['idTipoUsuario'] == "2") //coordinador institucional
    $rsInvestigador = $Investigador->SelectAll("vw_investigador", "idInvestigador, usuario, telefono, correo, cantidadProyecto as 'Proyectos registrados', concat(campus, ' - ', institucion) as campus, validado ", "estatus=1 and idInstitucion=".$_SESSION['idInstitucion']);
    //$rsInvestigador =     $Investigador->Select("select idInvestigador, usuario, telefono, correo, validado, concat(campus, ' - ', institucion) as campus from vw_investigador where estatus=1 and idInstitucion=".$_SESSION['idInstitucion']);
else if($_SESSION['idTipoUsuario'] == "3")
    $rsInvestigador = $Investigador->SelectAll("vw_investigador", "idInvestigador, usuario, telefono, correo, cantidadProyecto as 'Proyectos registrados', concat(campus, ' - ', institucion) as campus, validado ", "estatus=1 and idCampus=".$_SESSION['idCampus']);
  //$rsInvestigador =     $Investigador->Select("select idInvestigador, usuario, telefono, correo, validado, concat(campus, ' - ', institucion) as campus from vw_investigador where estatus=1 and idCampus=".$_SESSION['idCampus']);
else 
  die('No tienes permiso de estar aqui');
?>
<h4>Administracion de Investigador</h4>
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand"></a>
    <form class="d-flex float-end">
      <!--input id="txtBuscar" class="me-2" type="search" placeholder="Search" aria-label="Search">
      <button id="btnBuscar" class="btn btn-outline-success me-1" type="button">Buscar <span class="fas fa-search"></span></button-->
      <button id="btnAgregar" type="button" class="btn btn-primary">Agregar <span class="fas fa-plus-circle"></span></button>
    </form>
  </div>
</nav>
<?php
    //echo $funciones->ArrayToTableButtons($rsInvestigador, "buttonDeleteValidar");
    $table =    '<table class="table">';
    $thead =    '<thead>';
    $keys =     array_keys( $rsInvestigador[0] );
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
    for ($i = 0; $i < count($rsInvestigador); $i++) {
        $element = $rsInvestigador[$i];
        $tbody .=   '<tr class="'.($element['validado'] == '1' ? 'table-success' : 'table-warning').'">';
        $tbody .=   '<td class="text-center"><div class="btn-group" role="group" aria-label="Botones de accion"><button type="button" class="btn btn-warning btn-xs" data-accion="Seleccionar" data-value="' . $element[$keys[0]] . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"><span class="fas fa-edit"></span></button>'.
            ($element['validado'] == 0 ? '<button type="button" data-accion="Validar" class="btn btn-success btn-xs" data-value="' . $element[$keys[0]] . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Validar"><span class="fas fa-check"></span></button>' : '<button type="button" data-accion="Invalidar" class="btn btn-info btn-xs" data-value="' . $element[$keys[0]] . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Rechazar"><span class="fas fa-ban"></span></button>').
            '<button type="button" data-accion="Eliminar" class="btn btn-danger btn-xs" data-value="' . $element[$keys[0]] . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"><span class="fas fa-trash"></span></button></div></td>';
        for($j = $inicio; $j < count($keys)-1; $j++) {
            $tbody .=   '<td>' .( $element[$keys[$j]]) . '</td>';
        }
        $tbody .=   '</tr>';
    }
    $tbody .=   '</tbody>';
                
    $table .=   $thead . $tbody . '</table>';
    echo $table;
?>
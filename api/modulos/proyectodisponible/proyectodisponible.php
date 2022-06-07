<?php
if (session_status() != PHP_SESSION_ACTIVE)
  session_start();
include 'proyectodisponible.class.php';
use CommonFuncNamespace\CommonFunc as   CommonFunc;
use ProyectoDisponibleNameSpace\ProyectoDisponible as ProyectoDisponible;
$funciones =    new CommonFunc();
$proyectoDisponible = new ProyectoDisponible();

if($_REQUEST)
{
    extract($_REQUEST);
    $condicion = "1";
    $condicion2 = "1";
    if($idArea > "0")
    {
        $condicion = "idarea=$idArea";
    }
    if($descripcion != "")
    {
        $condicion2 = "titulo like '%$descripcion%'";
    }
    $rsProyectoDisponible = $proyectoDisponible->SelectAll("vw_proyectodisponible", "*", "$condicion AND $condicion2");
    echo json_encode($rsProyectoDisponible);
}
else
{
    $rsProyectoDisponible = $proyectoDisponible->SelectAll("vw_proyectodisponible");
    echo json_encode($rsProyectoDisponible);
}

//echo $funciones->ArrayToTable($rsProyectoDisponible, "buttonDeleteValidar");
$optArea = $funciones->ArrayToOption($proyectoDisponible->Select("select idarea as id, descripcion from area where estatus = 1"), 0);
if($rsProyectoDisponible == null)
{
    die("No existen resultados");
    echo json_encode([]);
}
?>
 
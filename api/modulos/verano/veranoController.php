<?php
header('Content-Type: application/json; charset=utf-8');
require 'verano.class.php';
use VeranoNamespace\Verano as Verano;
if($_POST)
{
    extract($_POST);
    $Verano = new Verano();
    if($method == 'Insert')
    {
        $Verano->idVerano = 0;
        $Verano->descripcion = $descripcion;
        $Verano->fechaVeranoInicio = $fechaVeranoInicio;
        $Verano->fechaVeranoFin = $fechaVeranoFin;
        $Verano->proyectosPorInvestigador = $proyectosPorInvestigador;
        $Verano->solicitudesPorAlumno = $solicitudesPorAlumno;
        $Verano->alumnosPorProyecto = $alumnosPorProyecto;
        $Verano->porcentajeMinimoAvanceAlumno = $porcentajeMinimoAvanceAlumno;
        $Verano->fechaCrearProyectoInicio = $fechaCrearProyectoInicio;
        $Verano->fechaCrearProyectoFin = $fechaCrearProyectoFin;
        $Verano->fechaValidarProyectoInicio = $fechaValidarProyectoInicio;
        $Verano->fechaValidarProyectoFin = $fechaValidarProyectoFin;
        $Verano->fechaCrearSolicitudInicio = $fechaCrearSolicitudInicio;
        $Verano->fechaCrearSolicitudFin = $fechaCrearSolicitudFin;
        $Verano->fechaValidarSolicitudInicio = $fechaValidarSolicitudInicio;
        $Verano->fechaValidarSolicitudFin = $fechaValidarSolicitudFin;
        $Verano->fechaCrearReporteInicio = $fechaCrearReporteInicio;
        $Verano->fechaCrearReporteFin = $fechaCrearReporteFin;
        $Verano->fechaValidarReporteInicio = $fechaValidarReporteInicio;
        $Verano->fechaValidarReporteFin = $fechaValidarReporteFin;
        $Verano->estatus =   1;
        $idInsertado =  $Verano->CreateInsert();
        if($idInsertado > 0)
            echo '{"mensaje":"Informacion registrada correctamente","IdInsertado":"'.$idInsertado.'"}';
        else
            echo '{"mensaje":"Error al registrar la informacion","IdInsertado":"0"}';
    }
    else if($method == 'Update') 
    {
        $Verano->idVerano = $idVerano;
        $Verano->descripcion = $descripcion;
        $Verano->fechaVeranoInicio = $fechaVeranoInicio;
        $Verano->fechaVeranoFin = $fechaVeranoFin;
        $Verano->proyectosPorInvestigador = $proyectosPorInvestigador;
        $Verano->solicitudesPorAlumno = $solicitudesPorAlumno;
        $Verano->alumnosPorProyecto = $alumnosPorProyecto;
        $Verano->porcentajeMinimoAvanceAlumno = $porcentajeMinimoAvanceAlumno;
        $Verano->fechaCrearProyectoInicio = $fechaCrearProyectoInicio;
        $Verano->fechaCrearProyectoFin = $fechaCrearProyectoFin;
        $Verano->fechaValidarProyectoInicio = $fechaValidarProyectoInicio;
        $Verano->fechaValidarProyectoFin = $fechaValidarProyectoFin;
        $Verano->fechaCrearSolicitudInicio = $fechaCrearSolicitudInicio;
        $Verano->fechaCrearSolicitudFin = $fechaCrearSolicitudFin;
        $Verano->fechaValidarSolicitudInicio = $fechaValidarSolicitudInicio;
        $Verano->fechaValidarSolicitudFin = $fechaValidarSolicitudFin;
        $Verano->fechaCrearReporteInicio = $fechaCrearReporteInicio;
        $Verano->fechaCrearReporteFin = $fechaCrearReporteFin;
        $Verano->fechaValidarReporteInicio = $fechaValidarReporteInicio;
        $Verano->fechaValidarReporteFin = $fechaValidarReporteFin;
        $Verano->estatus = $estatus;
        $rowsAfectados = $Verano->CreateUpdate();
        if($rowsAfectados > 0)
            echo '{"mensaje":"Informacion registrada correctamente","rowsAfectados":"'.$rowsAfectados.'"}';
        else
            echo '{"mensaje":"Error al registrar la informacion","rowsAfectados":"0"}';
    }    
}
else
{
    extract($_GET);
    switch ($method) {
        case 'All':
            $Verano   = new Verano();
            $rsVerano = $Verano->SelectAll("verano", "*");
            echo json_encode($rsVerano);
        break;
        case 'ById':
            $Verano     = new Verano($idVerano);
            $rsVerano   = $Verano->SelectOne("verano");
            echo json_encode($rsVerano);
        break;
         default:
             # code...
             break;
     }
}
?>
<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
require 'solicitud.class.php';
use SolicitudNamespace\Solicitud as Solicitud;
if($_POST)
{
    extract($_POST);
    $Solicitud = new Solicitud();
    if($method == 'Insert')
    {
        $cantidadSolicitudAplicada = $Solicitud->Select("select coalesce(count(idSolicitud), 0) as cantidadSolicitud from solicitud where idUsuarioAlumno=$idUsuarioAlumno and estatus=1");
        if($cantidadSolicitudAplicada[0]['cantidadSolicitud'] == $_SESSION['solicitudesPorAlumno'])
        {
            die('{"mensaje":"Error número de solicitudes permitidas alcanzado","IdInsertado":"0"}');
        }
        $solicitudAplicada = $Solicitud->Select("select coalesce(idSolicitud, 0) as SolicitudExistente from solicitud where idUsuarioAlumno=$idUsuarioAlumno and idProyecto=$idProyecto and estatus=1");
        if($solicitudAplicada[0]['SolicitudExistente'] != "0" && $solicitudAplicada[0]['SolicitudExistente'] != "")
        {
            die('{"mensaje":"Error la solicitud ya fue aplicada","IdInsertado":"0"}');
        }
        $Solicitud->idSolicitud = 0;
        $Solicitud->comentario = $comentario;
        $Solicitud->numeroVuelta = $numeroVuelta;
        $Solicitud->idProyecto = $idProyecto;
        $rsOrden = $Solicitud->Select("SELECT COALESCE(max(orden)+1, 1) as orden FROM `solicitud` WHERE estatus=1 and idUsuarioAlumno = ".$idUsuarioAlumno);
        $Solicitud->orden = $rsOrden[0]['orden'];
        $Solicitud->idVerano = $idVerano;
        $Solicitud->idUsuarioAlumno = $idUsuarioAlumno;
        $Solicitud->fechaCreacion = date("Y-m-d H:i:s");
        $Solicitud->fechaModifica = date("Y-m-d H:i:s");
        $Solicitud->estatus =   1;
        $idInsertado =  $Solicitud->CreateInsert();
        if($idInsertado > 0)
            echo '{"mensaje":"Informacion registrada correctamente","IdInsertado":"'.$idInsertado.'"}';
        else
            echo '{"mensaje":"Error al registrar la informacion","IdInsertado":"0"}';
    }
    else if($method == 'Update') 
    {
        $Solicitud->idSolicitud = $idSolicitud;
        $Solicitud->comentario = $comentario;
        //$Solicitud->numeroVuelta = $numeroVuelta;
        $Solicitud->idProyecto = $idProyecto;
        //$Solicitud->orden = $orden;
        //$Solicitud->idVerano = $idVerano;
        //$Solicitud->idUsuarioAlumno = $idUsuarioAlumno;
        $Solicitud->fechaModifica = date("Y-m-d H:i:s");
        //$Solicitud->estatus = $estatus;
        $rowsAfectados = $Solicitud->CreateUpdate();
        if($rowsAfectados > 0)
            echo '{"mensaje":"Informacion registrada correctamente","rowsAfectados":"'.$rowsAfectados.'"}';
        else
            echo '{"mensaje":"Error al registrar la informacion","rowsAfectados":"0"}';
    }
    else if($method == 'Delete') {
        $Solicitud->idSolicitud = $idSolicitud;
        $rowsAfectados = $Solicitud->CreateDelete();
        if($rowsAfectados > 0)
            echo '{"mensaje":"Informacion eliminada correctamente","rowsAfectados":"'.$rowsAfectados.'"}';
        else
            echo '{"mensaje":"Error al eliminar la informacion","rowsAfectados":"0"}';
    }
    else if($method == 'ActualizaOrden')
    {
        $Solicitud = new Solicitud($idSolicitud);
        if($orden == 'arriba')
        {
            if($Solicitud->orden == 1)
            {
                echo '{"mensaje": "La solicitud ya tiene la prioridad mas alta"}';
            }
            else
            {
                $sql = "select idSolicitud from solicitud where idUsuarioAlumno=".$Solicitud->idUsuarioAlumno." and orden= ".($Solicitud->orden-1);
                //echo $sql;
                $rsSolicitudAnterior = $Solicitud->Select($sql);
                $auxiliarOrden = $Solicitud->orden;
                //echo $auxiliarOrden;
                //echo $rsSolicitudAnterior[0]['idSolicitud'];
                $SolicitudAnterior = new Solicitud($rsSolicitudAnterior[0]['idSolicitud']);
                //echo $SolicitudAnterior->orden;
                $Solicitud->orden = $SolicitudAnterior->orden;
                $SolicitudAnterior->orden = $auxiliarOrden;
                if($Solicitud->CreateUpdate() > 0 && $SolicitudAnterior->CreateUpdate() > 0)
                {
                    echo '{"mensaje": "Se actualizo la prioridad de la solicitud"}'; 
                }
                else
                {
                    echo '{"mensaje": "Error al actualizar la prioridad de la solicitud"}';
                }
            }
        }
        else
        {
            if($Solicitud->orden == 3)
            {
                echo '{"mensaje": "La solicitud ya tiene la prioridad mas baja"}';
            }
            else
            {
                $sql = "select idSolicitud from solicitud where idUsuarioAlumno=".$Solicitud->idUsuarioAlumno." and orden= ".($Solicitud->orden+1);
                //echo $sql;
                $rsSolicitudSiguiente = $Solicitud->Select($sql);
                $auxiliarOrden = $Solicitud->orden;
                //echo $auxiliarOrden;
                //echo $rsSolicitudSiguiente[0]['idSolicitud'];
                $SolicitudSiguiente = new Solicitud($rsSolicitudSiguiente[0]['idSolicitud']);
                //echo $SolicitudSiguiente->orden;
                $Solicitud->orden = $SolicitudSiguiente->orden;
                $SolicitudSiguiente->orden = $auxiliarOrden;
                if($Solicitud->CreateUpdate() > 0 && $SolicitudSiguiente->CreateUpdate() > 0)
                {
                    echo '{"mensaje": "Se actualizo la prioridad de la solicitud"}'; 
                }
                else
                {
                    echo '{"mensaje": "Error al actualizar la prioridad de la solicitud"}';
                }
            }
        }
    }
}
else
{
    extract($_GET);
    switch ($method) {
        case 'All':
            $Solicitud   = new Solicitud();
            $rsSolicitud = $Solicitud->SelectAll("solicitud", "*");
            echo json_encode($rsSolicitud);
        break;
        case 'ById':
            $Solicitud     = new Solicitud($idSolicitud);
            $rsSolicitud   = $Solicitud->SelectOne("solicitud");
            echo json_encode($rsSolicitud);
        break;
         default:
             # code...
             break;
     }
}
?>
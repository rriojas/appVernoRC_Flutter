<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
require 'solicitudaceptada.class.php';
use SolicitudAceptadaNamespace\SolicitudAceptada as SolicitudAceptada;
 ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
if($_POST)
{
    extract($_POST);
    $SolicitudAceptada = new SolicitudAceptada();
   /* if($method == 'Insert')
    {
        $cantidadSolicitudAceptadaAplicada = $SolicitudAceptada->Select("select coalesce(count(idSolicitudAceptada), 0) as cantidadSolicitudAceptada from SolicitudAceptada where idUsuarioAlumno=$idUsuarioAlumno and estatus=1");
        if($cantidadSolicitudAceptadaAplicada[0]['cantidadSolicitudAceptada'] == $_SESSION['SolicitudAceptadaesPorAlumno'])
        {
            die('{"mensaje":"Error número de SolicitudAceptadaes permitidas alcanzado","IdInsertado":"0"}');
        }
        $SolicitudAceptadaAplicada = $SolicitudAceptada->Select("select coalesce(idSolicitudAceptada, 0) as SolicitudAceptadaExistente from SolicitudAceptada where idUsuarioAlumno=$idUsuarioAlumno and idProyecto=$idProyecto and estatus=1");
        if($SolicitudAceptadaAplicada[0]['SolicitudAceptadaExistente'] != "0" && $SolicitudAceptadaAplicada[0]['SolicitudAceptadaExistente'] != "")
        {
            die('{"mensaje":"Error la SolicitudAceptada ya fue aplicada","IdInsertado":"0"}');
        }
        $SolicitudAceptada->idSolicitudAceptada = 0;
        $SolicitudAceptada->comentario = $comentario;
        $SolicitudAceptada->numeroVuelta = $numeroVuelta;
        $SolicitudAceptada->idProyecto = $idProyecto;
        $rsOrden = $SolicitudAceptada->Select("SELECT COALESCE(max(orden)+1, 1) as orden FROM `SolicitudAceptada` WHERE estatus=1 and idUsuarioAlumno = ".$idUsuarioAlumno);
        $SolicitudAceptada->orden = $rsOrden[0]['orden'];
        $SolicitudAceptada->idVerano = $idVerano;
        $SolicitudAceptada->idUsuarioAlumno = $idUsuarioAlumno;
        $SolicitudAceptada->fechaCreacion = date("Y-m-d H:i:s");
        $SolicitudAceptada->fechaModifica = date("Y-m-d H:i:s");
        $SolicitudAceptada->estatus =   1;
        $idInsertado =  $SolicitudAceptada->CreateInsert();
        if($idInsertado > 0)
            echo '{"mensaje":"Informacion registrada correctamente","IdInsertado":"'.$idInsertado.'"}';
        else
            echo '{"mensaje":"Error al registrar la informacion","IdInsertado":"0"}';
    }
    else if($method == 'Update') 
    {
        $SolicitudAceptada->idSolicitudAceptada = $idSolicitudAceptada;
        $SolicitudAceptada->comentario = $comentario;
        //$SolicitudAceptada->numeroVuelta = $numeroVuelta;
        $SolicitudAceptada->idProyecto = $idProyecto;
        //$SolicitudAceptada->orden = $orden;
        //$SolicitudAceptada->idVerano = $idVerano;
        //$SolicitudAceptada->idUsuarioAlumno = $idUsuarioAlumno;
        $SolicitudAceptada->fechaModifica = date("Y-m-d H:i:s");
        //$SolicitudAceptada->estatus = $estatus;
        $rowsAfectados = $SolicitudAceptada->CreateUpdate();
        if($rowsAfectados > 0)
            echo '{"mensaje":"Informacion registrada correctamente","rowsAfectados":"'.$rowsAfectados.'"}';
        else
            echo '{"mensaje":"Error al registrar la informacion","rowsAfectados":"0"}';
    }
    else if($method == 'Delete') {
        $SolicitudAceptada->idSolicitudAceptada = $idSolicitudAceptada;
        $rowsAfectados = $SolicitudAceptada->CreateDelete();
        if($rowsAfectados > 0)
            echo '{"mensaje":"Informacion eliminada correctamente","rowsAfectados":"'.$rowsAfectados.'"}';
        else
            echo '{"mensaje":"Error al eliminar la informacion","rowsAfectados":"0"}';
    }
    else if($method == 'ActualizaOrden')
    {
        $SolicitudAceptada = new SolicitudAceptada($idSolicitudAceptada);
        if($orden == 'arriba')
        {
            if($SolicitudAceptada->orden == 1)
            {
                echo '{"mensaje": "La SolicitudAceptada ya tiene la prioridad mas alta"}';
            }
            else
            {
                $sql = "select idSolicitudAceptada from SolicitudAceptada where idUsuarioAlumno=".$SolicitudAceptada->idUsuarioAlumno." and orden= ".($SolicitudAceptada->orden-1);
                //echo $sql;
                $rsSolicitudAceptadaAnterior = $SolicitudAceptada->Select($sql);
                $auxiliarOrden = $SolicitudAceptada->orden;
                //echo $auxiliarOrden;
                //echo $rsSolicitudAceptadaAnterior[0]['idSolicitudAceptada'];
                $SolicitudAceptadaAnterior = new SolicitudAceptada($rsSolicitudAceptadaAnterior[0]['idSolicitudAceptada']);
                //echo $SolicitudAceptadaAnterior->orden;
                $SolicitudAceptada->orden = $SolicitudAceptadaAnterior->orden;
                $SolicitudAceptadaAnterior->orden = $auxiliarOrden;
                if($SolicitudAceptada->CreateUpdate() > 0 && $SolicitudAceptadaAnterior->CreateUpdate() > 0)
                {
                    echo '{"mensaje": "Se actualizo la prioridad de la SolicitudAceptada"}'; 
                }
                else
                {
                    echo '{"mensaje": "Error al actualizar la prioridad de la SolicitudAceptada"}';
                }
            }
        }
        else
        {
            if($SolicitudAceptada->orden == 3)
            {
                echo '{"mensaje": "La SolicitudAceptada ya tiene la prioridad mas baja"}';
            }
            else
            {
                $sql = "select idSolicitudAceptada from SolicitudAceptada where idUsuarioAlumno=".$SolicitudAceptada->idUsuarioAlumno." and orden= ".($SolicitudAceptada->orden+1);
                //echo $sql;
                $rsSolicitudAceptadaSiguiente = $SolicitudAceptada->Select($sql);
                $auxiliarOrden = $SolicitudAceptada->orden;
                //echo $auxiliarOrden;
                //echo $rsSolicitudAceptadaSiguiente[0]['idSolicitudAceptada'];
                $SolicitudAceptadaSiguiente = new SolicitudAceptada($rsSolicitudAceptadaSiguiente[0]['idSolicitudAceptada']);
                //echo $SolicitudAceptadaSiguiente->orden;
                $SolicitudAceptada->orden = $SolicitudAceptadaSiguiente->orden;
                $SolicitudAceptadaSiguiente->orden = $auxiliarOrden;
                if($SolicitudAceptada->CreateUpdate() > 0 && $SolicitudAceptadaSiguiente->CreateUpdate() > 0)
                {
                    echo '{"mensaje": "Se actualizo la prioridad de la SolicitudAceptada"}'; 
                }
                else
                {
                    echo '{"mensaje": "Error al actualizar la prioridad de la SolicitudAceptada"}';
                }
            }
        }
    }*/
}
else
{
    extract($_GET);
    $filtro="";
$idTipoUsuario=$_SESSION["idTipoUsuario"];
$idInstitucion=$_SESSION["idInstitucion"];
$idCampus=$_SESSION["idCampus"];
$idUsuario=$_SESSION["idUsuario"];
switch($idTipoUsuario)
{
    case 1: $filtro=""; break;
    case 2: $filtro="idInstitucionAlumno=".$idInstitucion ." or idInstitucionInvestigador=".$idInstitucion; 
    break;
    case 3: $filtro="idCampusAlumno=".$idCampus." or idCampusInvestigador=".$idCampus;
    break;
    case 4: $filtro="idUsuarioInvestigador=".$idUsuario;break;  // es el id de la tabla usuario
    case 5: $filtro="idUsuarioAlumno=".$idUsuario; break; // es el  id de la tabla usuario
}

$SolicitudAceptada   = new SolicitudAceptada();
$rsSolicitudAceptada = $SolicitudAceptada->SelectAll("solicitudaceptada", "titulo as 'Titulo del Proyecto', modalidad as 'Modalidad', nombreInvestigador as 'Nombre del investigador', nombreInstitucionInvestigador as 'Institucion del Investigador', correoInvestigador as 'Correo del Investigador', nombreAlumno as 'Nombre del Alumno', correoAlumno as 'Correo del Alumno', nombreInstitucionAlumno as 'Institucion del Alumno'", $filtro ," order by titulo, nombreAlumno");
echo json_encode($rsSolicitudAceptada);
}
?>
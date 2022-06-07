<?php
header('Content-Type: application/json; charset=utf-8');
if (session_status() != PHP_SESSION_ACTIVE)
session_start();
require 'investigador.class.php';
use InvestigadorNamespace\Investigador as Investigador;
if($_POST)
{
    extract($_POST);
    $Investigador = new Investigador();
    if($method == 'Insert')
    {
        $Investigador->idInvestigador = 0;
        $Investigador->titulo = $titulo;
        $Investigador->departamento = $departamento;
        $Investigador->nivelSNI = $nivelSNI;
        $Investigador->PRODEP = $PRODEP;
        $Investigador->idUsuario = $idUsuario;
        $Investigador->fechaCreacion = date("Y-m-d H:i:s");
        $Investigador->fechaModifica = date("Y-m-d H:i:s");
        $Investigador->estatus =   1;
        $idInsertado =  $Investigador->CreateInsert();
        if($idInsertado > 0)
            echo '{"mensaje":"Informacion registrada correctamente","IdInsertado":"'.$idInsertado.'"}';
        else
            echo '{"mensaje":"Error al registrar la informacion","IdInsertado":"0"}';
    }
    else if($method == 'Update') 
    {
        $Investigador->idInvestigador = $idInvestigador;
        $Investigador->titulo = $titulo;
        $Investigador->departamento = $departamento;
        $Investigador->nivelSNI = $nivelSNI;
        $Investigador->PRODEP = $PRODEP;
        $Investigador->idUsuario = $idUsuario;
        $Investigador->fechaModifica = date("Y-m-d H:i:s");
        $rowsAfectados = $Investigador->CreateUpdate();
        if($rowsAfectados > 0)
            echo '{"mensaje":"Informacion registrada correctamente","rowsAfectados":"'.$rowsAfectados.'"}';
        else
            echo '{"mensaje":"Error al registrar la informacion","rowsAfectados":"0"}';
    }
    else if($method == 'Delete') {
        $Investigador->idInvestigador = $idInvestigador;
        $rowsAfectados = $Investigador->CreateDelete();
        if($rowsAfectados > 0)
            echo '{"mensaje":"Informacion eliminada correctamente","rowsAfectados":"'.$rowsAfectados.'"}';
        else
            echo '{"mensaje":"Error al eliminar la informacion","rowsAfectados":"0"}';
    } 
}
else
{
    extract($_GET);
$Investigador =       new Investigador();
//$rsInvestigador =     $Investigador->Select("select * from vw_investigador where estatus=1");
if($_SESSION['idTipoUsuario'] == "1"){
  $rsInvestigador = $Investigador->SelectAll("vw_investigador", "idInvestigador, usuario as Nombre, telefono as Teléfono, correo as Correo, cantidadProyecto as 'Proyectos registrados', concat(campus, ' - ', institucion) as campus, validado ", "estatus=1");
    //$rsInvestigador =     $Investigador->Select("select idInvestigador, usuario, telefono, correo, validado, concat(campus, ' - ', institucion) as campus from vw_investigador where estatus=1");
    echo json_encode($rsInvestigador);

}else if($_SESSION['idTipoUsuario'] == "2"){ //coordinador institucional
    $rsInvestigador = $Investigador->SelectAll("vw_investigador", "idInvestigador, usuario, telefono, correo, cantidadProyecto as 'Proyectos registrados', concat(campus, ' - ', institucion) as campus, validado ", "estatus=1 and idInstitucion=".$_SESSION['idInstitucion']);
    //$rsInvestigador =     $Investigador->Select("select idInvestigador, usuario, telefono, correo, validado, concat(campus, ' - ', institucion) as campus from vw_investigador where estatus=1 and idInstitucion=".$_SESSION['idInstitucion']);
    echo json_encode($rsInvestigador);
}else if($_SESSION['idTipoUsuario'] == "3"){
    $rsInvestigador = $Investigador->SelectAll("vw_investigador", "idInvestigador, usuario, telefono, correo, cantidadProyecto as 'Proyectos registrados', concat(campus, ' - ', institucion) as campus, validado ", "estatus=1 and idCampus=".$_SESSION['idCampus']);
  
    //$rsInvestigador =     $Investigador->Select("select idInvestigador, usuario, telefono, correo, validado, concat(campus, ' - ', institucion) as campus from vw_investigador where estatus=1 and idCampus=".$_SESSION['idCampus']);

    echo json_encode($rsInvestigador);}else 
  die('No tienes permiso de estar aqui');
}
?>
<?php
header('Content-Type: application/json; charset=utf-8');
require 'coordinador.class.php';
use CoordinadorNamespace\Coordinador as Coordinador;
if($_POST)
{
    extract($_POST);
    $Coordinador = new Coordinador();
    if($method == 'Insert')
    {
        $Coordinador->idCoordinador = 0;
        $Coordinador->puesto =   $puesto;
        $Coordinador->esCoordinadorInstitucional = $esCoordinadorInstitucional;
        $Coordinador->idUsuario =   $idUsuario;
        $Coordinador->fechaCreacion = date("Y-m-d H:i:s");
        $Coordinador->fechaModifica = date("Y-m-d H:i:s");
        $Coordinador->estatus =   1;
        $idInsertado =  $Coordinador->CreateInsert();
        if($idInsertado > 0)
            echo '{"mensaje":"Informacion registrada correctamente","IdInsertado":"'.$idInsertado.'"}';
        else
            echo '{"mensaje":"Error al registrar la informacion","IdInsertado":"0"}';
    }
    else if($method == 'Update') 
    {
        $Coordinador->idCoordinador = $idCoordinador;
        $Coordinador->puesto = $puesto;
        $Coordinador->esCoordinadorInstitucional = $esCoordinadorInstitucional;
        $Coordinador->idUsuario =   $idUsuario;
        $Coordinador->fechaModifica = date("Y-m-d H:i:s");
        $rowsAfectados = $Coordinador->CreateUpdate();
        if($rowsAfectados > 0)
            echo '{"mensaje":"Informacion registrada correctamente","rowsAfectados":"'.$rowsAfectados.'"}';
        else
            echo '{"mensaje":"Error al registrar la informacion","rowsAfectados":"0"}';
    }
    else if($method == 'Delete') {
        $Coordinador->idCoordinador = $idCoordinador;
        $rowsAfectados = $Coordinador->CreateDelete();
        if($rowsAfectados > 0)
            echo '{"mensaje":"Informacion eliminada correctamente","rowsAfectados":"'.$rowsAfectados.'"}';
        else
            echo '{"mensaje":"Error al eliminar la informacion","rowsAfectados":"0"}';
    }
}
else
{
    extract($_GET);
    switch ($method) {
        case 'All':
            $Coordinador   = new Coordinador();
            $rsCoordinador = $Coordinador->SelectAll("coordinador", "*");
            echo json_encode($rsCoordinador);
        break;
        case 'ById':
            $Coordinador     = new Coordinador($idCoordinador);
            $rsCoordinador   = $Coordinador->SelectOne("coordinador");
            echo json_encode($rsCoordinador);
        break;
         default:
             # code...
             break;
     }
}
?>
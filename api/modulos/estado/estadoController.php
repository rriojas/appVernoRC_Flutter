<?php
header('Content-Type: application/json; charset=utf-8');
require 'estado.class.php';
use EstadoNamespace\Estado as Estado;
if($_POST)
{
    extract($_POST);
    $estado = new Estado();
    if($method == 'Insert')
    {
        $estado->idEstado = 0;
        $estado->nombre =   $nombre;
        $estado->estatus =   1;
        $idInsertado =  $estado->CreateInsert();
        if($idInsertado > 0)
            echo '{"mensaje":"Informacion registrada correctamente","IdInsertado":"'.$idInsertado.'"}';
        else
            echo '{"mensaje":"Error al registrar la informacion","IdInsertado":"0"}';
    }
    else if($method == 'Update') 
    {
        $estado->idEstado = $idestado;
        $estado->nombre = $nombre;
        $estado->estatus = 1;
        $rowsAfectados = $estado->CreateUpdate();
        if($rowsAfectados > 0)
            echo '{"mensaje":"Informacion registrada correctamente","rowsAfectados":"'.$rowsAfectados.'"}';
        else
            echo '{"mensaje":"Error al registrar la informacion","rowsAfectados":"0"}';
    }
    else if($method == 'Delete') {
        $estado->idEstado = $idestado;
        $rowsAfectados = $estado->CreateDelete();
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
            $Estado   = new Estado();
            $rsEstado = $Estado->SelectAll("estado", "idEstado, nombre");
            echo json_encode($rsEstado);
        break;
        case 'ById':
            $Estado     = new Estado();
            $Estado->idEstado = $idestado;
            $Estado->nombre = '';
            $Estado->estatus = 1;
            $rsEstado   = $Estado->SelectOne("estado");
            echo json_encode($rsEstado);
        break;
         default:
             # code...
             break;
     }
}
?>
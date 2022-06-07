<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
require 'carrera.class.php';
use CarreraNamespace\Carrera as Carrera;
if($_POST)
{
    extract($_POST);
    $Carrera = new Carrera();
    if($method == 'Insert')
    {
        $Carrera->idCarrera = 0;
        $Carrera->nombre =   $nombre;
        $Carrera->idCampus =   $_SESSION['idCampus'];
        $Carrera->estatus =   1;
        $idInsertado =  $Carrera->CreateInsert();
        if($idInsertado > 0)
            echo '{"mensaje":"Informacion registrada correctamente","IdInsertado":"'.$idInsertado.'"}';
        else
            echo '{"mensaje":"Error al registrar la informacion","IdInsertado":"0"}';
    }
    else if($method == 'Update') 
    {
        $Carrera->idCarrera = $idCarrera;
        $Carrera->nombre = $nombre;
        $Carrera->estatus = 1;
        $rowsAfectados = $Carrera->CreateUpdate();
        if($rowsAfectados > 0)
            echo '{"mensaje":"Informacion registrada correctamente","rowsAfectados":"'.$rowsAfectados.'"}';
        else
            echo '{"mensaje":"Error al registrar la informacion","rowsAfectados":"0"}';
    }
    else if($method == 'Delete') {
        $Carrera->idCarrera = $idCarrera;
        $rowsAfectados = $Carrera->CreateDelete();
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
            $Carrera   = new Carrera();
            $rsCarrera = $Carrera->SelectAll("carrera", "idCarrera, nombre");
            echo json_encode($rsCarrera);
        break;
        case 'ById':
            $Carrera     = new Carrera($idCarrera);
            $rsCarrera   = $Carrera->SelectOne("carrera");
            echo json_encode($rsCarrera);
        break;
         default:
             # code...
             break;
     }
}
?>
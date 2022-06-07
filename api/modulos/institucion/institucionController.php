<?php
header('Content-Type: application/json; charset=utf-8');
require 'institucion.class.php';
use InstitucionNamespace\Institucion as Institucion;
if($_POST)
{
    extract($_POST);
    $Institucion = new Institucion();
    if($method == 'Insert')
    {
        $Institucion->idInstitucion = 0;
        $Institucion->nombre =   $nombre;
        $Institucion->abreviatura=   $abreviatura;
        $Institucion->estatus =   1;
        $idInsertado =  $Institucion->CreateInsert();
        if($idInsertado > 0)
            echo '{"mensaje":"Informacion registrada correctamente","IdInsertado":"'.$idInsertado.'"}';
        else
            echo '{"mensaje":"Error al registrar la informacion","IdInsertado":"0"}';
    }
    else if($method == 'Update') 
    {
        $Institucion->idInstitucion = $idInstitucion;
        $Institucion->nombre =   $nombre;
        $Institucion->abreviatura=   $abreviatura;
        $rowsAfectados = $Institucion->CreateUpdate();
        if($rowsAfectados > 0)
            echo '{"mensaje":"Informacion registrada correctamente","rowsAfectados":"'.$rowsAfectados.'"}';
        else
            echo '{"mensaje":"Error al registrar la informacion","rowsAfectados":"0"}';
    }
    else if($method == 'Delete') {
        $Institucion->idInstitucion = $idInstitucion;
        $rowsAfectados = $Institucion->CreateDelete();
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
            $Institucion   = new Institucion();
            $rsInstitucion = $Institucion->SelectAll("institucion", "*");
            echo json_encode($rsInstitucion);
        break;
        case 'ById':
            $Institucion     = new Institucion($idInstitucion);
            $rsInstitucion   = $Institucion->SelectOne("institucion");
            echo json_encode($rsInstitucion);
        break;
         default:
             # code...
             break;
     }
}
?>
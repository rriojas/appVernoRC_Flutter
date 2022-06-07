<?php
header('Content-Type: application/json; charset=utf-8');
require 'municipio.class.php';
use MunicipioNamespace\Municipio as Municipio;
if($_POST)
{
    extract($_POST);
    $Municipio = new Municipio($idmunicipio);
    if($method == 'Insert')
    {
        $Municipio->idMunicipio =   0;
        $Municipio->nombre =        $nombre;
        $Municipio->idEstado =      $idestado;
        $Municipio->estatus =        1;
        $idInsertado =  $Municipio->CreateInsert();
        if($idInsertado > 0)
            echo '{"mensaje":"Informacion registrada correctamente","IdInsertado":"'.$idInsertado.'"}';
        else
            echo '{"mensaje":"Error al registrar la informacion","IdInsertado":"0"}';
    }
    else if($method == 'Update') 
    {
        $Municipio->idMunicipio = $idmunicipio;
        $Municipio->nombre = $nombre;
        $Municipio->idEstado = $idestado;
        $Municipio->estatus = 1;
        $rowsAfectados = $Municipio->CreateUpdate();
        if($rowsAfectados > 0)
            echo '{"mensaje":"Informacion registrada correctamente","rowsAfectados":"'.$rowsAfectados.'"}';
        else
            echo '{"mensaje":"Error al registrar la informacion","rowsAfectados":"0"}';
    }
    else if($method == 'Delete') {
        $Municipio->idMunicipio = $idmunicipio;
        $rowsAfectados = $Municipio->CreateDelete();
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
            $Municipio   = new Municipio();
            $rsMunicipio = $Municipio->SelectAll("municipio", "idMunicipio, nombre");
            echo json_encode($rsMunicipio);
        break;
        case 'ById':
            $Municipio   = new Municipio();
            $Municipio->idMunicipio = $idmunicipio;
            $Municipio->nombre = '';
            $Municipio->idEstado = 0;
            $Municipio->estatus = 1;
            $rsMunicipio   = $Municipio->SelectOne("municipio");
            echo json_encode($rsMunicipio);
        break;
         default:
             # code...
             break;
     }
}
?>
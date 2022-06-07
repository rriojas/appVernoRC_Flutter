<?php
header('Content-Type: application/json; charset=utf-8');
require 'documento.class.php';
use DocumentoNamespace\Documento as Documento;
if($_POST)
{
    extract($_POST);
    $Documento = new Documento();
    if($method == 'Insert')
    {
        $Documento->idDocumento = 0;
        $Documento->descripcion =   $descripcion;
        $Documento->prefijo=   $prefijo;
        $Documento->estatus =   1;
        $idInsertado =  $Documento->CreateInsert();
        if($idInsertado > 0)
            echo '{"mensaje":"Informacion registrada correctamente","IdInsertado":"'.$idInsertado.'"}';
        else
            echo '{"mensaje":"Error al registrar la informacion","IdInsertado":"0"}';
    }
    else if($method == 'Update') 
    {
        $Documento->idDocumento = $idDocumento;
        $Documento->descripcion = $descripcion;
        $Documento->prefijo=   $prefijo;
        $Documento->estatus = $estatus;
        $rowsAfectados = $Documento->CreateUpdate();
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
            $Documento   = new Documento();
            $rsDocumento = $Documento->SelectAll("documento", "idDocumento, descrpcion");
            echo json_encode($rsDocumento);
        break;
        case 'ById':
            $Documento     = new Documento($idDocumento);
            $rsDocumento   = $Documento->SelectOne("documento");
            echo json_encode($rsDocumento);
        break;
         default:
             # code...
             break;
     }
}
?>
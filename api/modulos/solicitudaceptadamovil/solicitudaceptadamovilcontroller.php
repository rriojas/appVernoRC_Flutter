<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
require 'solicitudaceptada.class.php';
use SolicitudAceptadaNamespace\SolicitudAceptada as SolicitudAceptada;
if($_POST)
{
    /* 
    extract($_POST);
    $TipoUsuarioModulo = new TipoUsuarioModulo();
    if($method == 'Insert')
    {
        $TipoUsuarioModulo->$idtipousuariomodulo = 0;
        $TipoUsuarioModulo->idtipousuario = $idtipousuario;
        $TipoUsuarioModulo->idmodulo = $idmodulo;
        $TipoUsuarioModulo->estatus =   1;
        $idInsertado =  $TipoUsuarioModulo->CreateInsert();
        if($idInsertado > 0)
            echo '{"mensaje":"Informacion registrada correctamente","IdInsertado":"'.$idInsertado.'"}';
        else
            echo '{"mensaje":"Error al registrar la informacion","IdInsertado":"0"}';
    }
    else if($method == 'Update') 
    {
        $TipoUsuarioModulo->$idtipousuariomodulo = $idtipousuariomodulo;
        $TipoUsuarioModulo->idtipousuario = $idtipousuario;
        $TipoUsuarioModulo->idmodulo = $idmodulo;
        $TipoUsuarioModulo->estatus = $estatus;
        $rowsAfectados = $TipoUsuarioModulo->CreateUpdate();
        if($rowsAfectados > 0)
            echo '{"mensaje":"Informacion registrada correctamente","rowsAfectados":"'.$rowsAfectados.'"}';
        else
            echo '{"mensaje":"Error al registrar la informacion","rowsAfectados":"0"}';
    }    */ 
}
else
{
    extract($_GET);
    
    extract($_GET);
    switch ($method) {
        case 'All':
            $SolicitudAceptada   = new SolicitudAceptada();
            $rsSolicitudAceptada = $SolicitudAceptada->SelectAll("solicitudaceptada", "*");
            echo json_encode($rsSolicitudAceptada);
        break;
        case 'ById':
            $SolicitudAceptada     = new SolicitudAceptada($idSolicitudAceptada);
            $rsSolicitudAceptada   = $SolicitudAceptada->SelectOne("solicitudaceptada");
            echo json_encode($rsSolicitudAceptada);
        break;
         default:
             # code...
             break;
     }
}
?>
<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
require 'tipousuariomodulo.class.php';
use TipoUsuarioModuloNamespace\TipoUsuarioModulo as TipoUsuarioModulo;
require 'solicitudaceptada.class.php';
use SolicitudAceptadaNamespace\SolicitudAceptada as SolicitudAceptada;
if($_POST)
{
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
    }    
}
else
{
    extract($_GET);
    switch ($method) {
        case 'All':
            $SolicitudAceptada   = new SolicitudAceptada();
            $rsSolicitudAceptada = $SolicitudAceptada->SelectAll("solicitudaceptada", "*");
            echo json_encode($rsSolicitudAceptada);
        break;
        case 'ById':
            $TipoUsuarioModulo     = new TipoUsuarioModulo($idTipoUsuarioModulo);
            $rsTipoUsuarioModulo   = $TipoUsuarioModulo->SelectOne("tipousuariomodulo");
            echo json_encode($rsTipoUsuarioModulo);
        break;//
        case 'ByIdTipoUsuario':
            if(!isset($_SESSION['idTipoUsuario']) && !isset($_GET['idTipoUsuario']))
            {
                die('{"error":"true","mensaje":"Error, no tienes permiso de estar aqui."}');
            }
            $idTipoUsuario = $_SESSION['idTipoUsuario'];
            $TipoUsuarioModulo     = new TipoUsuarioModulo();
            $rsTipoUsuarioModulo   = $TipoUsuarioModulo->Select("select * from vw_tipousuariomodulo where estatus=1 and idtipousuario=$idTipoUsuario order by nombre");
            $_SESSION['moduloPermitido'] = $rsTipoUsuarioModulo;
            echo json_encode($rsTipoUsuarioModulo);
        break;
        default:
             # code...
        break;
     }
}
?>
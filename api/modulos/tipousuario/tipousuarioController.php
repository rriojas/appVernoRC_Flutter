<?php
header('Content-Type: application/json; charset=utf-8');
require 'tipousuario.class.php';
use TipoUsuarioNamespace\TipoUsuario as TipoUsuario;
if($_POST)
{
    extract($_POST);
    $TipoUsuario = new TipoUsuario();
    if($method == 'Insert')
    {
        $TipoUsuario->idTipoUsuario = 0;
        $TipoUsuario->descripcion = $descripcion;
        $TipoUsuario->estatus =   1;
        $idInsertado =  $TipoUsuario->CreateInsert();
        if($idInsertado > 0)
            echo '{"mensaje":"Informacion registrada correctamente","IdInsertado":"'.$idInsertado.'"}';
        else
            echo '{"mensaje":"Error al registrar la informacion","IdInsertado":"0"}';
    }
    else if($method == 'Update') 
    {
        $TipoUsuario->idTipoUsuario = $idTipoUsuario;
        $TipoUsuario->descripcion = $descripcion;
        $TipoUsuario->estatus = $estatus;
        $rowsAfectados = $TipoUsuario->CreateUpdate();
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
            $TipoUsuario   = new TipoUsuario();
            $rsTipoUsuario = $TipoUsuario->SelectAll("tipousuario", "*");
            echo json_encode($rsTipoUsuario);
        break;
        case 'ById':
            $TipoUsuario     = new TipoUsuario($idTipoUsuario);
            $rsTipoUsuario   = $TipoUsuario->SelectOne("tipousuario");
            echo json_encode($rsTipoUsuario);
        break;
         default:
             # code...
             break;
     }
}
?>
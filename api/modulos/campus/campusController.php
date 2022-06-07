<?php
header('Content-Type: application/json; charset=utf-8');
if (session_status() != PHP_SESSION_ACTIVE)
session_start();
require 'campus.class.php';
//include '../../lib/CommonFunc.class.php';
use CampusNamespace\Campus as Campus;
//use CommonFuncNamespace\CommonFunc as   CommonFunc;
if($_POST)
{
    extract($_POST);
    $Campus = new Campus();
    if($method == 'Insert')
    {
        $Campus->idCampus = 0;
        $Campus->nombre =   $nombre;
        $Campus->abreviaturaCampus = $abreviaturaCampus;
        $Campus->idInstitucion = $idInstitucion;
        $Campus->idMunicipio = $idMunicipio;
        $Campus->estatus =   1;
        $idInsertado =  $Campus->CreateInsert();
        if($idInsertado > 0)
            echo '{"mensaje":"Informacion registrada correctamente","IdInsertado":"'.$idInsertado.'"}';
        else
            echo '{"mensaje":"Error al registrar la informacion","IdInsertado":"0"}';
    }
    else if($method == 'Update') 
    {
        $Campus->idCampus = $idCampus;
        $Campus->nombre =   $nombre;
        $Campus->abreviaturaCampus = $abreviaturaCampus;
        $Campus->idInstitucion = $idInstitucion;
        $Campus->idMunicipio = $idMunicipio;
        $rowsAfectados = $Campus->CreateUpdate();
        if($rowsAfectados > 0)
            echo '{"mensaje":"Informacion registrada correctamente","rowsAfectados":"'.$rowsAfectados.'"}';
        else
            echo '{"mensaje":"Error al registrar la informacion","rowsAfectados":"0"}';
    } 
    else if($method == 'Delete') {
        $Campus->idCampus = $idCampus;
        $rowsAfectados = $Campus->CreateDelete();
        if($rowsAfectados > 0)
            echo '{"mensaje":"Informacion eliminada correctamente","rowsAfectados":"'.$rowsAfectados.'"}';
        else
            echo '{"mensaje":"Error al eliminar la informacion","rowsAfectados":"0"}';
    }
}
else
{
    extract($_GET);
   
    $campus =       new Campus();
    if($_SESSION['idTipoUsuario'] == "1"){
      $rsCampus = $campus->SelectAll("vw_campus", "idCampus, nombre as Nombre, institucion as Institucion, municipio as Municipio");
     echo json_encode($rsCampus);
    } else if($_SESSION['idTipoUsuario'] == "2"){ //coordinador investigador
      $rsCampus = $campus->SelectAll("vw_campus", "idCampus, nombre as Nombre, institucion as Institucion, municipio as Municipio", "idInstitucion=".$_SESSION['idInstitucion']);
      echo json_encode($rsCampus); 
    }else if($_SESSION['idTipoUsuario'] == "3"){ //coordinador investigador
      $rsCampus = $campus->SelectAll("vw_campus", "idCampus, nombre as Nombre, institucion as Institucion, municipio as Municipio", "idCampus=".$_SESSION['idCampus']);
      echo json_encode($rsCampus); 
    }else 
      die('No tienes permiso de estar aqui');
      header("");
   
}
?>
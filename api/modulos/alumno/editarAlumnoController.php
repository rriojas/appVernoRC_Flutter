<?php
header('Content-Type: application/json; charset=utf-8');
if(session_status() != PHP_SESSION_ACTIVE)
session_start();
include '../usuario/usuario.class.php';
include 'alumno.class.php';
use UsuarioNamespace\Usuario as           Usuario;
use AlumnoNamespace\Alumno as   Alumno;
use CommonFuncNamespace\CommonFunc as   CommonFunc;

$funciones =    new CommonFunc();
$id =           0;
if($_POST && isset($_POST['id']))
{
  $id =   $_POST['id'];
  $Alumno =       new Alumno($id);
  //$AlumnoVal =    $Alumno->GetValues();
}
else
{
  $Alumno = new Alumno();
}
//
//$Usuario = new Usuario();
if(isset($_POST['idUsuario']))
  $idUsuario = $_POST['idUsuario'];
if(isset($idUsuario))
{
    $Usuario =      new Usuario($idUsuario);
}
else if($id != 0)
{
    $Usuario =      new Usuario($Alumno->idUsuario);
    $idUsuario = $Alumno->idUsuario;
}
else
{
  die('No tienes permiso de estar aqui');
}
$optCarrera = $Usuario->Select("select idCarrera as id, nombre as descripcion from carrera where estatus = 1 and idCampus=".$Usuario->idCampus);
$count = count($optCarrera);

$temp = array();

for ($i = 1; $i < $count; $i++) {

  $b = utf8_decode($optCarrera[$i]['descripcion']);
  

  $a = array("id"=> $optCarrera[$i]['id'],"descripcion"=> $b );
  
  
 array_push($temp , $a);

 
}
 




$response =  array();
 $response['optCarrera'] = $temp ; 
$response['Alumno'] = $Alumno;


echo json_encode($response);




?>
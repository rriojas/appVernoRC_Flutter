<?php
if(session_status() != PHP_SESSION_ACTIVE)
  session_start();
include 'usuario.class.php';
use UsuarioNamespace\Usuario as           Usuario;
use CommonFuncNamespace\CommonFunc as   CommonFunc;
$Usuario =      new Usuario();
$funciones =    new CommonFunc();
$id =           0;
$idTipoUsuario = 0;
if($_POST && isset($_POST['id']))
{
    $id =   $_POST['id'];
    $Usuario =       new Usuario($id);
    $idTipoUsuario = $Usuario->idTipoUsuario;
    //$UsuarioVal =    $Usuario->GetValues();
}
else
{
    $Usuario = new Usuario();
}
if($_POST && isset($_POST['idTipoUsuario']))
{
  $idTipoUsuario = $_POST['idTipoUsuario'];
}
else if($id == 0)
{
  echo "Acceso no autorizado<br/>";
    die('<button id="btnCancelar" type="button" class="btn btn-outline-secondary">Aceptar</button>');
}
$sql = "";
if(isset($_SESSION['idTipoUsuario']) && $_SESSION['idTipoUsuario'] == "2")
{
    $sql = "Select idInstitucion as id, nombre as descripcion from institucion where estatus = 1 AND idInstitucion >1 AND idInstitucion=".$_SESSION['idInstitucion']." order by descripcion";
}
else
{
    $sql = "Select idInstitucion as id, nombre as descripcion from institucion where estatus = 1 AND idInstitucion >1 order by descripcion";
}
$rsInstitucion = $Usuario->Select($sql);
//echo json_encode($rsInstitucion);
//$optInstitucion = $funciones->ArrayToOption($rsInstitucion, $rsInstitucion[0]['id']);
$rsOptUsuario = $Usuario->Select("select idCampus as id, nombre as descripcion from campus where estatus = 1 AND idCampus > 1 and idInstitucion=".$rsInstitucion[0]['id']);
$response =  array();

$count1 = count($rsInstitucion);
$temp1 = array();

for ($i = 0; $i < $count1; $i++) {

  $c = utf8_decode($rsInstitucion[0]['descripcion']);
  $d = array("id"=> $rsInstitucion[0]['id'],"descripcion"=> $c );
 array_push($temp1 , $d);

 
}

$response['instituciones'] = $temp1 ;
$count2 = count($rsOptUsuario);
$temp2 = array();

for ($i = 0; $i < $count2; $i++) {

  $b = utf8_decode($rsOptUsuario[$i]['descripcion']);
  $a = array("id"=> $rsOptUsuario[$i]['id'],"descripcion"=> $b );
  
  
 array_push($temp2 , $a);

 
}

$response['campus'] = $temp2;

echo json_encode($response);



?>
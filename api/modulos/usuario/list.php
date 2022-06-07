<?php
if (session_status() != PHP_SESSION_ACTIVE)
  session_start();
header('Content-Type: application/html; charset=utf-8');
include 'usuario.class.php';
use UsuarioNamespace\Usuario as           Usuario;
use CommonFuncNamespace\CommonFunc as   CommonFunc;
$usuario =       new Usuario();
$funciones =    new CommonFunc();
//$rsUsuario =     $usuario->SelectAll("usuario", "*");
if($_SESSION['idTipoUsuario'] == "1")
  $rsUsuario = $usuario->SelectAll("usuario", "idUsuario, concat(nombre,' ', apellidoPaterno,' ', apellidoMaterno) as Nombre, (select descripcion from tipousuario where idTipoUsuario=usuario.idTipoUsuario) as Tipo "," estatus=1");
else if($_SESSION['idTipoUsuario'] == "2") //coordinador institucional
  $rsUsuario = $usuario->SelectAll("usuario", "idUsuario, concat(nombre,' ', apellidoPaterno,' ', apellidoMaterno) as Nombre, (select descripcion from tipousuario where idTipoUsuario=usuario.idTipoUsuario) as Tipo ", " estatus=1 and idCampus in (select idCampus from campus where estatus=1 and idInstitucion=".$_SESSION['idInstitucion'].')');
else if($_SESSION['idTipoUsuario'] == "3") //coordinador campus
  $rsUsuario = $usuario->SelectAll("usuario","idUsuario, concat(nombre,' ', apellidoPaterno,' ', apellidoMaterno) as Nombre, (select descripcion from tipousuario where idTipoUsuario=usuario.idTipoUsuario) as Tipo ", " estatus=1 and idCampus=".$_SESSION['idCampus']);
else 
  die('No tienes permiso de estar aqui');
?>
<h4>Administracion de Usuarios</h4>
<div class="col-sm-12 mb-2 text-right">
    <button id="btnAgregar" class="btn btn-primary">Agregar nuevo <span class="fas fa-plus-circle"></span></button>
</div>
<?php
    echo $funciones->ArrayToTable($rsUsuario, "buttonDelete");
?>
<?php
header('Content-Type: application/json; charset=utf-8');
if (session_status() != PHP_SESSION_ACTIVE)
session_start();

require 'alumno.class.php';
use AlumnoNamespace\Alumno as Alumno;
$idTipoUsuario=$_SESSION["idTipoUsuario"];
if($_POST)
{
    extract($_POST);
    $Alumno = new Alumno();
    if($method == 'Insert')
    {
        $Alumno->idAlumno = 0;
        $Alumno->matricula = $matricula;
        $Alumno->CURP = $CURP;
        $Alumno->semestre = $semestre;
        $Alumno->promedio = $promedio;
        $Alumno->porcentajeAvanceCarrera = $porcentajeAvanceCarrera;
        $Alumno->idCarrera = $idCarrera;
        $Alumno->nombreInvestigadorRecomienda = $nombreInvestigadorRecomienda;
        $Alumno->telefonoInvestigadorRecomienda = $telefonoInvestigadorRecomienda;
        $Alumno->correoInvestigadorRecomienda = $correoInvestigadorRecomienda;
        $Alumno->idUsuario = $idUsuario;
        $Alumno->idVerano = $idVerano;
        $Alumno->fechaCreacion = date("Y-m-d H:i:s");
        $Alumno->fechaModifica = date("Y-m-d H:i:s");
        $Alumno->estatus = 1;
        $idInsertado =  $Alumno->CreateInsert();
        if($idInsertado > 0)
            echo '{"mensaje":"Informacion registrada correctamente","IdInsertado":"'.$idInsertado.'"}';
        else
            echo '{"mensaje":"Error al registrar la informacion","IdInsertado":"0"}';
    }
    else if($method == 'Update') 
    {
        $Alumno = new Alumno($idAlumno);
        $Alumno->matricula = $matricula;
        $Alumno->CURP = $CURP;
        $Alumno->semestre = $semestre;
        $Alumno->promedio = $promedio;
        $Alumno->porcentajeAvanceCarrera = $porcentajeAvanceCarrera;
        $Alumno->idCarrera = $idCarrera;
        $Alumno->nombreInvestigadorRecomienda = $nombreInvestigadorRecomienda;
        $Alumno->telefonoInvestigadorRecomienda = $telefonoInvestigadorRecomienda;
        $Alumno->correoInvestigadorRecomienda = $correoInvestigadorRecomienda;
        $Alumno->idUsuario = $idUsuario;
        $Alumno->idVerano = $idVerano;
        $Alumno->fechaModifica = date("Y-m-d H:i:s");
       
        $rowsAfectados = $Alumno->CreateUpdate();
        if($rowsAfectados > 0)
            echo '{"mensaje":"Informacion registrada correctamente","rowsAfectados":"'.$rowsAfectados.'"}';
        else
            echo '{"mensaje":"Error al registrar la informacion","rowsAfectados":"0"}';
    }    
     else if($method == 'Delete') 
    {
        $Alumno = new Alumno($idAlumno);
        
        $rowsAfectados = $Alumno->CreateDelete();
        $consulta="update usuario set estatus=0 where idUsuario=".$Alumno->idUsuario.";";
        //echo $consulta;
        $r = $Alumno->Update($consulta);
        if($rowsAfectados > 0)
            echo '{"mensaje":"Informacion borrado correctamente","rowsAfectados":"'.$rowsAfectados.'"}';
        else
            echo '{"mensaje":"Error al borrar la informacion","rowsAfectados":"0"}';
    }    
}
else
{
    extract($_GET);

$Alumno =       new Alumno();
if ($_SESSION['idTipoUsuario'] == "1") {
  $rsAlumno = $Alumno->SelectAll("vw_alumno", "idAlumno, matricula, idUsuario, campus, validado");
  echo json_encode($rsAlumno);
} else if ($_SESSION['idTipoUsuario'] == "2") { //coordinador investigador
  $rsAlumno = $Alumno->SelectAll("vw_alumno", "idAlumno, matricula, idUsuario, idCarrera, campus,validado", "idInstitucion=" . $_SESSION['idInstitucion']);
  echo json_encode($rsAlumno);
} else if ($_SESSION['idTipoUsuario'] == "3") { //coordinador investigador
  $rsAlumno = $Alumno->SelectAll("vw_alumno", "idAlumno, matricula, idUsuario, idCarrera, campus,validado", "idCampus=" . $_SESSION['idCampus']);
  echo json_encode($rsAlumno);
} else
  die('No tienes permiso de estar aqui');

}
?>
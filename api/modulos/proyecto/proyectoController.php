<?php
if (session_status() != PHP_SESSION_ACTIVE)
  session_start();
require 'proyecto.class.php';
use ProyectoNamespace\Proyecto as Proyecto;
if($_POST)
{
    extract($_POST);
    if(isset($_POST['idUsuarioInvestigador']))
    {
        $idUsuarioInvestigador = $_POST['idUsuarioInvestigador'];
    }
    else if(isset($_SESSION['idUsuario']))
    {
        $idUsuarioInvestigador = $_SESSION['idUsuario'];
        $idInstitucion=$_SESSION['idInstitucion'];
        $idCampus=$_SESSION['idCampus'];
    }
    else
    {
        die('Error, usuario investigador no especificado');
    }
    $Proyecto = new Proyecto();
    if($method == 'Insert')
    {
        $Proyecto->idProyecto = 0;
        $Proyecto->titulo = $titulo;
        $Proyecto->perfil = $perfil;
        $Proyecto->porcentajeAvanceCarrera = $porcentajeAvanceCarrera;
        $Proyecto->carrera = $carrera;
        $Proyecto->actividad = $actividad;
        $Proyecto->habilidad = $habilidad;
        $Proyecto->modalidad = $modalidad;
        $Proyecto->observaciones = $observaciones;
        $Proyecto->cantidadAlumnos = $cantidadAlumnos;
        $Proyecto->idUsuarioInvestigador = $idUsuarioInvestigador; //<- traer de session
        $Proyecto->idCampus = $idCampus;
        $Proyecto->idInstitucion =  $idInstitucion;
        $Proyecto->idVerano = 1; //$idVerano;
        $Proyecto->fechaCreacion = date("Y-m-d H:i:s");
        $Proyecto->fechaModifica = date("Y-m-d H:i:s");
        $Proyecto->estatus =   1;
        $Proyecto->idarea = $idarea;
        $Proyecto->validado = 0;
        $idInsertado =  $Proyecto->CreateInsert();
        if($idInsertado > 0)
            echo '{"mensaje":"Informacion registrada correctamente","IdInsertado":"'.$idInsertado.'"}';
        else
            echo '{"mensaje":"Error al registrar la informacion","IdInsertado":"0"}';
    }
    else if($method == 'Update') 
    {
        $Proyecto->idProyecto = $idProyecto;
        $Proyecto->titulo = $titulo;
        $Proyecto->perfil = $perfil;
        $Proyecto->porcentajeAvanceCarrera = $porcentajeAvanceCarrera;
        $Proyecto->carrera = $carrera;
        $Proyecto->actividad = $actividad;
        $Proyecto->habilidad = $habilidad;
        $Proyecto->modalidad = $modalidad;
        $Proyecto->observaciones = $observaciones;
        $Proyecto->cantidadAlumnos = $cantidadAlumnos;
        //$Proyecto->idUsuarioInvestigador = $idUsuarioInvestigador;
        //$Proyecto->idCampus = $idCampus;
        //$Proyecto->idInstitucion = $idInstitucion;
        //$Proyecto->idVerano = $idVerano;
        $Proyecto->fechaModifica = date("Y-m-d H:i:s");
        //$Proyecto->estatus = $estatus;
        $Proyecto->idarea = $idarea;
        $rowsAfectados = $Proyecto->CreateUpdate();
        if($rowsAfectados > 0)
            echo '{"mensaje":"Informacion registrada correctamente","rowsAfectados":"'.$rowsAfectados.'"}';
        else
            echo '{"mensaje":"Error al registrar la informacion","rowsAfectados":"0"}';
    }
    else if($method == 'Delete') {
        $Proyecto->idProyecto = $idProyecto;
        $rowsAfectados = $Proyecto->CreateDelete();
        if($rowsAfectados > 0)
            echo '{"mensaje":"Informacion eliminada correctamente","rowsAfectados":"'.$rowsAfectados.'"}';
        else
            echo '{"mensaje":"Error al eliminar la informacion","rowsAfectados":"0"}';
    }
    else if($method == 'Validar') {
        $Proyecto = new Proyecto($idProyecto);
        if($Proyecto->validado == 1)
        {
            die('{"mensaje":"El proyecto ya esta validado","rowsAfectados":"0"}');
        }
        $Proyecto->validado = 1;
        $rowsAfectados = $Proyecto->CreateUpdate();
        if($rowsAfectados > 0)
            echo '{"mensaje":"Proyecto validado correctamente","rowsAfectados":"'.$rowsAfectados.'"}';
        else
            echo '{"mensaje":"Error al validar el proyecto","rowsAfectados":"0"}';
    }
    else if($method == 'Invalidar') {
        $Proyecto = new Proyecto($idProyecto);
        if($Proyecto->validado == 0)
        {
            die('{"mensaje":"El proyecto ya esta invalidado","rowsAfectados":"0"}');
        }
        //$Proyecto->validado = 0;
        
        $rowsAfectados = $Proyecto->Update("update proyecto set validado =0 where idProyecto=$idProyecto");
        if($rowsAfectados > 0)
            echo '{"mensaje":"Proyecto invalidado correctamente","rowsAfectados":"'.$rowsAfectados.'"}';
        else
            echo '{"mensaje":"Error al invalidar el proyecto","rowsAfectados":"0"}';
    }
}
else
{
    extract($_GET);

    $Proyecto =     new Proyecto();
    if($_SESSION['idTipoUsuario'] == "1")
    {
        $rsProyecto = $Proyecto->SelectAll("vw_proyecto", "idProyecto, UsuarioInvestigador as Investigador, titulo as Titulo, perfil as Perfil, modalidad as Modalidad, cantidadAlumnos as 'Cantidad de Alumnos', porcentajeAvanceCarrera as 'Avance Carrera %', validado");
    echo json_encode($rsProyecto);
    }
    else if($_SESSION['idTipoUsuario'] == "2")
    {
        $rsProyecto = $Proyecto->SelectAll("vw_proyecto", "idProyecto, UsuarioInvestigador as Investigador, titulo as Titulo, modalidad as Modalidad, cantidadAlumnos as 'Cantidad de Alumnos', porcentajeAvanceCarrera as 'Avance Carrera %', validado", "idInstitucion=".$_SESSION['idInstitucion']);
        echo json_encode($rsProyecto);
    }
    else if($_SESSION['idTipoUsuario'] == "3")
    {
        $rsProyecto = $Proyecto->SelectAll("vw_proyecto", "idProyecto, UsuarioInvestigador as Investigador, titulo as Titulo,  modalidad as Modalidad, cantidadAlumnos as 'Cantidad de Alumnos', porcentajeAvanceCarrera as 'Avance Carrera %', validado", "idCampus=".$_SESSION['idCampus']);
        echo json_encode($rsProyecto);
    }
    else if($_SESSION['idTipoUsuario'] == "4")
    {
        $rsProyecto = $Proyecto->SelectAll("vw_proyecto", "idProyecto, UsuarioInvestigador as Investigador, titulo as Titulo,  modalidad as Modalidad, cantidadAlumnos as 'Cantidad de Alumnos', porcentajeAvanceCarrera as 'Avance Carrera %', validado", "idUsuarioInvestigador=".$_SESSION['idUsuario']);
        echo json_encode($rsProyecto);
    }
}
?>
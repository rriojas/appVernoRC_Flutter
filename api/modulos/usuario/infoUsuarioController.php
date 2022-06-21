<?php
header('Content-Type: application/json; charset=utf-8');
require 'usuario.class.php';
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */
use UsuarioNamespace\Usuario as Usuario;
if($_POST)
{
    extract($_POST);
    $Usuario = new Usuario();
    if($method == 'Insert')
    {
        $correo = trim($correo);
        $rsExiste = $Usuario->Select("SELECT idUsuario FROM usuario WHERE upper(correo) = '".strtoupper($correo)."'");
        if($rsExiste != null && count($rsExiste) > 0)
        {
            die('{"mensaje":"El correo ya esta registrado en el sistema","IdInsertado":"-1"}');
        }
        $Usuario->idUsuario =   0;
        $Usuario->idTipoUsuario =$idTipoUsuario;
        $Usuario->correo =$correo;
        $password = $Usuario->Select("select SHA1('$clave') as password");
        $Usuario->clave = $password[0]['password'];
        $Usuario->nombre =$nombre;
        $Usuario->apellidoPaterno =$apellidoPaterno;
        $Usuario->apellidoMaterno =$apellidoMaterno;
        $Usuario->fechaNacimiento =$fechaNacimiento;
        $Usuario->genero =$genero;
        $Usuario->telefono =$telefono;
        $Usuario->calle =$calle;
        $Usuario->colonia =$colonia;
        $Usuario->numero =$numero;
        $Usuario->codigoPostal =$codigoPostal;
        $Usuario->idCampus =$idCampus;
        $Usuario->fechaCreacion =date("Y-m-d H:i:s");
        $Usuario->fechaModifica =date("Y-m-d H:i:s");
        $Usuario->validado =0;
        $Usuario->idUsuarioValida ="null";
        $Usuario->fechaValida ="null";
        $Usuario->estatus =1;
        $idInsertado =  $Usuario->CreateInsert();
        if($idInsertado > 0)
        {
            /*$para  = $correo;
            $título = 'REGISTRO EXITOSO';
            $mensaje = '<html>
            <head>
              <title>'.$titulo.'</title>
            </head>
            <body>
              <p>Bienvenido al portal del Verano Regional de la Ciencia<br/>Su registro se ha realizado con exito</p>
            </body>
            </html>';
            $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
            $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            mail($para, $título, $mensaje, $cabeceras);*/
            echo '{"mensaje":"Informacion registrada correctamente","IdInsertado":"'.$idInsertado.'"}';
        }
        else
            echo '{"mensaje":"Error al registrar la informacion","IdInsertado":"0"}';
    }
    else if($method == 'Update') 
    {
        $Usuario = new Usuario($idUsuario);
        $Usuario->idUsuario =   $idUsuario;
        $Usuario->idTipoUsuario =$idTipoUsuario;
        $Usuario->correo =$correo;
        if ($clave!="")
        {
            $password = $Usuario->Select("select SHA1('$clave') as password");
            $Usuario->clave = $password[0]['password'];
        }
        $Usuario->nombre =$nombre;
        $Usuario->apellidoPaterno =$apellidoPaterno;
        $Usuario->apellidoMaterno =$apellidoMaterno;
        $Usuario->fechaNacimiento =$fechaNacimiento;
        $Usuario->genero =$genero;
        $Usuario->telefono =$telefono;
        $Usuario->calle =$calle;
        $Usuario->colonia =$colonia;
        $Usuario->numero =$numero;
        $Usuario->codigoPostal =$codigoPostal;
        $Usuario->idCampus =$idCampus;
        $Usuario->fechaModifica =date("Y-m-d H:i:s");
        $rowsAfectados = $Usuario->CreateUpdate();
        if($rowsAfectados > 0)
            echo '{"mensaje":"Informacion registrada correctamente","rowsAfectados":"'.$rowsAfectados.'"}';
        else
            echo '{"mensaje":"Error al registrar la informacion","rowsAfectados":"0"}';
    }
    else if($method == 'Delete') {
        $Usuario->idUsuario = $idUsuario;
        $rowsAfectados = $Usuario->CreateDelete();
        if($rowsAfectados > 0)
            echo '{"mensaje":"Informacion eliminada correctamente","rowsAfectados":"'.$rowsAfectados.'"}';
        else
            echo '{"mensaje":"Error al eliminar la informacion","rowsAfectados":"0"}';
    } 
    else if($method == 'ValidarUsuario')
    {
        $rsUsuario = $Usuario->Select("select idUsuario from investigador where idInvestigador=$idInvestigador");
        $idUsuario = $rsUsuario[0]['idUsuario'];
        $Usuario->idUsuario = $idUsuario;
        $rowsAfectados = $Usuario->ValidarUsuario();
        if($rowsAfectados > 0)
            echo '{"mensaje":"Usuario validado correctamente","rowsAfectados":"'.$rowsAfectados.'"}';
        else
            echo '{"mensaje":"Error al validar el usuario","rowsAfectados":"0"}';
    }
    else if($method == 'InvalidarUsuario')
    {
        $rsUsuario = $Usuario->Select("select idUsuario from investigador where idInvestigador=$idInvestigador");
        $idUsuario = $rsUsuario[0]['idUsuario'];
        $Usuario->idUsuario = $idUsuario;
        $rowsAfectados = $Usuario->InvalidarUsuario();
        if($rowsAfectados > 0)
            echo '{"mensaje":"Usuario invalidado correctamente","rowsAfectados":"'.$rowsAfectados.'"}';
        else
            echo '{"mensaje":"Error al invalidar el usuario","rowsAfectados":"0"}';
    }
    else if($method == 'ValidarAlumno')
    {
        $Documentos = $Usuario->Select("select * from documentoalumno where estatus =1 and idAlumno = $idAlumno");
        if(count($Documentos) < 7)
        {
            die('{"mensaje":"El alumno no tiene documentos cargados aun, no se puede validar","rowsAfectados":"0"}');
        }
        $Usuario->idUsuario = $idAlumno;
        $rowsAfectados = $Usuario->ValidarUsuario();
        if($rowsAfectados > 0)
            echo '{"mensaje":"Alumno validado correctamente","rowsAfectados":"'.$rowsAfectados.'"}';
        else
            echo '{"mensaje":"Error al validar el usuario","rowsAfectados":"0"}';
    }
    else if($method == 'InValidarAlumno')
    {
        $rsUsuario = $Usuario->Select("select idUsuario from alumno where idAlumno=$idAlumno");
        $idUsuario = $rsUsuario[0]['idUsuario'];
        $Usuario->idUsuario = $idUsuario;
        $rowsAfectados = $Usuario->InvalidarUsuario();
        if($rowsAfectados > 0)
            echo '{"mensaje":"Alumno invalidado correctamente","rowsAfectados":"'.$rowsAfectados.'"}';
        else
            echo '{"mensaje":"Error al validar el usuario","rowsAfectados":"0"}';
    }
    else if($method == 'Login')
    {
        $Usuario = new Usuario();
        $rsLogin = $Usuario->Select("select * from usuario where correo='$correo' and clave=SHA1('$password') and estatus=1");
        if($rsLogin != null && count($rsLogin) == 1)
        {
            //Usuario existe 
             $rsAlumno = $Usuario->Select("select * from alumno where idUsuario =  ".$rsLogin[0]['idUsuario']." and estatus=1");
            if($rsLogin[0]['idTipoUsuario']==5 && ($rsAlumno==null || count($rsAlumno) == 0)) // Si es Alumno y no ha completado el registro 
            {
                 session_start();
            $_SESSION['idUsuario'] = $rsLogin[0]['idUsuario'];
                 echo '{"mensaje":"Error Registro de Alumno incompleto" ,"acceso":"5"}';
                 
            }
            else
            {
            session_start();
            $_SESSION['idUsuario'] = $rsLogin[0]['idUsuario'];
            $_SESSION['idTipoUsuario'] = $rsLogin[0]['idTipoUsuario'];
            $_SESSION['nombre'] = $rsLogin[0]['nombre'].' '.$rsLogin[0]['apellidoPaterno'].' '.$rsLogin[0]['apellidoMaterno'];
            $_SESSION['idCampus'] = $rsLogin[0]['idCampus'];
            $rsInstitucion = $Usuario->Select("select idInstitucion from campus where idCampus=".$rsLogin[0]['idCampus']);
            $_SESSION['idInstitucion'] = $rsInstitucion[0]['idInstitucion'];
            $rsVerano = $Usuario->Select("select * from verano where estatus=1");
            $_SESSION['idVerano'] = $rsVerano[0]['idVerano'];
            $_SESSION['fechaVeranoInicio'] = $rsVerano[0]['fechaVeranoInicio'];
            $_SESSION['fechaVeranoFin'] = $rsVerano[0]['fechaVeranoFin'];
            $_SESSION['proyectosPorInvestigador'] = $rsVerano[0]['proyectosPorInvestigador'];
            $_SESSION['solicitudesPorAlumno'] = $rsVerano[0]['solicitudesPorAlumno'];
            $_SESSION['alumnosPorProyecto'] = $rsVerano[0]['alumnosPorProyecto'];
            $_SESSION['fechaCrearSolicitudInicio'] = $rsVerano[0]['fechaCrearSolicitudInicio'];
            $_SESSION['fechaCrearSolicitudFin'] = $rsVerano[0]['fechaCrearSolicitudFin'];
            $_SESSION['fechaValidarSolicitudInicio'] = $rsVerano[0]['fechaValidarSolicitudInicio'];
            $_SESSION['fechaValidarSolicitudFin'] = $rsVerano[0]['fechaValidarSolicitudFin'];
            echo '{"mensaje":"Usuario validado correctamente","acceso":"1"}';
            }
        }
        else{
            echo '{"mensaje":"Error al ingresar al sistema","acceso":"0"}';
            header('HTTP/1.0 401 Unauthorized');
        }
    }
    else if($method == 'CambiarPassword')
    {
        session_start();
        $Usuario = new Usuario($_SESSION['idUsuario']);
        $password = $Usuario->Select("select SHA1('$clave') as password");
        $Usuario->clave = $password[0]['password'];
        $rowsAfectados = $Usuario->CreateUpdate();
        if($rowsAfectados > 0)
            echo '{"mensaje":"Password actualizado correctamente","rowsAfectados":"'.$rowsAfectados.'"}';
        else
            echo '{"mensaje":"Error al cambiar el password","rowsAfectados":"0"}';
    }
}
else
{
    extract($_GET);
    switch ($method) {
        case 'All':
            $Usuario = new Usuario();
            $rsUsuario = $Usuario->SelectAll("usuario", "idUsuario, nombre");
            echo json_encode($rsUsuario);
        break;
        case 'ById':
            $Usuario = new Usuario($idUsuario);
            $rsUsuario   = $Usuario->SelectOne("usuario");
            echo json_encode($rsUsuario);
        break;
         default:
             # code...
             break;
     }
}
?>
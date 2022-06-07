<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
require 'documentoAlumno.class.php';
use DocumentoAlumnoNamespace\DocumentoAlumno as DocumentoAlumno;
if($_POST)
{
    extract($_POST);
    $DocumentoAlumno = new DocumentoAlumno();
    if($method == 'Insert')
    {
        if(!isset($_FILES['uploadFile']))
        {
            die('{"mensaje":"Por favor selecciona un archivo","IdInsertado":"0"}');
        }
        $idAlumno = $_SESSION['idUsuario'];
        $DocumentoAlumno->idDocumentoAlumno = 0;
        $DocumentoAlumno->idDocumento =   $idDocumento;
        $DocumentoAlumno->idAlumno=   $idAlumno;
        $DocumentoAlumno->fechaCreacion=  date("Y-m-d H:i:s");
        $DocumentoAlumno->fechaModifica=  date("Y-m-d H:i:s");
        $DocumentoAlumno->estatus =   1;
        
        $Documento = $DocumentoAlumno->Select("select prefijo from documento where idDocumento=$idDocumento");
        
        $name = $_FILES["uploadFile"]["name"];
        $extension = end((explode(".", $name)));
        mkdir("../../documento/$idAlumno");
        if (move_uploaded_file($_FILES['uploadFile']['tmp_name'], '../../documento/'.$idAlumno.'/'.$Documento[0]['prefijo'].'.'.$extension))
        {
           $idInsertado =  $DocumentoAlumno->CreateInsert();
            if($idInsertado > 0)
                echo '{"mensaje":"Informacion registrada correctamente","IdInsertado":"'.$idInsertado.'"}';
            else
                echo '{"mensaje":"Error al registrar la informacion","IdInsertado":"0"}';
        }
        else
        {
            echo '{"mensaje":"Error al subir el archivo","IdInsertado":"0"}';
        }
    }
    else if($method == 'Update') 
    {
        $DocumentoAlumno->idDocumentoAlumno = $idDocumentoAlumno;
        $DocumentoAlumno->idDocumento =   $idDocumento;
        $DocumentoAlumno->idAlumno=   $idAlumno;
        $DocumentoAlumno->fechaModifica=  date("Y-m-d H:i:s");
        $DocumentoAlumno->estatus = $estatus;
        $rowsAfectados = $DocumentoAlumno->CreateUpdate();
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
            $DocumentoAlumno   = new DocumentoAlumno();
            $rsDocumentoAlumno = $DocumentoAlumno->SelectAll("documentoalumno", "*");
            echo json_encode($rsDocumentoAlumno);
        break;
        case 'ById':
            $DocumentoAlumno     = new DocumentoAlumno($idDocumentoAlumno);
            $rsDocumentoAlumno   = $DocumentoAlumno->SelectOne("documentoalumno");
            echo json_encode($rsDocumentoAlumno);
        break;
         default:
             # code...
             break;
     }
}
?>
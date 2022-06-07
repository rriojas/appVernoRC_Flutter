<?php
    namespace MunicipioControllerNamespace
    {
        require 'municipio.class.php';
        use MunicipioNamespace\Municipio as Municipio;

        if($_REQUEST)
        {
            extract($_REQUEST);
            $Municipio = new Municipio($idmunicipio);
            //print_r($Municipio);
            switch ($method)
            {
                case 'Insert':
                    $Municipio->idMunicipio =       0;
                    $Municipio->nombre =  $nombre;
                    $Municipio->idestado =        $idestado;
                    $Municipio->status =       1;
                    echo $Municipio->CreateInsert();
                break;
                case 'Update':
                    $Municipio->idMunicipio = $idmunicipio;
                    $Municipio->nombre = $nombre;
                    $Municipio->idestado = $idestado;
                    $Municipio->status = 1;
                    echo $Municipio->CreateUpdate();
                break;
                case 'Delete':
                    if($Municipio->CreateDelete() > 0)
                    {
                        echo '{"mensaje": "Registro Eliminado correctamente"}';
                    }
                    else
                    {
                        echo '{"mensaje":"Error al actualizar la informacion"}';
                    }
                break;
                default:
                    # code...
                    break;
            }
        }
    }
?>
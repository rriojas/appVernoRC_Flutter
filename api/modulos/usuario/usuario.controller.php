<?php
    namespace UsuarioControllerNamespace
    {
        require 'usuario.class.php';
        use UsuarioNamespace\Usuario as Usuario;

        if($_REQUEST)
        {
            extract($_REQUEST);
            $Usuario = new Usuario($idusuario);
            //print_r($Usuario);
            switch ($method)
            {
                case 'Insert':
                    $password =             $Usuario->Select("select SHA1('$clave') as password");
                    $Usuario->idUsuario =   0;
                    $Usuario->clave =       $password[0]['password'];
                    $Usuario->curp =        $curp;
                    $Usuario->tipousuario = $tipousuario;
                    $Usuario->status =      1;
                    echo $Usuario->CreateInsert();
                break;
                case 'Update':
                    $password =             $Usuario->Select("select SHA1('$clave') as password");
                    $Usuario->idUsuario =   $idusuario;
                    if($clave != "")
                        $Usuario->clave =       $password[0]['password'];
                    $Usuario->curp =        $curp;
                    $Usuario->tipousuario = $tipousuario;
                    $Usuario->status =      1;
                    echo $Usuario->CreateUpdate();
                break;
                case 'Delete':
                    if($Usuario->CreateDelete() > 0)
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
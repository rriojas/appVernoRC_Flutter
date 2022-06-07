<?php
    namespace
    {
        require 'CommonFunc.class.php';
        use CommonFuncNamespace\CommonFunc as CommonFunc; 
        $funciones = new CommonFunc();
        extract($_POST);
        switch ($metodo) {
            case 'ObtenerMenu':
                echo $funciones->ObtenerMenu(1, $tipo);
                break;
            
            default:
                # code...
                break;
        }
    }
?>
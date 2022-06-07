<?php
namespace AdministrationControllerNamespace
{
    require 'Administration.class.php';
    require 'CommonFunc.class.php';

    use AdministrationNamespace\Administration as Administration;
    use CommonFuncNamespace\CommonFunc as CommonFunc;
    $admin = new Administration();
    $commonFunc = new CommonFunc();
    extract($_POST);
    switch ($metodo) {
        case 'ObtenerMenu':
            echo $commonFunc->ArrayToJson($admin->ObtenerMenu(1, $tipo));
            break;
        
        default:
            # code...
            break;
    }
}
?>
<?php
namespace AdministrationNamespace
{
    require 'conexion.php';
    use ConexionNameSpace\ConexionMySql as Conexion;
    class Administration extends Conexion
    {
        function __construct()
        {
            parent::__construct();
        }
        function ObtenerMenu($idusuario, $categoria)
        {
            $sql = "SELECT permission.permission_id, name, icon, `order`, `user_id` FROM `permission` inner join userpermission on userpermission.permission_id = permission.permission_id where category_id = $categoria AND user_id = $idusuario";
            return $this->Select($sql);
        }
    }
    
}
?>
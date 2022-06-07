<?php
    namespace ConexionErrorHandlingNameSpace
    {
        require 'conexion.php';
        use ConexionNameSpace\ConexionMysql as Conexion;
        class ConexionErrorHandling extends Conexion
        {
            function __construct()
            {
                parent::__construct();
            }
            function Open()
            {
                try
                {
                    return parent::Open();
                }
                catch(Exception $e)
                {
                    return "Falló en la conexión: " . $e->getMessage();
                }
            }
        }
    }
?>
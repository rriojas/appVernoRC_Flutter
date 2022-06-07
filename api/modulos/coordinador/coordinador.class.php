<?php
    namespace CoordinadorNamespace
    {
        $included_files = get_included_files();
        if(!in_array(realpath((__DIR__).'/../../lib/base.class.php'), $included_files))
        {
            require (__DIR__).'/../../lib/base.class.php';            
        }
        use BaseNamespace\Base as Base;
        class Coordinador extends Base
        {
            var $idCoordinador, $puesto, $esCoordinadorInstitucional, $idUsuario, $fechaCreacion, $fechaModifica, $estatus;
            var $ColumnAlias = array('idCoordinador' => 'idCoordinador', 'puesto' => 'puesto', 'esCoordinadorInstitucional' => 'esCoordinadorInstitucional', 'idUsuario' => 'idUsuario', 'fechaCreacion' =>'fechaCreacion', 'fechaModifica'=>'fechaModifica', 'estatus' => 'estatus');
            function __construct( $idCoordinador = 0 )
            {
                parent::__construct(get_object_vars($this), 'coordinador', 'idCoordinador', $this->ColumnAlias, $idCoordinador);
            }
        }        
    }
?>
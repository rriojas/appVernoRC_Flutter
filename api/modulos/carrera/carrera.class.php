<?php
    namespace CarreraNamespace
    {
        $included_files = get_included_files();
        if(!in_array(realpath((__DIR__).'/../../lib/base.class.php'), $included_files))
        {
            require (__DIR__).'/../../lib/base.class.php';            
        }
        use BaseNamespace\Base as Base;
        class Carrera extends Base
        {
            var $idCarrera, $nombre, $idCampus, $estatus;
            var $ColumnAlias = array('idCarrera' => 'idCarrera', 'nombre' => 'nombre', 'idCampus' => 'idCampus', 'estatus' => 'estatus');
            function __construct( $idCarrera = 0 )
            {
                parent::__construct(get_object_vars($this), 'carrera', 'idCarrera', $this->ColumnAlias, $idCarrera);
            }
        }        
    }
?>
<?php
    namespace CampusNamespace
    {
        $included_files = get_included_files();
        if(!in_array(realpath((__DIR__).'/../../lib/base.class.php'), $included_files))
        {
            require (__DIR__).'/../../lib/base.class.php';            
        }
        use BaseNamespace\Base as Base;
        class Campus extends Base
        {
            var $idCampus, $nombre, $abreviaturaCampus, $idInstitucion, $idMunicipio, $estatus;
            var $ColumnAlias = array('idCampus' => 'idCampus', 'nombre' => 'nombre', 'abreviaturaCampus' => 'abreviaturaCampus', 'idInstitucion' => 'idInstitucion', 'idMunicipio' => 'idMunicipio', 'estatus' => 'estatus');
            function __construct( $idCampus = 0 )
            {
                parent::__construct(get_object_vars($this), 'campus', 'idCampus', $this->ColumnAlias, $idCampus);
            }
        }        
    }
?>
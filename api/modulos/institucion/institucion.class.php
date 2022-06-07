<?php
    namespace InstitucionNamespace
    {
        $included_files = get_included_files();
        if(!in_array(realpath((__DIR__).'/../../lib/base.class.php'), $included_files))
        {
            require (__DIR__).'/../../lib/base.class.php';            
        }
        use BaseNamespace\Base as Base;
        class Institucion extends Base
        {
            var $idInstitucion, $nombre, $abreviatura, $estatus;
            var $ColumnAlias = array('idInstitucion' => 'idInstitucion', 'nombre' => 'nombre', 'abreviatura' => 'abreviatura', 'estatus' => 'estatus');
            function __construct( $idInstitucion = 0 )
            {
                parent::__construct(get_object_vars($this), 'institucion', 'idInstitucion', $this->ColumnAlias, $idInstitucion);
            }
        }        
    }
?>
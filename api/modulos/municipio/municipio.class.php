<?php
    namespace MunicipioNamespace
    {
        $included_files = get_included_files();
        if(!in_array(realpath((__DIR__).'/../../lib/base.class.php'), $included_files))
        {
            require (__DIR__).'/../../lib/base.class.php';            
        }
        use BaseNamespace\Base as Base;
        class Municipio extends Base
        {
            var $idMunicipio,
                $nombre,
                $idEstado,
                $estatus;
            var $ColumnAlias = array('idMunicipio' => 'Id municipio', 'nombre' => 'Nombre del municipio', 'idEstado' => 'Estado', 'estatus' => 'Status');
            function __construct( $idMunicipio = 0 )
            {
                parent::__construct(get_object_vars($this), 'municipio', 'idMunicipio', $this->ColumnAlias, $idMunicipio);
            }
        }
        
    }
?>
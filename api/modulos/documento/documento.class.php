<?php
    namespace DocumentoNamespace
    {
        $included_files = get_included_files();
        if(!in_array(realpath((__DIR__).'/../../lib/base.class.php'), $included_files))
        {
            require (__DIR__).'/../../lib/base.class.php';            
        }
        use BaseNamespace\Base as Base;
        class Documento extends Base
        {
            var $idDocumento, $descripcion, $prefijo, $estatus;
            var $ColumnAlias = array('idDocumento' => 'idDocumento', 'descripcion' => 'descripcion', 'prefijo' => 'prefijo', 'estatus' => 'estatus');
            function __construct( $idDocumento = 0 )
            {
                parent::__construct(get_object_vars($this), 'documento', 'idDocumento', $this->ColumnAlias, $idDocumento);
            }
        }        
    }
?>
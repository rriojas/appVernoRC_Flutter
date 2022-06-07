<?php
    namespace EstadoNamespace
    {
        $included_files = get_included_files();
        if(!in_array(realpath((__DIR__).'/../../lib/base.class.php'), $included_files))
        {
            require (__DIR__).'/../../lib/base.class.php';            
        }
        use BaseNamespace\Base as Base;
        class Estado extends Base
        {
                var $idEstado,
                $nombre,
                $estatus;
            var $ColumnAlias = array('idEstado' => 'Id estado', 'nombre' => 'Nombre del estado', 'estatus' => 'Status');
            function __construct( $idestado = 0 )
            {
                parent::__construct(get_object_vars($this), 'estado', 'idEstado', $this->ColumnAlias, $idestado);
            }
        }
        
    }
?>
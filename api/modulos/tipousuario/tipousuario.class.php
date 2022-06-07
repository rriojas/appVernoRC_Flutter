<?php
    namespace TipoUsuarioNamespace
    {
        $included_files = get_included_files();
        if(!in_array(realpath((__DIR__).'/../../lib/base.class.php'), $included_files))
        {
            require (__DIR__).'/../../lib/base.class.php';            
        }
        use BaseNamespace\Base as Base;
        class TipoUsuario extends Base
        {
            var $idTipoUsuario, $descripcion, $estatus;
            var $ColumnAlias = array('idTipoUsuario' => 'idTipoUsuario', 'descripcion' => 'descripcion', 'estatus' => 'estatus');
            function __construct( $idTipoUsuario = 0 )
            {
                parent::__construct(get_object_vars($this), 'tipousuario', 'idTipoUsuario', $this->ColumnAlias, $idTipoUsuario);
            }
        }        
    }
?>
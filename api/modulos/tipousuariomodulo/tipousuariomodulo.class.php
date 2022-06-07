<?php
    namespace TipoUsuarioModuloNamespace
    {
        $included_files = get_included_files();
        if(!in_array(realpath((__DIR__).'/../../lib/base.class.php'), $included_files))
        {
            require (__DIR__).'/../../lib/base.class.php';            
        }
        use BaseNamespace\Base as Base;
        class TipoUsuarioModulo extends Base
        {
            var $idtipousuariomodulo, $idtipousuario, $idmodulo, $estatus;
            var $ColumnAlias = array('idtipousuariomodulo' => 'idtipousuariomodulo', 'idtipousuario' => 'idtipousuario', 'idmodulo' => 'idmodulo', 'estatus' => 'estatus');
            function __construct( $idtipousuariomodulo = 0 )
            {
                parent::__construct(get_object_vars($this), 'tipousuariomodulo', 'idtipousuariomodulo', $this->ColumnAlias, $idtipousuariomodulo);
            }
        }        
    }
?>
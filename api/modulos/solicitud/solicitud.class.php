<?php
    namespace SolicitudNamespace
    {
        $included_files = get_included_files();
        if(!in_array(realpath((__DIR__).'/../../lib/base.class.php'), $included_files))
        {
            require (__DIR__).'/../../lib/base.class.php';            
        }
        use BaseNamespace\Base as Base;
        class Solicitud extends Base
        {
            var $idSolicitud, $comentario, $numeroVuelta, $idProyecto, $orden, $idVerano, $idUsuarioAlumno, $fechaCreacion, $fechaModifica, $estatus;
            var $ColumnAlias = array('idSolicitud' => 'idSolicitud', 'comentario' => 'comentario', 'numeroVuelta' => 'numeroVuelta', 'idProyecto' => 'idProyecto', 'orden' => 'orden', 'idVerano' => 'idVerano', 'idUsuarioAlumno' => 'idUsuarioAlumno', 'fechaCreacion' => 'fechaCreacion', 'fechaModifica' => 'fechaModifica', 'estatus' => 'estatus');
            function __construct( $idSolicitud = 0 )
            {
                parent::__construct(get_object_vars($this), 'solicitud', 'idSolicitud', $this->ColumnAlias, $idSolicitud);
            }
        }        
    }
?>
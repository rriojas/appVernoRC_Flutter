<?php
    namespace DocumentoAlumnoNamespace
    {
        $included_files = get_included_files();
        if(!in_array(realpath((__DIR__).'/../../lib/base.class.php'), $included_files))
        {
            require (__DIR__).'/../../lib/base.class.php';            
        }
        use BaseNamespace\Base as Base;
        class DocumentoAlumno extends Base
        {
            var $idDocumentoAlumno, $idDocumento, $idAlumno, $fechaCreacion, $fechaModifica, $estatus;
            var $ColumnAlias = array('idDocumentoAlumno' => 'idDocumentoAlumno', 'idDocumento' => 'idDocumento', 'idAlumno' => 'idAlumno', 'fechaCreacion' => 'fechaCreacion', 'fechaModifica' =>'fechaModifica', 'estatus' => 'estatus');
            function __construct( $idDocumentoAlumno = 0 )
            {
                parent::__construct(get_object_vars($this), 'documentoalumno', 'idDocumentoAlumno', $this->ColumnAlias, $idDocumentoAlumno);
            }
        }        
    }
?>
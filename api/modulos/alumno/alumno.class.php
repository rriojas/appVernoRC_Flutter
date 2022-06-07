<?php
    namespace AlumnoNamespace
    {
        $included_files = get_included_files();
        if(!in_array(realpath((__DIR__).'/../../lib/base.class.php'), $included_files))
        {
            require (__DIR__).'/../../lib/base.class.php';            
        }
        use BaseNamespace\Base as Base;
        class Alumno extends Base
        {
            var $idAlumno, $matricula, $CURP, $semestre, $promedio, $porcentajeAvanceCarrera, $idCarrera, $nombreInvestigadorRecomienda, $telefonoInvestigadorRecomienda, $correoInvestigadorRecomienda, $idUsuario, $idVerano, $fechaCreacion, $fechaModifica, $estatus;
            var $ColumnAlias = array('idAlumno' => 'idAlumno', 'matricula' => 'Matricula', 'CURP' => 'CURP', 'semestre' => 'semestre', 'promedio' => 'promedio', 'porcentajeAvanceCarrera' => 'porcentajeAvanceCarrera', 'idCarrera' => 'Carrera', 'nombreInvestigadorRecomienda' => 'nombreInvestigadorRecomienda', 'telefonoInvestigadorRecomienda' => 'telefonoInvestigadorRecomienda', 'correoInvestigadorRecomienda' => 'correoInvestigadorRecomienda', 'idUsuario' => 'Nombre del alumno', 'idVerano' => 'idVerano', 'fechaCreacion' => 'fechaCreacion', 'fechaModifica' => 'fechaModifica', 'estatus' => 'estatus');
            function __construct( $idAlumno = 0 )
            {
                parent::__construct(get_object_vars($this), 'alumno', 'idAlumno', $this->ColumnAlias, $idAlumno);
            }
        }
        
    }
?>
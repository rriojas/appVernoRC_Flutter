<?php
    namespace VeranoNamespace
    {
        $included_files = get_included_files();
        if(!in_array(realpath((__DIR__).'/../../lib/base.class.php'), $included_files))
        {
            require (__DIR__).'/../../lib/base.class.php';            
        }
        use BaseNamespace\Base as Base;
        class Verano extends Base
        {
            var $idVerano, $descripcion, $fechaVeranoInicio, $fechaVeranoFin, $proyectosPorInvestigador, $solicitudesPorAlumno, $alumnosPorProyecto, $porcentajeMinimoAvanceAlumno, $fechaCrearProyectoInicio, $fechaCrearProyectoFin, $fechaValidarProyectoInicio, $fechaValidarProyectoFin, $fechaCrearSolicitudInicio, $fechaCrearSolicitudFin, $fechaValidarSolicitudInicio, $fechaValidarSolicitudFin, $fechaCrearReporteInicio, $fechaCrearReporteFin, $fechaValidarReporteInicio, $fechaValidarReporteFin, $estatus;
            var $ColumnAlias = array('idVerano' => 'idVerano', 'descripcion' => 'descripcion', 'fechaVeranoInicio' => 'fechaVeranoInicio', 'fechaVeranoFin' => 'fechaVeranoFin', 'proyectosPorInvestigador' =>'proyectosPorInvestigador', 'solicitudesPorAlumno' => 'solicitudesPorAlumno', 'alumnosPorProyecto' => 'alumnosPorProyecto', 'porcentajeMinimoAvanceAlumno' => 'porcentajeMinimoAvanceAlumno', 'fechaCrearProyectoInicio' => 'fechaCrearProyectoInicio', 'fechaCrearProyectoFin' => 'fechaCrearProyectoFin', 'fechaValidarProyectoInicio' => 'fechaValidarProyectoInicio', 'fechaValidarProyectoFin' => 'fechaValidarProyectoFin', 'fechaCrearSolicitudInicio' => 'fechaCrearSolicitudInicio', 'fechaCrearSolicitudFin' => 'fechaCrearSolicitudFin', 'fechaValidarSolicitudInicio' => 'fechaValidarSolicitudInicio', 'fechaValidarSolicitudFin' => 'fechaValidarSolicitudFin', 'fechaCrearReporteInicio' => 'fechaCrearReporteInicio', 'fechaCrearReporteFin' => 'fechaCrearReporteFin', 'fechaValidarReporteInicio' => 'fechaValidarReporteInicio', 'fechaValidarReporteFin' => 'fechaValidarReporteFin', 'estatus' => 'estatus');
            function __construct( $idVerano = 0 )
            {
                parent::__construct(get_object_vars($this), 'verano', 'idVerano', $this->ColumnAlias, $idVerano);
            }
        }        
    }
?>
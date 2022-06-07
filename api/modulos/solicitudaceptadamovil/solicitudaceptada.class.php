<?php
    namespace SolicitudAceptadaNamespace
    {
        $included_files = get_included_files();
        if(!in_array(realpath((__DIR__).'/../../lib/base.class.php'), $included_files))
        {
            require (__DIR__).'/../../lib/base.class.php';            
        }
        use BaseNamespace\Base as Base;
        class SolicitudAceptada extends Base
        {
            var $idSolicitud, $nombreAlumno,  $nombreInstitucionAlumno,$titulo, $nombreInvestigador, $nombreInstitucionInvestigador, $idUsuarioAlumno, $idUsuarioInvestigador, $idCampusInvestigador, $idCampusAlumno, $idInstitucionInvestigador, $idInstitucionAlumno, $correoAlumno, $correoInvestigador,$modalidad,$estatus;
            //var $ColumnAlias = array('idSolicitud' => 'idSolicitud', 'nombreAlumno' => 'Nombre del Alumno', 'titulo' => 'Titulo del Proyecto', 'nombreInvestigador' => 'Nombre del Investigador', 'nombreInstitucionInvestigador' => 'Institucion del Investigador', 'nombreInstitucionAlumno' => 'Institucion del Alumno', 'idUsuarioAlumno' => 'idUsuarioAlumno', 'idUsuarioInvestigador' => 'idUsuarioInvestigador', 'idCampusInvestigador' => 'idCampusInvestigador', 'idCampusAlumno' => 'idCampusAlumno', 'idInstitucionInvestigador' => 'idInstitucionInvestigador', 'idInstitucionAlumno' => 'idInstitucionAlumno', 'estatus' => 'estatus');
            var $ColumnAlias = array('idSolicitud' => 'idSolicitud', 'nombreAlumno' => 'Nombre del Alumno', 'titulo' => 'titulo', 'nombreInvestigador' => 'nombreInvestigador', 'nombreInstitucionInvestigador' => 'Institucion del Investigador', 'nombreInstitucionAlumno' => 'Institucion del Alumno', 'idUsuarioAlumno' => 'idUsuarioAlumno', 'idUsuarioInvestigador' => 'idUsuarioInvestigador', 'idCampusInvestigador' => 'idCampusInvestigador', 'idCampusAlumno' => 'idCampusAlumno', 'idInstitucionInvestigador' => 'idInstitucionInvestigador', 'idInstitucionAlumno' => 'idInstitucionAlumno', 'correoAlumno' => 'correoAlumno', 'correoInvestigador' => 'correoInvestigador', 'modalidad' => 'modalidad', 'estatus' => 'estatus');
            function __construct( $idSolicitud = 0 )
            {
                parent::__construct(get_object_vars($this), 'solicitudaceptada', 'idSolicitud', $this->ColumnAlias, $idSolicitud);
            }
        }        
    }
?>
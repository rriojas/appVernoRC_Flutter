<?php
    namespace ProyectoNamespace
    {
        $included_files = get_included_files();
        if(!in_array(realpath((__DIR__).'/../../lib/base.class.php'), $included_files))
        {
            require (__DIR__).'/../../lib/base.class.php';            
        }
        use BaseNamespace\Base as Base;
        class Proyecto extends Base
        {
            var $idProyecto, $titulo, $perfil, $porcentajeAvanceCarrera, $carrera, $actividad, $habilidad, $modalidad, $observaciones, $cantidadAlumnos, $idUsuarioInvestigador, $idCampus, $idInstitucion, $idVerano, $fechaCreacion, $fechaModifica, $estatus, $idarea, $validado;
            var $ColumnAlias = array('idProyecto' => 'idProyecto', 'titulo' => 'titulo', 'perfil' => 'perfil', 'porcentajeAvanceCarrera' => 'porcentajeAvanceCarrera', 'carrera' => 'carrera', 'actividad' => 'actividad', 'habilidad' => 'habilidad', 'modalidad' => 'modalidad', 'observaciones' => 'observaciones', 'cantidadAlumnos' => 'cantidadAlumnos', 'idUsuarioInvestigador' => 'Investigador', 'idCampus' => 'idCampus', 'idInstitucion' => 'idInstitucion', 'idVerano' => 'idVerano', 'fechaCreacion' => 'fechaCreacion', 'fechaModifica' => 'fechaModifica', 'idarea' => 'idarea', 'estatus' => 'estatus', 'validado' => 'validado');
            function __construct( $idProyecto = 0 )
            {
                parent::__construct(get_object_vars($this), 'proyecto', 'idProyecto', $this->ColumnAlias, $idProyecto);
            }
        }        
    }
?>
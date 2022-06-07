<?php
namespace ProyectoDisponibleNameSpace
{
    $included_files = get_included_files();
    if(!in_array(realpath((__DIR__).'/../../lib/base.class.php'), $included_files))
    {
        require (__DIR__).'/../../lib/base.class.php';            
    }
    use BaseNamespace\Base as Base;
    class ProyectoDisponible extends Base
    {
        var $idProyecto, $titulo, $porcentajeAvanceCarrera, $carrera, $actividad, $habilidad, $modalidad, $usuario, $institucion, $cantidadAlumnos, $idarea, $area, $estatus;
        var $ColumnAlias = array('idProyecto' => 'idProyecto', 'titulo' => 'Titulo de proyecto', 'porcentajeAvanceCarrera' => 'Porcentaje Avance Carrera', 'carrera' => 'Carrera en la que aplica', 'actividad' => 'Actividades a realizar', 'habilidad' => 'Habilidades requeridas', 'modalidad' => 'Modalidad de trabajo', 'usuario' => 'Investigador a cargo', 'institucion' => 'Institucion', 'cantidadAlumnos' => 'Cantidad de alumnos', 'idarea' => 'idArea', 'area' => 'Area', 'estatus' => 'Estado del proyecto');
        function __construct( $id = 0 )
        {
            parent::__construct(get_object_vars($this), 'vw_proyectodisponible', 'idProyecto', $this->ColumnAlias, $id);
        }
    }
    
}
?>
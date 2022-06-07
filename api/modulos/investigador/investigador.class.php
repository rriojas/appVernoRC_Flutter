<?php
    namespace InvestigadorNamespace
    {
        $included_files = get_included_files();
        if(!in_array(realpath((__DIR__).'/../../lib/base.class.php'), $included_files))
        {
            require (__DIR__).'/../../lib/base.class.php';            
        }
        use BaseNamespace\Base as Base;
         
        class Investigador extends Base
        {
            var $varTitulo = ["Licenciatura", "Maestria", "Doctorado", "PostDoctorado"];
            var $varSNI = ["No", "Candidato", "Nivel I", "Nivel II", "Nivel III", "Nivel Emérito"];
            var $varPRODEP = ["No", "Si"];
            
            var $idInvestigador, $titulo, $departamento, $nivelSNI, $PRODEP, $idUsuario, $fechaCreacion, $fechaModifica, $estatus;
            var $ColumnAlias = array('idInvestigador' => 'idInvestigador', 'titulo' => 'titulo', 'departamento' => 'departamento', 'nivelSNI' => 'nivelSNI', 'PRODEP' => 'PRODEP', 'idUsuario' => 'idUsuario', 'fechaCreacion' => 'fechaCreacion', 'fechaModifica' => 'fechaModifica', 'estatus' => 'estatus');
            function __construct( $idInvestigador = 0 )
            {
                parent::__construct(get_object_vars($this), 'investigador', 'idInvestigador', $this->ColumnAlias, $idInvestigador);
            }
        }        
    }
?>
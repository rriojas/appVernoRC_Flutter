<?php
namespace ConfigurationNamespace
{
    class Configuration
    {
        public static function ApplicationName()
        {
            return 'Sistema de Agenda';
        }
        public static function ExitBtn()
        {
            return '<a href="../login/logout.php" class="btn btn-light btn-sm">Salir <span class="fas fa-sign-out-alt"></span></a>';
        }
        public static function HomeBtn()
        {
            return '<a href="../inicio/index.php" class="btn btn-light ">Inicio</a>';
        }
        public static function MenuBtn($catalogos = null)
        {
            $link = '';
            $countCatalogos = count($catalogos);
            for ($i=0; $i < $countCatalogos; $i++) { 
                $link .= '<a class="dropdown-item" href="'. $catalogos[$i]['ruta'].'">'. $catalogos[$i]['descripcion'].'</a>';
            }
            return '<div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Catalogos
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              '.$link.'
            </div>
          </div>';
        }
        public static function GetExitBtn()
        {
            return '<div class="ml-auto my-lg-0">'.self::ExitBtn().'</div>';
        }
        public static function GetMenuAndExit($catalogos = null)
        {
            return ''.self::MenuBtn($catalogos).''.self::ExitBtn().'';
        }
        public static function BasiCss()
        {
            return '';
        }
    }
    
}
?>
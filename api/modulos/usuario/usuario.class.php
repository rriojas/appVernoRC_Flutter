<?php
    namespace UsuarioNamespace
    {
        $included_files = get_included_files();
        if(!in_array(realpath((__DIR__).'/../../lib/base.class.php'), $included_files))
        {
            require (__DIR__).'/../../lib/base.class.php';            
        }
        use BaseNamespace\Base as Base;
        class Usuario extends Base
        {
            var $idUsuario, $idTipoUsuario, $correo, $clave, $nombre, $apellidoPaterno, $apellidoMaterno, $fechaNacimiento, $genero, $telefono, $calle, $colonia, $numero, $codigoPostal, $idCampus, $fechaCreacion, $fechaModifica, $validado, $idUsuarioValida, $fechaValida, $estatus;
            var $ColumnAlias = array('idUsuario' => 'idUsuario', 'idTipoUsuario' => 'idTipoUsuario', 'correo' => 'correo', 'clave' => 'clave', 'nombre' => 'nombre', 'apellidoPaterno' => 'apellidoPaterno', 'apellidoMaterno' => 'apellidoMaterno', 'fechaNacimiento' => 'fechaNacimiento', 'genero' => 'genero', 'telefono' => 'telefono', 'calle' => 'calle', 'colonia' => 'colonia', 'numero' => 'numero', 'codigoPostal' => 'codigoPostal', 'idCampus' => 'idCampus', 'fechaCreacion' => 'fechaCreacion', 'fechaModifica' => 'fechaModifica', 'validado' => 'validado', 'idUsuarioValida' => 'idUsuarioValida', 'fechaValida' => 'fechaValida', 'estatus' => 'estatus');
            function __construct( $idUsuario = 0 )
            {
                parent::__construct(get_object_vars($this), 'usuario', 'idUsuario', $this->ColumnAlias, $idUsuario);
            }
            function ValidarUsuario()
            {
                $sql = "UPDATE usuario SET validado = 1 WHERE idUsuario = $this->idUsuario";
                return $this->Update($sql);
            }
            function InvalidarUsuario()
            {
                $sql = "UPDATE usuario SET validado = 0 WHERE idUsuario = $this->idUsuario";
                return $this->Update($sql);
            }
        }
        
    }
?>
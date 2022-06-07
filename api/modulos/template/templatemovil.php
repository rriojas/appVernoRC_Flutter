<?php
session_start();
if(!isset($_SESSION['idUsuario']))
{
    header("Location:../../login.php");
}
$countModulo =      count($_SESSION['moduloPermitido']);
$accesoPermitido = false;
for ($i=0; $i < $countModulo; $i++)
{
    if(in_array($modulo, $_SESSION['moduloPermitido'][$i]))
        $accesoPermitido =  true;
}

if(!$accesoPermitido)
{
  header("Location:../../modulos/solicitudaceptadamovil/solicitudaceptadamovilcontroller.php");
}
/*
include '../../lib/Configuration.class.php';
use ConfigurationNamespace\Configuration as Configuration;*/
?>
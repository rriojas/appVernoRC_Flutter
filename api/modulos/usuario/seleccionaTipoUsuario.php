<?php
if(session_status() !== PHP_SESSION_ACTIVE)
    session_start();
    
if($_SESSION['idTipoUsuario'] == 1)
{
    ?>
    <button id="btnCoordinadorInstitucional" class="btn btn-outline-primary">Coordinador Institucional</button>
    <button id="btnCoordinadorCampus" class="btn btn-outline-primary">Coordinador Campus</button>
    <button id="btnInvestigador" class="btn btn-outline-success">Investigador</button>
    <button id="btnAlumno" class="btn btn-outline-info">Alumno</button>    
<?php
}
else if($_SESSION['idTipoUsuario'] == 2)
{
?>
<button id="btnCoordinadorCampus" class="btn btn-outline-primary">Coordinador Campus</button>
<?php
}
else
{
    die("No tienes permiso de estar aqui");
}
?>
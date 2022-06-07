<?php
if(session_status() !== PHP_SESSION_ACTIVE)
    session_start();
include '../solicitud/solicitud.class.php';
use CommonFuncNamespace\CommonFunc as   CommonFunc;
$funciones =    new CommonFunc();
use SolicitudNamespace\Solicitud as Solicitud;
$solicitud = new Solicitud();
$rsSolicitudAplicada = $solicitud->Selecciona("SELECT idSolicitud, orden, proyecto.titulo, solicitud.comentario, solicitud.fechaCreacion as 'Fecha de aplicacion' FROM `solicitud` INNER JOIN proyecto ON solicitud.idProyecto = proyecto.idProyecto WHERE solicitud.estatus = 1 and idUsuarioAlumno = ".$_SESSION['idUsuario']." order by orden");

?>
<div class="row">
    <div class="d-grid gap-2 col-sm-1 mx-auto" style="height:100px">
        <button id="btnEliminar" class="btn btn-danger" type="button"><span class="fas fa-trash"></span></button>
        <button id="btnUp" class="btn btn-primary" type="button"><span class="fas fa-arrow-up"></span></button>
        <button id="btnDown" class="btn btn-primary" type="button"><span class="fas fa-arrow-down"></span></button>
    </div>
    <div class="col-sm-11">
        <?php echo $funciones->ArrayToTable($rsSolicitudAplicada, "check"); ?>
    </div>
</div>
<?php
    session_start();
    $_SESSION['idUsuario'] = null;
    session_destroy();
    header('Location:../');
?>
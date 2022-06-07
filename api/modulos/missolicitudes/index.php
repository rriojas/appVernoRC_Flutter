<?php
    if($_POST)
        $file = $_POST['file'];
    else
        $file = "missolicitudes.php";
    $modulo = "Mis solicitudes";
    include '../template/template.php';
?>
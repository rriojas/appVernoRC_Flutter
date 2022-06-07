<?php
    if($_POST)
        $file = $_POST['file'];
    else
        $file = "list.php";
    $modulo = "Solicitud";
    include '../template/template.php';
?>
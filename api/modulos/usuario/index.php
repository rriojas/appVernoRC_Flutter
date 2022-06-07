<?php
    if($_POST)
        $file = $_POST['file'];
    else
        $file = "list.php";
    $modulo = "Usuario";
    include '../template/template.php';
?>
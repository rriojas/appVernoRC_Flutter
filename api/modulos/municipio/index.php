<?php
    if($_POST)
        $file = $_POST['file'];
    else
        $file = "list.php";
    $modulo = "Municipio";
    include '../template/template.php';
?>
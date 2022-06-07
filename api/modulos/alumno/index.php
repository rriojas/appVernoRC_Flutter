<?php
    if($_POST)
        $file = $_POST['file'];
    else
        $file = "list.php";
    $modulo = "Alumno";
    include '../template/template.php';
?>
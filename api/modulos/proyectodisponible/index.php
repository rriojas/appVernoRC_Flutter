<?php
    if($_POST)
        $file = $_POST['file'];
    else
        $file = "proyectodisponible.php";
    $modulo = "Proyectos disponibles";
    include '../template/template.php';
?>
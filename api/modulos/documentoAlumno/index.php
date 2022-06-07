<?php
    if($_POST)
        $file = $_POST['file'];
    else
        $file = "subirarchivo.php";
    $modulo = "Subir Documentos";
    include '../template/template.php';
?>
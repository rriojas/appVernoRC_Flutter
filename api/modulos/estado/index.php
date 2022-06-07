<?php
    if($_POST)
        $file = $_POST['file'];
    else
        $file = "list.php";
    $modulo = "Estado";
    include '../template/template.php';
?>
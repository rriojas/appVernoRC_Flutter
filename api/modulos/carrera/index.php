<?php
    if($_POST)
        $file = $_POST['file'];
    else
        $file = "list.php";
    if(isset($_REQUEST['idCampus']))
        $idCampusPadre = intval($_REQUEST['idCampus']);
    else
        $idCampusPadre = 0;
    $modulo = "Carrera";
    include '../template/template.php';
?>
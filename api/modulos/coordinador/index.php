<?php
    if($_POST)
        $file = $_POST['file'];
    else
        $file = "list.php";
    if(isset($_POST['idUsuario']))
        $idUsuario = $_POST['idUsuario'];
    else if($file == "form.php" && !isset($_POST['idUsuario']))
    {
        echo "Acceso no autorizado<br/>";
        die('<button id="btnCancelar" type="button" class="btn btn-outline-secondary">Aceptar</button>');
    }
    $modulo = "Usuario";
    include '../template/template.php';
?>
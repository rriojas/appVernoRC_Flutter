<?php
// Varios destinatarios
$para  = 'vagv19@gmail.com';

// título
$título = 'Prueba';

// mensaje
$mensaje = '
<html>
<head>
  <title>Prueba</title>
</head>
<body>
  <p>¡Email de prueba!</p>
</body>
</html>
';

// Para enviar un correo HTML, debe establecerse la cabecera Content-type
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";



// Enviarlo
mail($para, $título, $mensaje, $cabeceras);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <meta http-equiv="X-UA-compatible" content = "IE-Edge">
        <meta name="viewport" content ="width=divice-width, initial-scale=1.0 ">
        <link href="https://fonts.googleapis.com/css?/Family=Tahoma" href="stylesheet">
        <title>DPW2_U2_A2_ENMM_Salirphp</title>
        <link rel="stylesheet" href="Estilos.css" href="UsuarioPDC.html" href="UsuarioPF.html">
    </head>
    <body> 
    <?php
    session_start();
    $_SESSION = [];
    print_r($_SESSION);
    session_destroy();
   
    ?>
    </body>
</html>

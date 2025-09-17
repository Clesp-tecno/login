<?php

    session_start();
    if(!isset($_SESSION["loggedin"])|| $_SESSION["loggedin"]!==true){
        header("location: index.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0">
    <title>Bienvenido-al arbolito</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="ctn-welcome">
        <img src="Imagenes/logog.jpg" all="" class="logo-welcome">
        <h1 class="title-welcome">Bienvenido a <b>arbolito bonito.com</b>, gracias por iniciar sesión</h1>
        <a href="cerrar_sesion.php" class="close-sesion">Cerrar sesión</a>
    </div>
</body>
</html>
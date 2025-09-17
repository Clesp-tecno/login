<?php 

    include 'code_register.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="estilo.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0">
</head>
<body>
    <div class="container-all">
        <div class="ctn-form">
            <img src="Imagenes/logog.jpg" alt="" class="logo">
            <h1 class="title">Registrarse</h1>

            <form action="<?php echo htmlspecialchars (string: $_SERVER["PHP_SELF"]); ?>"method="post">
              <label for="">Nombre de usuario</label>
              <input type="text" name="username">
              <span class="msg-error"><?php echo $username_err;?></span>
              <label for="">Email</label>
              <input type="text" name="email">
              <span class="msg-error"><?php echo $email_err;?></span>
              <label>Contraseña</label>
              <input type="password" name="password">
              <span class="msg-error"><?php echo $password_err?></span>
              <input type="submit" value="Registrarse">
            </form>
            <span class="text-footer">¿Ya te has registrado?<a href="index.php"> Inicia Sesión</a></span>
        </div>
        <div class="ctn-text">
            <div class="capa"></div>
            <h2 class="title-description">Bienvenido sea mi niño no tan adorado</h2>
            <p class="text-description">Como puede ser que aun no te registres</p>
        </div>
    </div>
</body>
</html>
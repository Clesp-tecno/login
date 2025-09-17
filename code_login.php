<?php

    //inicializar la sesion
    session_start();
    //si la sesion esta iniciada que mande al documento de bienvenida
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]=== true){
        header("location: bienvenida.php");
        exit;
    }
    require_once "conexion.php";

    $email=$password="";
    $email_err=$password_err="";

    if($_SERVER["REQUEST_METHOD"]==="POST"){
        //errores
        //Si el campo esta en blanco de email
        if(empty(trim($_POST["email"]))){
            $email_err="Por favor ingrese el correo electrónico";
        }else{
            //se almacenan los datos que estan en email con trim y usando post
            $email = trim($_POST["email"]);
        }
        //si el campo de contraseña esta vacio
         if(empty(trim($_POST["password"]))){
            $password_err="Por favor ingrese una contraseña";
        }else{
            //se almacenan los datos que estan en password con trim y usando post
            $password = trim($_POST["password"]);
        }
        /////////////////////////////////////////////////////
        //validar credenciales
        if(empty($email_err)&& empty($password_err)){
            $sql="SELECT ID, Usuario, email, clave FROM usuarios WHERE email=?";
            //se creo stmt
            if($stmt=mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_email);
                $param_email=$email;

                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                }
                //rows verifica fila por fila
                if(mysqli_stmt_num_rows($stmt)==1){
                    //hashed porque la contraseña esta encriptada
                    mysqli_stmt_bind_result($stmt,$id,$usuario,$email,$hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password,$hashed_password)){
                            session_start();
                            //alamacenar los datos en variables de sesion
                            //va a poner la sesion en verdadera
                            $_SESSION["loggedin"]=true;
                            $_SESSION["id"]=$id;
                            $_SESSION["email"]=$email;
                            //envie a la pagina de bienvenida
                            header("location: bienvenida.php");
                        }else{
                            $password_err="la contraseña introducida no es válida";
                        }
                    }
                }else{
                        $email_err="No se ha encontrado el correo";
                    }
            }else{
                    echo "UPS: algo salió mal, inténtalo más tarde";
                }
        }
        mysqli_close($link);
    }
?>
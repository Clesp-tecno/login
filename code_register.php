<?php

    //Incluir archivo de conexiñon a la base de datos
    require_once "conexion.php";

    //definir variables e inicializar con valores vacios

    $username=$email=$password="";
    $username_err=$email_err=$password_err="";

    if($_SERVER ["REQUEST_METHOD"] == "POST"){
        //validando imput de nombre de usuario
        if(empty(trim($_POST["username"]))){
            $username_err="Por favor, ingrese un nombre de usuario";
        }else{
            //prepara una declaración de selección-nombre de la tabla
            $sql ="SELECT id FROM usuarios WHERE Usuario = ?";
            if($stmt = mysqli_prepare($link,$sql)){
                mysqli_stmt_bind_param($stmt,"s",$param_username);
                $param_username= trim($_POST["username"]);
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    //si existe el usuario
                    if(mysqli_stmt_num_rows($stmt)==1){
                        $username_err="Este nombre de usuario ya esta en uso";
                    }else{
                        $username=trim($_POST["username"]);
                    }
                }else{
                    echo "Algo salió mal, inténtalo más tarde";
                }
            }
        }

        //validar input de email
         if(empty(trim($_POST["email"]))){
            $email_err="Por favor, ingrese un email";
        }else{
            //prepara una declaración de selección-nombre de la tabla
            $sql ="SELECT id FROM usuarios WHERE email= ?";
            if($stmt = mysqli_prepare($link,$sql)){
                mysqli_stmt_bind_param($stmt,"s",$param_email);
                $param_email= trim($_POST["email"]);
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    //si existe el usuario
                    if(mysqli_stmt_num_rows($stmt)==1){
                        $email_err="Este correo ya esta en uso";
                    }else{
                        $email=trim($_POST["email"]);
                    }
                }else{
                    echo "Algo salió mal, inténtalo más tarde";
                }
            }
        }
        //validando contraseña
        //si esta limpio la variable de contraseña
        if(empty(trim($_POST["password"]))){
            $password_err= "Ingrese una contraseña";
        }elseif(strlen(trim($_POST["password"]))<4){
            $password_err="La contraseña debe de tener almenos 4 caracteres";
        }else{
            $password=trim($_POST["password"]);
        }
        //comprobar errores de entrada antes de insertar los datos en la base de datos
        if(empty($username_err)&& empty($email_err)&& empty($password_err)){
            //preparar sentencia steit
            $sql="INSERT INTO usuarios(usuario, email, clave) VALUES (?,?,?)";
            if($stmt=mysqli_prepare($link,$sql)){
                //datos de tipo string
                mysqli_stmt_bind_param($stmt,"sss",$param_username,$param_email,$param_password);
                //establecer parametros que se almacenaran en la base de datos
                $param_username=$username;
                $param_email=$email;
                //encriptar password
                $param_password=password_hash($password,PASSWORD_DEFAULT);

                if(mysqli_stmt_execute($stmt)){
                    header("location:index.php");
                }else{
                    echo "Algo malio sal";
                }
            }
        }
        mysqli_close($link);
    }

?>
<?php

    define(constant_name: 'DB_SERVER',value: 'localhost');
    define(constant_name: 'DB_USERNAME',value: 'root');
    define(constant_name: 'DB_PASSWORD',value: '');
    define(constant_name: 'DB_NAME',   value: 'login_practica');

    $link = mysqli_connect( DB_SERVER,  DB_USERNAME,  DB_PASSWORD,DB_NAME);
    if($link === false){
        die("Algo ta mal" . mysqli_connect_error);
    }/*else{
        echo 'Conexion exitosa';
    }*/
?>
<?php

    require "../config/conexion.php";
    session_start();

    $imail = $_POST["email"];
    $contra = $_POST["contraseña"];

    if (!$contra || !$imail){
        echo("campos incompletos");
    }

    $consulta = $conexion -> query("SELECT * FROM usuarios");


    foreach ($consulta as $user){
        if ($user["email"] == $imail){
            password_verify($contra, $user["password"]);
            $_SESSION["email"] = $user["email"];
            $_SESSION["contra"] = $user["password"];
            $_SESSION["rol"] = $user["rol"];
        }
    }

    
    header('location: ../index.php');
    exit()

?>
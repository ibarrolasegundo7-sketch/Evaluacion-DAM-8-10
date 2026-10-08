<?php

    require "../config/conexion.php";

    $imail = $_POST["email"];
    $contra = $_POST["contraseña"];
    $roll = $_POST["rol"];

    if (!$roll || !$contra || !$imail){
        echo("campos incompletos");
    }

    $contra_hast = password_hash($contra, PASSWORD_DEFAULT);

   $consulta = $conexion->prepare("INSERT INTO usuarios (email, password, rol) VALUES (:email, :contra, :rol)");
   $consulta->execute([
       ":email" =>  $imail,
       ":contra" => $contra_hast,
       ":rol" => $roll
]);

    $_SESSION["email"] = $imail;
    $_SESSION["contra"] = $contra;
    $_SESSION["rol"] = $roll;
    
    header('location: ../index.php');
    exit()

?>
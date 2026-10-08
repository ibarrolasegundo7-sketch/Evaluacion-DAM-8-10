<?php

    require "../config/conexion.php";

    $marca = $_POST["marca"];
    $modelo = $_POST["modelo"];
    $anio = $_POST["anio"];
    $precio = $_POST["precio"];
    $descripcion = $_POST["descripcion"];
    $img = $_POST["imagen"];

    if (!$marca || !$modelo || !$anio || !$precio || !$descripcion || !$img){
        echo("campos incompletos");
    }

    $consulta = $conexion->prepare("INSERT INTO vehiculos (marca, modelo, anio, precio, descripcion, imagen) VALUES (:marca, :modelo, :anio, :precio, :descripcion, :imagen)");
    $consulta -> execute([
        "marca" => $marca,
        ":modelo" => $modelo,
        ":anio" => $anio,
        ":precio" => $precio,
        ":descripcion" => $descripcion,
        ":imagen" => $img
    ]);
    
    header('location: ../index.php');
    exit()

?>
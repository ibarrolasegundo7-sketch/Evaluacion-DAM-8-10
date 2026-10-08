<?php

session_start();
require "../config/conexion.php";


$id = $_POST["id"];
$marca = $_POST["marca"];
$modelo = $_POST["modelo"];
$anio = $_POST["anio"];
$precio = $_POST["precio"];
$descripcion = $_POST["descripcion"];
$img = $_POST["imagen"];

$consulta = $conexion -> prepare("UPDATE vehiculos SET marca = :marca, modelo = :modelo, anio = :anio, precio = :precio, descripcion = :descripcion, imagen = :imagem WHERE id = :id");
$consulta->execute([
    ":marca" => $marca,
    ":modelo" => $modelo,
    ":anio" => $anio,
    ":precio" => $precio,
    ":descripcion" => $descripcion,
    ":imagem" => $img,
    ":id" => $id,
]);

header("location: ../index.php?res=ok");
exit()

?>
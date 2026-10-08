<?php

require "config/conexion.php";

$id = $_GET["id"];
$consulta = $conexion -> prepare("SELECT * FROM vehiculos WHERE id = :id");
$consulta->execute([
    ":id" => $id
]);
$vehiculo = $consulta->fetch();

?>

<form action="actions/actualizar.php" method="post">
    <input type="text" name="id" placeholder="marca" value="<?= $vehiculo["id"]; ?>" hidden>
    <div><label for="">marca: </label><input type="text" name="marca" placeholder="marca" value="<?= $vehiculo["marca"]; ?>"></div>
    <div><label for="">modelo: </label><input type="text" name="modelo" placeholder="modelo" value="<?= $vehiculo["modelo"]; ?>"></div>
    <div><label for="">año: </label><input type="int" name="anio" placeholder="año" value="<?= $vehiculo["anio"]; ?>"></div>
    <div><label for="">precio: </label><input type="int" name="precio" placeholder="precio" value="<?= $vehiculo["precio"]; ?>"></div>
    <div><label for="">descripcion: </label><input type="text" name="descripcion" placeholder="descripcion" value="<?= $vehiculo["descripcion"]; ?>"></div>
    <div><label for="">imagen: </label><input type="text" name="imagen" placeholder="URL de la img" value="<?= $vehiculo["imagen"]; ?>"></div>
    <div><button>editar</button></div>
</form>
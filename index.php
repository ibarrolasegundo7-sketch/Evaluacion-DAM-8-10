<?php

session_start();
require "config/conexion.php";

$vehiculos = $conexion->query("SELECT * FROM vehiculos")

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .user{
            display: none;
        }
    </style>
</head>
<body>

    <p>email: <b><?= $_SESSION["email"] ?></b></p>
    <p>roll: <b><?= $_SESSION["rol"] ?></b></p>

    
    <h1>Rodados del Sudeste</h1>

    <a href="sing in.php">registrarse</a>
    <br>
    <a href="log in.php">logearse</a>

    <section>
        <?php foreach ($vehiculos as $vehiculo): ?>
            <div>
                <img src="<?= $vehiculo["imagen"] ?>" alt="">
                <p><?= $vehiculo["marca"] ?></p>
                <p><?= $vehiculo["modelo"] ?></p>
                <p><?= $vehiculo["anio"] ?></p>
                <p><?= $vehiculo["precio"] ?></p>
                <p><?= $vehiculo["descripcion"] ?></p>
                <a href="editar.php?id=<?= $vehiculo["id"] ?>" class="<?= $_SESSION["rol"] ?>">editar</a>
                <a href="actions/eliminar.php?id=<?= $vehiculo["id"] ?>" class="<?= $_SESSION["rol"] ?>">eliminar</a>
            </div>
            <hr>

        <?php  endforeach ?>
    </section>
    
    <!-- crear -->
    <form action="actions/guardar.php" method="post" class="<?= $_SESSION["rol"] ?>">

        <div><label for="">marca: </label><input type="text" name="marca" placeholder="marca"></div>
        <div><label for="">modelo: </label><input type="text" name="modelo" placeholder="modelo"></div>
        <div><label for="">año: </label><input type="int" name="anio" placeholder="año"></div>
        <div><label for="">precio: </label><input type="int" name="precio" placeholder="precio"></div>
        <div><label for="">descripcion: </label><input type="text" name="descripcion" placeholder="descripcion"></div>
        <div><label for="">imagen: </label><input type="text" name="imagen" placeholder="URL de la img"></div>
        <div><button>agregar</button></div>
    </form>

</body>
</html>
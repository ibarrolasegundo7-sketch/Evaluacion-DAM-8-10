<?php

require "../config/conexion.php";

$id = $_GET["id"];

$consulta = $conexion->prepare("DELETE FROM vehiculos WHERE id = :id");
$consulta->execute([
    ":id" => $id,
]);

header("location: ../index.php?res=ok");
exit()

?>
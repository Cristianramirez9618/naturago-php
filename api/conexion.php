<?php

header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . "/../config/database.php";

echo json_encode([
    "success" => true,
    "mensaje" => "Conexión con la base de datos realizada correctamente"
]);

?>
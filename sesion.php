<?php
session_start();

header("Content-Type: application/json; charset=UTF-8");

if (isset($_SESSION["nombre_cliente"])) {
    echo json_encode([
        "logueado" => true,
        "nombre" => $_SESSION["nombre_cliente"]
    ]);
} else {
    echo json_encode([
        "logueado" => false
    ]);
}
?>
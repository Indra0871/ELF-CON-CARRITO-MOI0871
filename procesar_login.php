<?php
session_start();
require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $correo = trim($_POST["correo"]);
    $password = $_POST["password"];

    $sql = "SELECT id, nombre, password FROM clientes WHERE correo = ?";

    $consulta = $conexion->prepare($sql);
    $consulta->bind_param("s", $correo);
    $consulta->execute();

    $resultado = $consulta->get_result();

    if ($usuario = $resultado->fetch_assoc()) {

        if (password_verify($password, $usuario["password"])) {

            $_SESSION["id_cliente"] = $usuario["id"];
            $_SESSION["nombre_cliente"] = $usuario["nombre"];

            header("Location: index.html");
            exit;

        }
    }

    header("Location: login.html?error=credenciales");
    exit;

} else {
    header("Location: login.html");
    exit;
}
?>

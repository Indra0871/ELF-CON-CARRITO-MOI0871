<?php
require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = trim($_POST["nombre"]);
    $correo = trim($_POST["correo"]);
    $password = $_POST["password"];
    $telefono = trim($_POST["telefono"]);

    if (
        empty($nombre) ||
        empty($correo) ||
        empty($password) ||
        empty($telefono)
    ) {
        exit("Todos los campos son obligatorios. Regresa al formulario e inténtalo de nuevo.");
    }

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        exit("El correo electrónico no es válido.");
    }

    $password_segura = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO clientes (nombre, correo, password, telefono)
            VALUES (?, ?, ?, ?)";

    $consulta = $conexion->prepare($sql);

    if (!$consulta) {
        exit("No se pudo preparar el registro. Revisa la configuración.");
    }

    $consulta->bind_param(
        "ssss",
        $nombre,
        $correo,
        $password_segura,
        $telefono
    );

    if ($consulta->execute()) {
        header("Location: registro.html?registro=ok");
        exit;
    } else {
        if ($consulta->errno == 1062) {
            header("Location: registro.html?registro=duplicado");
            exit;
        } else {
            header("Location: registro.html?registro=error");
            exit;
        }
    }

    $consulta->close();
    $conexion->close();

} else {
    header("Location: registro.html");
    exit;
}
?>
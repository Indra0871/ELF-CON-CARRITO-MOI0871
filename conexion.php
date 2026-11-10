<?php
// Indica el inicio del código PHP.

// Guarda el nombre del servidor donde está MySQL.
$servidor = "localhost";
// Indica el usuario para acceder a MySQL.
$usuario = "root";
// Guarda la contraseña del usuario.
// En XAMPP normalmente está vacía por defecto.
$contrasena = "";
// Indica el nombre de la base de datos que vamos a utilizar.
$base_datos = "elf_cosmetics";
// Crea la conexión entre PHP y MySQL usando los datos anteriores.
$conexion = new mysqli(
    $servidor,    // Servidor de la base de datos.
    $usuario,     // Usuario de MySQL.
    $contrasena,  // Contraseña de MySQL.
    $base_datos   // Base de datos a la que queremos conectarnos.
);
// Comprueba si ocurrió un error al establecer la conexión.
if ($conexion->connect_error) {
    // Guarda el detalle del error en el registro de errores del servidor.
    error_log("Error de conexión: " . $conexion->connect_error);
    // Detiene el programa y muestra un mensaje si no se pudo conectar.
    exit("No se pudo conectar con la base de datos. Revisa la configuración.");
}
// Configura la conexión para utilizar caracteres UTF-8,
// como acentos, la letra ñ y otros caracteres especiales.
if (!$conexion->set_charset("utf8mb4")) {
    // Guarda el detalle del error si no se pudo configurar el conjunto de caracteres.
    error_log("Error al configurar UTF-8: " . $conexion->error);
    // Detiene el programa si ocurrió un error en esta configuración.
    exit("No se pudo configurar la conexión.");
}
// Cierra la etiqueta PHP e indica el final del código PHP.
?>

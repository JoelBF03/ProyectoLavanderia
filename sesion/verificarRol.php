<?php
function verificarRol($rolRequerido) {
    session_start();

    // Verificar si el usuario está autenticado
    if (!isset($_SESSION['cli_cedula'])) {
        header("Location: Sesion.php"); // Redirigir al login si no está autenticado
        exit;
    }

    include("../conexion/conexion.php");

    // Obtener el rol del usuario desde la base de datos
    $query = "SELECT cli_rol FROM cliente2 WHERE cli_cedula = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('s', $_SESSION['cli_cedula']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        header("Location: Sesion.php"); // Redirigir si el usuario no existe
        exit;
    }

    $user = $result->fetch_assoc();
    $cli_rol = $user['cli_rol'];

    // Verificar si el rol del usuario coincide con el requerido
    if ($cli_rol !== $rolRequerido) {
        header("Location: acceso_denegado.php"); // Redirigir a una página de acceso denegado
        exit;
    }
}
?>
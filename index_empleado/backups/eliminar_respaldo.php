<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    // Verificar si el usuario está autenticado
    if (!isset($_SESSION['cli_cedula'])) {
        echo json_encode(['success' => false, 'message' => 'No tienes acceso a esta función.']);
        exit;
    }

    $cli_cedula = $_SESSION['cli_cedula'];

    // Incluir archivo de conexión
    include("../../conexion/conexion.php");

    // Verificar el rol del usuario
    $query = "SELECT cli_rol FROM cliente2 WHERE cli_cedula = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('s', $cli_cedula);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Usuario no encontrado.']);
        exit;
    }

    $user = $result->fetch_assoc();
    $cli_rol = $user['cli_rol'];

    if ($cli_rol !== 'Empleado') {
        echo json_encode(['success' => false, 'message' => 'No tienes permisos para realizar esta acción.']);
        exit;
    }

    // Obtener datos del respaldo a eliminar
    $data = json_decode(file_get_contents('php://input'), true);
    if (!isset($data['respaldo'])) {
        echo json_encode(['success' => false, 'message' => 'No se proporcionó el nombre del respaldo.']);
        exit;
    }

    $respaldo = $data['respaldo'];
    $backupDir = __DIR__ . '/backups/';
    $filepath = $backupDir . $respaldo;

    // Eliminar el archivo del sistema
    if (file_exists($filepath)) {
        if (unlink($filepath)) {
            echo json_encode(['success' => true, 'message' => 'Respaldo eliminado correctamente.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se pudo eliminar el respaldo.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'El archivo no existe.']);
    }

    // Cerrar conexión
    $conexion->close();
}
?>
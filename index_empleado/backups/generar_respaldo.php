<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    ini_set('max_execution_time', 300);
    ini_set('memory_limit', '512M');

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

    // Directorio para respaldos
    $backupDir = __DIR__ . '/backups/';
    if (!is_dir($backupDir)) {
        mkdir($backupDir, 0755, true);
    }

    // Nombre del archivo de respaldo
    $filename = 'respaldo_' . date('Y-m-d_H-i-s') . '.sql';
    $filepath = $backupDir . $filename;

    // Comando mysqldump
    $command = "C:\\xampp\\mysql\\bin\\mysqldump --host=localhost --user=$username --password=$password $dbname > $filepath";
    exec($command . " 2>&1", $output, $resultCode);

    if ($resultCode === 0) {
        // Registrar el respaldo en la base de datos
        $fecha_generacion = date('Y-m-d H:i:s');
        $insertQuery = "INSERT INTO backups (archivo, fecha_generacion, cli_cedula) VALUES (?, ?, ?)";
        $stmt = $conexion->prepare($insertQuery);

        if ($stmt) {
            $stmt->bind_param('sss', $filename, $fecha_generacion, $cli_cedula);
            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Respaldo generado y registrado correctamente.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Respaldo generado, pero no se registró en la base de datos.']);
            }
            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta para registrar el respaldo.']);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error al ejecutar mysqldump.',
            'details' => implode("\n", $output),
            'code' => $resultCode
        ]);
    }

    // Cerrar conexión
    $conexion->close();
}
?>

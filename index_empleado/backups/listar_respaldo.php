<?php
$backupDir = __DIR__ . '/backups/';
$respaldos = [];

if (is_dir($backupDir)) {
    $files = scandir($backupDir);
    foreach ($files as $file) {
        if (strpos($file, 'respaldo_') === 0) {
            $respaldos[] = $file;
        }
    }
}

echo json_encode(['success' => true, 'respaldos' => $respaldos]);
?>

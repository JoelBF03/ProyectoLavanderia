<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title>Generar Respaldos</title>
    <link rel="stylesheet" href="../../recursos/encabezado.css" />
    <link rel="stylesheet" href="backup.css" />
    <?php include("../../conexion/conexion.php"); ?>
</head>

<body>
    <header>
        <nav id="navbar">
            <img id="logo" src="../../recursos/logo.png">
            <div id="navbar_buttons">
                <a href="../menu.php">Menú</a>
                <a href="../../sesion/cerrarSesion.php">Cerrar Sesión</a>
            </div>
        </nav>
    </header>

    <main>
        <h1>Generar Respaldos</h1>

        <div class="backup-container">
            <button type="button" id="crear_respaldo" class="backup-btn">Crear Respaldo</button>
            <button type="button" id="eliminar_respaldo" class="backup-btn">Eliminar Respaldo</button>
        </div>

        <section class="respaldo-list">
            <h2>Respaldos existentes:</h2>
            <ul id="lista_respaldo">
                <!-- Aquí irán los respaldos generados -->
                <li>No hay respaldos disponibles.</li>
            </ul>
        </section>
    </main>

    <script src="backup.js"></script>
</body>

</html>

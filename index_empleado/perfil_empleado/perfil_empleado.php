<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Perfil</title>
    <script src="cambios.js"></script>
    <link rel="stylesheet" href="../../recursos/encabezado.css">
    <link rel="stylesheet" href="perfil.css">

    <?php include("../../conexion/conexion.php"); ?>
</head>
<body>
    <!-- Encabezado -->
    <header>
        <nav id="navbar">
            <img id="logo" src="../../recursos/logo.png" alt="Logo">
            <div id="navbar_buttons">
                <div id="navbar_link">
                    <a href="../menu.php">Menú</a>
                    <a href="../../sesion/cerrarSesion.php">Cerrar Sesión</a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Contenido principal -->
    <h1>Gestionar Perfil</h1>
    <form id="form_perfil" method="post" action="guardar_cambios.php">
        <table border="2">
            <tr>
                <th></th>
                <th>Mis Datos</th>
            </tr>
            <?php
                session_start();
                if (isset($_SESSION["cli_cedula"])) {
                    $cli_cedula = $_SESSION["cli_cedula"];
                    
                    // Consulta para obtener los datos del cliente
                    $sqlConsulta = "SELECT cli_cedula, cli_nombre, cli_apellido, cli_telefono, cli_email FROM cliente2 WHERE cli_cedula = '$cli_cedula'";
                    $resultadoConsulta = mysqli_query($conexion, $sqlConsulta);

                    if ($resultadoConsulta && $row = mysqli_fetch_assoc($resultadoConsulta)) {
                        // Generar los campos con los datos
                        echo "<tr><td>Nombre:</td><td><input type='text' name='input_nombre' id='input_nombre' value='{$row['cli_nombre']}' readonly></td></tr>";
                        echo "<tr><td>Apellido:</td><td><input type='text' name='input_apellido' id='input_apellido' value='{$row['cli_apellido']}' readonly></td></tr>";
                        echo "<tr><td>Cédula:</td><td><input type='text' name='input_cedula' id='input_cedula' value='{$row['cli_cedula']}' readonly></td></tr>";
                        echo "<tr><td>Teléfono:</td><td><input type='text' name='input_telefono' id='input_telefono' value='{$row['cli_telefono']}' readonly></td></tr>";
                        echo "<tr><td>Correo Electrónico:</td><td><input type='text' name='input_email' id='input_email' value='{$row['cli_email']}' readonly></td></tr>";
                    }
                }
            ?>
        </table>
        <br>
        <!-- Botón para guardar cambios (oculto por defecto) -->
        <button id="guardar_cambios" name="guardar_cambios" type="submit">Guardar Cambios</button>
        </form>
    <br>
    <!-- Botón para habilitar edición -->
    <button id="habilitar_edicion" type="button" onclick="habilitar_edicion_empleado()">Editar Perfil</button>
    </body>
</html>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title> Menu Cliente </title>
    <script src="rutas.js"> </script>
    <link rel="stylesheet" href="../recursos/encabezado.css" />
    <link rel="stylesheet" href="../recursos/cliente.css" />
</head>

<body>
    <header>
        <nav id="navbar">
            <img id="logo" src="../recursos/logo.png">
            <div id="navbar_buttons">
                <div id="navbar_link">
                    <a href="menu.php"> Menú </a>
                    <a href="../sesion/cerrarSesion.php"> Cerrar Sesión </a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Contenedor de bienvenida -->
    <div id="welcome-container">
        <h1>Bienvenido
            <label id="nombre_menu">
                <?php
                session_start();
                if (isset($_SESSION["cli_cedula"])) {
                    $cli_cedula = $_SESSION["cli_cedula"];

                    include("../conexion/conexion.php");

                    $sqlConsulta = "SELECT cli_nombre FROM cliente2 where cli_cedula = '$cli_cedula'";
                    $resultadoConsulta = mysqli_query($conexion, $sqlConsulta);
                    if ($resultadoConsulta) {
                        if ($row = mysqli_fetch_array($resultadoConsulta)) {
                            echo $row["cli_nombre"];
                        }
                    }
                }
                ?>
                !</label>
        </h1>

        <!-- Botones en una cuadrícula -->
        <div class="buttons-container">
            <button type="button" id="pedido_cliente">Nuevo Pedido</button>
            <button type="button" id="perfil_cliente">Gestionar Perfil</button>
            <button type="button" id="seguimiento_cliente">Pedidos Activos</button>
            <button type="button" id="historial_cliente">Todos Mis Pedidos</button>
        </div>
    </div>

    <!-- Pie de página -->
    <footer>
        <?php
        // Obtener la última fecha de respaldo
        $sqlBackup = "SELECT fecha_generacion FROM backups ORDER BY fecha_generacion DESC LIMIT 1";
        $resultadoBackup = mysqli_query($conexion, $sqlBackup);
        if ($resultadoBackup) {
            if ($row = mysqli_fetch_array($resultadoBackup)) {
                // Formatear la fecha
                $fecha_generacion = new DateTime($row['fecha_generacion']);
                echo "Último respaldo: " . $fecha_generacion->format('d-m-Y_H-i-s');
            } else {
                echo "No se ha realizado un respaldo aún.";
            }
        }
        ?>
    </footer>
</body>

</html>
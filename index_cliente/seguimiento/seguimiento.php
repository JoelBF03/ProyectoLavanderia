<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title>Seguimiento de Pedidos</title>
    <link rel="stylesheet" href="seguimiento.css" />
    <link rel="stylesheet" href="../../recursos/encabezado.css" />
    <?php include("../../conexion/conexion.php"); ?>
</head>

<body>
    <header>
        <nav id="navbar">
            <img id="logo" src="../../recursos/logo.png">
            <div id="navbar_buttons">
                <div id="navbar_link">
                    <a href="../menu.php">Menú</a>
                    <a href="../../sesion/cerrarSesion.php">Cerrar Sesión</a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <h1>Seguimiento de Pedidos</h1>

        <?php
        session_start();
        if (isset($_SESSION["cli_cedula"])) {
            $cli_cedula = $_SESSION["cli_cedula"];

            $sqlConsultaSeguimiento = " SELECT
                pedido.PED_ID AS '#Pedido',
                tipo_servicio.TS_DESCRIPCION AS 'Tipo_de_servicio',
                tipo_lavado.TL_DESCRIPCION AS 'Tipo_de_Lavado',
                pedido.PED_ROPA AS 'Prendas',
                pedido.PED_CANTIDAD AS 'Cantidad',
                pedido.PED_OBSERVACIONES AS 'Observaciones',
                pedido.PED_FECHA_ENTREGA_LOCAL AS 'Fecha_Pedido',
                metodo_pago.descripcion AS 'MetodoDePago',
                estado_pedido.EP_DESCRIPCION AS 'Estado'
            FROM pedido
            INNER JOIN tipo_servicio ON tipo_servicio.TS_ID = pedido.TS_ID
            INNER JOIN tipo_lavado ON tipo_lavado.TL_ID = pedido.TL_ID
            INNER JOIN metodo_pago ON metodo_pago.mp_id = pedido.MP_ID
            INNER JOIN estado_pedido ON estado_pedido.EP_ID = pedido.EP_ID
            WHERE pedido.cli_cedula = '$cli_cedula';";
            $resultadoConsultaSeguimiento = mysqli_query($conexion, $sqlConsultaSeguimiento);

            if ($resultadoConsultaSeguimiento && mysqli_num_rows($resultadoConsultaSeguimiento) > 0) {
                while ($row = mysqli_fetch_array($resultadoConsultaSeguimiento)) {
                    if ($row['Estado'] !== 'ENTREGADO') {
                        echo "<table class='pedido'><tr> <th colspan='2'>Pedidos Activos:</th></tr>";
                        echo "<tr><td><strong>#Pedido:</strong> </td><td>{$row['#Pedido']}</td></tr>";
                        echo "<tr><td><strong>Tipo de Servicio:</strong> </td><td>{$row['Tipo_de_servicio']}</td></tr>";
                        echo "<tr><td><strong>Tipo de Lavado:</strong> </td><td>{$row['Tipo_de_Lavado']}</td></tr>";
                        echo "<tr><td><strong>Prendas:</strong> </td><td>{$row['Prendas']}</td></tr>";
                        echo "<tr><td><strong>Cantidad:</strong> </td><td>{$row['Cantidad']}</td></tr>";
                        echo "<tr><td><strong>Observaciones:</strong> </td><td>{$row['Observaciones']}</td></tr>";
                        echo "<tr><td><strong>Fecha Pedido:</strong> </td><td>{$row['Fecha_Pedido']}</td></tr>";
                        echo "<tr><td><strong>Método de Pago:</strong> </td><td>{$row['MetodoDePago']}</td></tr>";
                        $estadoClase = obtenerClaseEstado($row['Estado']);
                        echo "<tr><td><strong>Estado:</strong> </td><td class='$estadoClase'>{$row['Estado']}</td></tr>";
                        echo "</table><br>";
                    }
                }
            } else {
                echo "<p class='mensaje'>No se encontraron pedidos activos.</p>";
            }
        }

        function obtenerClaseEstado($estado)
        {
            switch ($estado) {
                case 'EN ESPERA...':
                    return 'EN-ESPERA';

                case 'LAVANDO...':
                    return 'LAVANDO';

                case 'SECANDO...':
                    return 'SECANDO';

                case 'PLANCHANDO...':
                    return 'PLANCHANDO';

                case 'LISTO PARA ENTREGAR':
                    return 'LISTO-PARA-ENTREGAR';

                case 'ENTREGADO':
                    return 'ENTREGADO';

                default:
                    return '';
            }
        }
        ?>

    </main>

    <footer>
        <?php
        // Obtener la última fecha de respaldo
        $sqlBackup = "SELECT fecha_generacion FROM backups ORDER BY fecha_generacion DESC LIMIT 1";
        $resultadoBackup = mysqli_query($conexion, $sqlBackup);
        if ($resultadoBackup) {
            if ($row = mysqli_fetch_array($resultadoBackup)) {
                // Formatear la fecha
                $fecha_generacion = new DateTime($row['fecha_generacion']);
                echo "Último respaldo: " . $fecha_generacion->format('d-m-Y H:i:s');
            } else {
                echo "No se ha realizado un respaldo aún.";
            }
        }
        ?>
    </footer>
</body>

</html>

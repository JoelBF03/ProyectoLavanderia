<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title>Seguimiento de Pedidos</title>
    <link rel="stylesheet" href="seguimiento_empleado.css" />
    <link rel="stylesheet" href="../../recursos/encabezado.css" />
    <script src="../SeguimientoPedidos/editar.js"></script>
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

    <h1>SEGUIMIENTO DE PEDIDOS</h1>
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
        ORDER BY pedido.PED_ID ASC;";

        $resultadoConsultaSeguimiento = mysqli_query($conexion, $sqlConsultaSeguimiento);

        if ($resultadoConsultaSeguimiento && mysqli_num_rows($resultadoConsultaSeguimiento) > 0) {
            while ($row = mysqli_fetch_array($resultadoConsultaSeguimiento)) {
                if ($row['Estado'] !== 'ENTREGADO') {
                    $pedidoId = $row['#Pedido'];
                    echo "<table border='2px'>
                            <tr><th colspan='2'>Pedidos Activos:</th></tr>
                            <tr><td>#Pedido:</td><td>{$row['#Pedido']}</td></tr>
                            <tr><td>Tipo de Servicio:</td><td>{$row['Tipo_de_servicio']}</td></tr>
                            <tr><td>Tipo de Lavado:</td><td>{$row['Tipo_de_Lavado']}</td></tr>
                            <tr><td>Prendas:</td><td>{$row['Prendas']}</td></tr>
                            <tr><td>Cantidad:</td><td>{$row['Cantidad']}</td></tr>
                            <tr><td>Observaciones:</td><td>{$row['Observaciones']}</td></tr>
                            <tr><td>Fecha Pedido:</td><td>{$row['Fecha_Pedido']}</td></tr>
                            <tr><td>Metodo de Pago:</td><td>{$row['MetodoDePago']}</td></tr>";
                    $estadoClase = obtenerClaseEstado($row['Estado']);
                    echo "<tr><td>Estado:</td><td class='$estadoClase'>
                            <input type='text' name='input_estado' id='input_estado_$pedidoId' value='{$row['Estado']}' readonly>
                            <form method='POST' action='editar_estado.php' id='form_estado_$pedidoId'>
                                <button id='actualizar_estado' name='actualizar_estado' type='submit' hidden>Guardar cambios</button>
                                <button type='button' onclick='editar_estado(\"input_estado_$pedidoId\")' id='boton_editar'>Editar</button>
                            </form>
                          </td></tr>
                          </table><br>";
                }
            }
        } else {
            echo "No se encontraron pedidos.";
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
</body>

</html>

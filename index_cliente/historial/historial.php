<!DOCTYPE html>
<html lang = es>

    <head>
        <meta charset="UTF-8"/>
        <title> Historial de Pedidos </title>
        <link rel="stylesheet" href="../seguimiento/seguimiento.css" />
        <link rel="stylesheet" href="../../recursos/encabezado.css" />
        <?php include("../../conexion/conexion.php"); ?>

    </head>

    <body>
        <header>
            <nav id="navbar">
                <img id="logo" src="../../recursos/logo.png">
                <div id="navbar_buttons">
                    <div id="navbar_link">
                        <a href="../menu.php"> Menú </a>
                        <a href="../../sesion/cerrarSesion.php"> Cerrar Sesión </a>
                    </div>
                </div>
            </nav>
        </header>
        <h1> HISTORIAL DE PEDIDOS </h1>
        <form id="filtro_form" method="post" action="">
            <label for="filtro_historial"> Filtrar pedido por fecha </label>
            <input type="date" id="filtro_historial" name="filtro_historial">
            <button type="submit" name="buscar"> Buscar </button>
        </form>
        <br>
        <?php
            session_start();
            if(isset($_SESSION["cli_cedula"])){
                $cli_cedula = $_SESSION["cli_cedula"];

                if(isset($_POST['filtro_historial'])){
                    $fecha_filtro = $_POST['filtro_historial'];

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
                    WHERE pedido.cli_cedula = '$cli_cedula' AND pedido.PED_FECHA_ENTREGA_LOCAL = '$fecha_filtro'";
                } else {
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
                }
             
                $resultadoConsultaSeguimiento = mysqli_query($conexion, $sqlConsultaSeguimiento);

                if($resultadoConsultaSeguimiento && mysqli_num_rows($resultadoConsultaSeguimiento) > 0){
                    while ($row = mysqli_fetch_array($resultadoConsultaSeguimiento)) {
                        echo "<table border= '2px'><tr> <th colspan='2'> Pedido </th></tr>";
                        echo "<tr><td>#Pedido: </td><td>{$row['#Pedido']}</td></tr>";
                        echo "<tr><td>Tipo de Servicio: </td><td>{$row['Tipo_de_servicio']}</td></tr>";
                        echo "<tr><td>Tipo de Lavado: </td><td>{$row['Tipo_de_Lavado']}</td></tr>";
                        echo "<tr><td>Prendas: </td><td>{$row['Prendas']}</td></tr>";
                        echo "<tr><td>Cantidad: </td><td>{$row['Cantidad']}</td></tr>";
                        echo "<tr><td>Observaciones: </td><td>{$row['Observaciones']}</td></tr>";
                        echo "<tr><td>Fecha Pedido: </td><td>{$row['Fecha_Pedido']}</td></tr>";
                        echo "<tr><td>Metodo de Pago: </td><td>{$row['MetodoDePago']}</td></tr>";
                        $estadoClase = obtenerClaseEstado($row['Estado']);
                        echo "<tr><td>Estado: </td><td class='$estadoClase'>{$row['Estado']}</td></tr>";
                        echo "</table><br>";
                    }
                } else {
                    echo "No se encontraron pedidos.";
                }
            }
            function obtenerClaseEstado($estado){
                switch($estado){
                    case 'EN ESPERA...':
                        return 'EN-ESPERA';
                    
                    case 'LAVANDO...':
                        return 'LAVANDO';

                    case 'SECANDO...':
                        return 'SECANDO';

                    case 'PLANCHANDO...':
                        return 'PLANCHANDO';

                    case 'LISTO PARA ENTREGAR':
                        return 'LISTO PARA ENTREGAR';

                    case 'ENTREGADO':
                        return 'ENTREGADO';

                    default:
                        return '';
                }
            }
        ?>

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
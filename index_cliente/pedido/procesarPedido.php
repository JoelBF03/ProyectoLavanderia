<?php
    #ENVIAR Y ALMACENAR LA INFORMACION DEL FORMULARIO EN LA BASE DE DATOS

    session_start();
    if(isset($_SESSION["cli_cedula"])){
        $cli_cedula = $_SESSION["cli_cedula"];

        include("C:/xampp/htdocs/ProyectoLavanderia/conexion/conexion.php");
        include("C:/xampp/htdocs/ProyectoLavanderia/bdd/BaseDeDatos.php");

        $TS_ID = mysqli_real_escape_string($conexion, $_POST['TipoServicio']);
        $TL_ID = mysqli_real_escape_string($conexion, $_POST['TipoLavado']);
        $PED_ROPA = implode(", ", $_POST['TiposRopa']);
        $PED_CANTIDAD = mysqli_real_escape_string($conexion, $_POST['Cantidad']);
        $PED_OBSERVACIONES = mysqli_real_escape_string($conexion, $_POST['Observaciones']);
        $PED_FECHA_ENTREGA_LOCAL = mysqli_real_escape_string($conexion, $_POST['FechaEntregaLocal']);
        $MP_ID = mysqli_real_escape_string($conexion, $_POST['metodo_pago']);

        $sqlInsertPedido = "INSERT INTO pedido (TL_ID, TS_ID, PED_ROPA, PED_CANTIDAD, PED_OBSERVACIONES, PED_FECHA_ENTREGA_LOCAL, MP_ID, cli_cedula, EP_ID) VALUES ('$TL_ID', '$TS_ID', '$PED_ROPA', '$PED_CANTIDAD', '$PED_OBSERVACIONES', '$PED_FECHA_ENTREGA_LOCAL', '$MP_ID', '$cli_cedula', 1)";
        $resultadoInsert = mysqli_query($conexion, $sqlInsertPedido);

        if ($resultadoInsert) {
            echo "¡Registro exitoso!";
        } else {
            echo "Error en el registro: " . mysqli_error($conexion);
        }
    mysqli_close($conexion);
    } else {
        echo "Ha ocurrido un error inoportuno";
    }
?>
<?php
    #CONSULTA DE LOS DATOS DE LA TABLA METODO_PAGO EN LA BASE DE DATOS Y ALMACENA LA INFORMACION EN LA VARIABLE $dataMetodoPagoSelect
    include ("C:/xampp/htdocs/ProyectoLavanderia/conexion/conexion.php");

    $sqlMetodoPago = ("SELECT * FROM metodo_pago;");
    $dataMetodoPagoSelect = mysqli_query($conexion, $sqlMetodoPago);

    $sqlTS = ("SELECT * FROM tipo_servicio;");
    $dataTSRadio = mysqli_query($conexion, $sqlTS);

    $sqlTL = ("SELECT * FROM tipo_lavado;");
    $dataTLRadio = mysqli_query($conexion, $sqlTL);
?>
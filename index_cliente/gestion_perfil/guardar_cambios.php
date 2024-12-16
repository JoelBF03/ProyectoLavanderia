<?php
session_start();
if (isset($_SESSION["cli_cedula"])) {
    $cli_cedula = $_SESSION["cli_cedula"];
    include("../../conexion/conexion.php");

    // Validar y escapar datos de entrada
    $cli_nombre = mysqli_real_escape_string($conexion, $_POST['input_nombre']);
    $cli_apellido = mysqli_real_escape_string($conexion, $_POST['input_apellido']);
    $cli_telefono = mysqli_real_escape_string($conexion, $_POST['input_telefono']);
    $cli_email = mysqli_real_escape_string($conexion, $_POST['input_email']);

    // Actualizar los datos del cliente en la base de datos
    $sqlGuardarCambios = "UPDATE cliente2 
                          SET cli_nombre = '$cli_nombre',
                              cli_apellido = '$cli_apellido',
                              cli_telefono = '$cli_telefono',
                              cli_email = '$cli_email'
                          WHERE cli_cedula = '$cli_cedula'";

    $resultadoGuardarCambios = mysqli_query($conexion, $sqlGuardarCambios);

    // Manejar el resultado de la actualización
    if ($resultadoGuardarCambios) {
        header("Location: ../../sesion/Sesion.php"); // Redirigir tras éxito
    } else {
        echo "Error al guardar los cambios: " . mysqli_error($conexion);
    }
}
?>

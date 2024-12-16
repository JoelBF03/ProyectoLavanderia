<?php
    include ("../conexion/conexion.php");

    $cli_cedula = mysqli_real_escape_string($conexion, $_POST['cedula']);
    $cli_nombre = mysqli_real_escape_string($conexion, $_POST['nombres']);
    $cli_apellido = mysqli_real_escape_string($conexion, $_POST['apellidos']);
    $cli_telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
    $cli_email = mysqli_real_escape_string($conexion, $_POST['email']);
    $cli_pwd = mysqli_real_escape_string($conexion, $_POST['password']);

    $cli_salt = bin2hex(random_bytes(16));

    $hashed_password = password_hash($cli_pwd . $cli_salt, PASSWORD_BCRYPT);

    $sqlInsertCliente = ("INSERT INTO cliente2 (cli_cedula, cli_nombre, cli_apellido, cli_telefono, cli_email, cli_pwd, cli_salt)
    VALUES ('$cli_cedula', '$cli_nombre', '$cli_apellido', '$cli_telefono', '$cli_email', '$hashed_password', '$cli_salt')");

    $resultadoInsertCliente = mysqli_query($conexion, $sqlInsertCliente);

    if ($resultadoInsertCliente) {
        echo "¡Registro exitoso!";
        header("Location: ../sesion/Sesion.php");
    } else {
        echo "Error en el registro: " . mysqli_error($conexion);
    }
    ?>
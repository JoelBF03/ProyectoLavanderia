<?php
    include ("conexion/conexion.php");

    $contraseña = 'pepe123';
    $cli_salt = bin2hex(random_bytes(16));
    $contraseña_hash = password_hash($contraseña . $cli_salt, PASSWORD_BCRYPT);
    
    $sqlInsertEmpleado = ("INSERT INTO cliente2 (cli_cedula, cli_nombre, cli_apellido, cli_telefono, cli_email, cli_pwd, cli_salt, cli_rol)
    VALUES ('0999999999', 'pepe', 'rodriguez', '0911111111', 'peper@gmail.com', '$contraseña_hash', '$cli_salt', 'Empleado')");

    $resultadoInsertEmpleado = mysqli_query($conexion, $sqlInsertEmpleado);

    if ($resultadoInsertEmpleado) {
        echo "¡Registro exitoso!";
    } else {
        echo "Error en el registro: " . mysqli_error($conexion);
    }
?>
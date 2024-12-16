<?php
    include("C:/xampp/htdocs/ProyectoLavanderia/conexion/conexion.php");

    $cli_cedula = mysqli_real_escape_string($conexion, $_POST["sesion_cedula"]);
    $cli_pwd = mysqli_real_escape_string($conexion, $_POST["sesion_password"]);

    $sqlUsuario = ("SELECT * FROM cliente2 WHERE cli_cedula = $cli_cedula");
    $resultadoSql = mysqli_query($conexion, $sqlUsuario);

    if ($resultadoSql && mysqli_num_rows($resultadoSql) > 0) {
        $row = mysqli_fetch_array($resultadoSql);
        $hashed_password = $row["cli_pwd"];

        if (password_verify($cli_pwd . $row["cli_salt"], $hashed_password)) {
            session_start();
            $_SESSION['cli_cedula'] = $cli_cedula;
            
            if ($row["cli_rol"] === 'cliente') {
                echo '<script> window.location.href="../index_cliente/menu.php";</script>';
            } else if ($row["cli_rol"] === 'Empleado') {
                echo '<script>window.location.href="../index_empleado/menu.php";</script>';
            } else {
                echo '<script>alert("Usuario no encontrado.");</script>';
            }
        } else {
            echo '<script>alert("Contraseña incorrecta.");</script>';
        }
    } else {
        echo '<script>alert("Usuario no encontrado.");</script>';
    }

    mysqli_close($conexion);
?>
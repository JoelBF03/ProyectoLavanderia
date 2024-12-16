<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <title> CONSULTAR CLIENTES </title>
    <link rel="stylesheet" href="../../recursos/encabezado.css" />
    <link rel="stylesheet" href="consulta.css" />
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

    <h1> CONSULTAR CLIENTES </h1>

    <form id="form_consulta" method="post" onsubmit="return Consultar()">
        <label for="consulta_cliente"> Filtrar cliente </label>
        <input type="text" id="consulta_cliente" name="consulta_cliente" placeholder="Cédula de cliente">
        <button id="consultar" name="consultar" type="submit"> Consultar </button>
    </form>

    <br><br>

    <table border="2px">
        <tr>
            <th> Nombre </th>
            <th> Apellido </th>
            <th> Cedula </th>
            <th> Telefono </th>
            <th> Correo Electrónico </th>
        </tr>
        
        <?php
        session_start();

        if (isset($_POST["consulta_cliente"])) {
            // Sanitización de la entrada
            $filtro_cliente = mysqli_real_escape_string($conexion, $_POST['consulta_cliente']);

            // Usamos consultas preparadas para evitar inyecciones SQL
            $sqlConsulta = "SELECT cli_cedula, cli_nombre, cli_apellido, cli_telefono, cli_email FROM cliente2 WHERE cli_cedula = ?";
            if ($stmt = mysqli_prepare($conexion, $sqlConsulta)) {
                mysqli_stmt_bind_param($stmt, "s", $filtro_cliente);
                mysqli_stmt_execute($stmt);
                $resultadoConsulta = mysqli_stmt_get_result($stmt);

                if ($resultadoConsulta) {
                    while ($row = mysqli_fetch_array($resultadoConsulta)) {
                        echo "<tr><td>{$row['cli_nombre']}</td>";
                        echo "<td>{$row['cli_apellido']}</td>";
                        echo "<td>{$row['cli_cedula']}</td>";
                        echo "<td>{$row['cli_telefono']}</td>";
                        echo "<td>{$row['cli_email']}</td></tr>";
                    }
                }
                mysqli_stmt_close($stmt);
            }
        } else {
            // Consulta para obtener todos los clientes si no se filtra por cédula
            $sqlConsulta = "SELECT cli_cedula, cli_nombre, cli_apellido, cli_telefono, cli_email FROM cliente2 WHERE cli_rol = 'cliente'";
            $resultadoConsulta = mysqli_query($conexion, $sqlConsulta);

            if ($resultadoConsulta) {
                while ($row = mysqli_fetch_array($resultadoConsulta)) {
                    echo "<tr><td>{$row['cli_nombre']}</td>";
                    echo "<td>{$row['cli_apellido']}</td>";
                    echo "<td>{$row['cli_cedula']}</td>";
                    echo "<td>{$row['cli_telefono']}</td>";
                    echo "<td>{$row['cli_email']}</td></tr>";
                }
            }
        }
        ?>
    </table>

    <script>
        function Consultar(){
            var consulta_cliente = document.getElementById('consulta_cliente').value.trim();
            if (consulta_cliente.length !== 10) {
                window.alert("El número de cédula debe contener 10 dígitos");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>

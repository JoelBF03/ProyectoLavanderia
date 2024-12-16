<?php
include("../sesion/verificarRol.php");

// Verificar si el usuario tiene el rol de empleado
verificarRol('Empleado');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title> Menu Empleado </title>
    <script src="rutas.js"> </script>
    <link rel="stylesheet" href="../recursos/encabezado.css" />
    <link rel="stylesheet" href="../recursos/empleado.css" />
</head>
<body>
    <header>
        <nav id="navbar">
            <img id="logo" src="../recursos/logo.png">
            <div id="navbar_buttons">
                <div id="navbar_link">
                    <a href="menu.php"> Menú </a>
                    <a href="../sesion/cerrarSesion.php"> Cerrar Sesión </a>
                </div>
            </div>
        </nav>
    </header>

    <!-- PAGINA PRINCIPAL DE EMPLEADO -->
    <h1> Bienvenido
        <label id="nombre_menu"> 
            <?php
            if(isset($_SESSION["cli_cedula"])){
                $cli_cedula = $_SESSION["cli_cedula"];

                include("../conexion/conexion.php");

                $sqlConsulta = "SELECT cli_nombre FROM cliente2 where cli_cedula = '$cli_cedula'";
                $resultadoConsulta = mysqli_query($conexion, $sqlConsulta);
                if($resultadoConsulta) {
                    if ($row = mysqli_fetch_array($resultadoConsulta)) {
                        echo $row["cli_nombre"];
                    }
                }
            }
            ?>
        </label> 
    </h1>
    
    <div id="functions">
        <div class="row">
            <button type="button" id="consulta_clientes"> Consultar Clientes </button>
            <button type="button" id="perfil_empleado"> Mi perfil </button>
            <button type="button" id="seguimiento_empleado"> Seguimientos de Pedidos </button>
        </div>
        
        <div class="row">
            <button type="button" id="historial_empleado"> Historial De Pedidos De Clientes </button>
            <button type="button" id="backup"> Generar Respaldos </button>
        </div>
    </div>
</body>
</html>

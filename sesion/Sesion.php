<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title> Iniciar Sesión </title>
    <script src="../sesion/validacion_sesion.js"></script>
    <link rel="stylesheet" href="sesion.css" />
</head>

<body>
    <header>
        <nav id="navbar">
            <img id="logo" src="..\recursos\logo.png">
            <div id="navbar_buttons">
                <div id="navbar_link">
                    <a href="../registro/registro.php"> Registrate </a>
                </div>
            </div>
        </nav>
    </header>

    <!-- FORMULARIO PARA INICIO DE SESION DE USUARIO-->
    <div id="form_registro">
        <h1> INICIAR SESION </h1>
        <form id="sesion" method="post" action="procesarSesion.php" onsubmit="return validarSesion()">
            <input type="number" name="sesion_cedula" id="sesion_cedula" placeholder="Cédula">
            <br><br>
            <input type="password" name="sesion_password" id="sesion_password" placeholder="Contraseña">
            <br><br>
            <button type="submit"> Acceder </button>
        </form>
    </div>
</body>

</html>
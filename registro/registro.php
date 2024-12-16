<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title> Registrarse </title>
    <script src="validacion_registro.js"></script>
    <link rel="stylesheet" href="registro.css" />
</head>

<body>
    <header>
        <nav id="navbar">
            <img id="logo" src="..\recursos\logo.png">
            <div id="navbar_buttons">
                <div id="navbar_link">
                    <a href="../sesion/sesion.php"> Iniciar Sesión </a>
                </div>
            </div>
        </nav>
    </header>

    <!-- FORMULARIO PARA REGISTRO DE USUARIO-->
    <div id="form_registro">
        <h1> REGISTRATE! </h1>
        <form id="registro" method="post" action="procesarRegistro.php" onsubmit="return validarFormulario()">
            <input type="text" name="nombres" id="nombres" placeholder="Ingresa tus nombres">
            <br><br>
            <input type="text" name="apellidos" id="apellidos" placeholder="Ingresa tus apellidos">
            <br><br>
            <input type="text" name="cedula" id="cedula" placeholder="Ingresa tu numero de cedula">
            <br><br>
            <input type="text" name="telefono" id="telefono" placeholder="Ingresa tu numero de telefono">
            <br><br>
            <input type="email" name="email" id="email" placeholder="Ingresa tu correo electronico">
            <br><br>
            <input type="password" name="password" id="password" placeholder="Ingrese una contraseña">
            <br><br>
            <input type="password" name="v_password" id="v_password" placeholder="Vuelva a ingresar la contraseña">
            <br><br>
            <button type="submit"> Registrarse </button>
        </form>
    </div>
</body>

</html>
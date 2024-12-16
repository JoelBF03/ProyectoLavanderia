<?php
    #CONEXION A LA BASE DE DATOS
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "practicas";
    $conexion = mysqli_connect($servername, $username, $password) or die("No se ha podido conectar al servidor");
    $db = mysqli_select_db($conexion, $dbname) or die("Error en conectar a la base de datos");
?>
<?php
    session_start();
    session_destroy();
    header("Location: Sesion.php");
    exit();
?>
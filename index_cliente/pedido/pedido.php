<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title> PEDIDO </title>
    <?php include("C:/xampp/htdocs/ProyectoLavanderia/bdd/BaseDeDatos.php") ?>
    <link rel="stylesheet" href="pedido.css" />
</head>

<body>
    <header>
        <nav id="navbar">
            <img id="logo" src="../../recursos/logo.png">
            <div id="navbar_buttons">
                <a href="../menu.php" class="navbar_link">Menú</a>
                <a href="../../sesion/cerrarSesion.php" class="navbar_link">Cerrar Sesión</a>
            </div>
        </nav>
    </header>

    <div class="container">
        <h1 class="main-title"> NUEVO PEDIDO </h1>

        <form id="pedido" method="post" action="procesarPedido.php">
            <div class="form-section">
                <label for="TipoServicio" class="form-label"><strong> TIPO SERVICIO </strong> </label>
                <div class="radio-group">
                    <?php
                    while ($TSRadio = mysqli_fetch_array($dataTSRadio)) { ?>
                        <div class="radio-item">
                            <input name="TipoServicio" type="radio" id="<?php echo ($TSRadio["TS_ID"]); ?>" value="<?php echo ($TSRadio["TS_ID"]); ?>">
                            <label for="TipoServicio"><?php echo utf8_encode($TSRadio["TS_DESCRIPCION"]); ?></label>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="form-section">
                <label for="TipoLavado" class="form-label"><strong> TIPO LAVADO </strong> </label>
                <div class="radio-group">
                    <?php
                    while ($TLRadio = mysqli_fetch_array($dataTLRadio)) { ?>
                        <div class="radio-item">
                            <input name="TipoLavado" type="radio" id="<?php echo ($TLRadio["TL_ID"]); ?>" value="<?php echo ($TLRadio["TL_ID"]); ?>">
                            <label for="TipoLavado"><?php echo utf8_encode($TLRadio["TL_DESCRIPCION"]); ?></label>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="form-section">
                <label for="TiposRopa" class="form-label"><strong> TIPOS DE ROPA </strong> </label>
                <div class="checkbox-group">
                    <input type="checkbox" id="Camisas" name="TiposRopa[]" value="Camisas" />
                    <label for="Camisas">Camisas</label>

                    <input type="checkbox" id="Pantalon" name="TiposRopa[]" value="Pantalon" />
                    <label for="Pantalon">Pantalón</label>

                    <input type="checkbox" id="Sudaderas" name="TiposRopa[]" value="Sudaderas" />
                    <label for="Sudaderas">Sudaderas</label>

                    <input type="checkbox" id="Vestidos" name="TiposRopa[]" value="Vestidos" />
                    <label for="Vestidos">Vestidos</label>

                    <input type="checkbox" id="Toallas" name="TiposRopa[]" value="Toallas" />
                    <label for="Toallas">Toallas</label>

                    <input type="checkbox" id="Sabanas" name="TiposRopa[]" value="Sabanas" />
                    <label for="Sabanas">Sábanas</label>

                    <input type="checkbox" id="RopaInterior" name="TiposRopa[]" value="RopaInterior" />
                    <label for="RopaInterior">Ropa Interior</label>

                    <input type="checkbox" id="Otros" name="TiposRopa[]" value="Otros" />
                    <label for="Otros">Otros</label>
                </div>
            </div>

            <div class="form-section">
                <label for="Cantidad" class="form-label">Cantidad:</label>
                <input type="number" id="Cantidad" name="Cantidad" required class="input-field" />
            </div>

            <div class="form-section">
                <label for="Observaciones" class="form-label">Observaciones:</label>
                <input type="text" id="Observaciones" name="Observaciones" class="input-field" />
            </div>

            <div class="form-section">
                <label for="FechaEntregaLocal" class="form-label">Fecha de entrega al local</label>
                <input type="date" id="FechaEntregaLocal" name="FechaEntregaLocal" required class="input-field" />
            </div>

            <div class="form-section">
                <label for="MetodoPago" class="form-label">Método de Pago: </label>
                <select name="metodo_pago" class="input-field">
                    <option value=""> Seleccione el método de pago </option>
                    <?php
                    while ($MPSelect = mysqli_fetch_array($dataMetodoPagoSelect)) { ?>
                        <option value="<?php echo ($MPSelect["mp_id"]); ?>"><?php echo ($MPSelect["descripcion"]); ?></option>
                    <?php } ?>
                </select>
            </div>

            <button type="submit" class="submit-button">Guardar Datos</button>
        </form>
    </div>

    <footer>
        <?php
        // Obtener la última fecha de respaldo
        $sqlBackup = "SELECT fecha_generacion FROM backups ORDER BY fecha_generacion DESC LIMIT 1";
        $resultadoBackup = mysqli_query($conexion, $sqlBackup);
        if ($resultadoBackup) {
            if ($row = mysqli_fetch_array($resultadoBackup)) {
                // Formatear la fecha
                $fecha_generacion = new DateTime($row['fecha_generacion']);
                echo "Último respaldo: " . $fecha_generacion->format('d-m-Y_H-i-s');
            } else {
                echo "No se ha realizado un respaldo aún.";
            }
        }
        ?>
    </footer>

</body>

</html>

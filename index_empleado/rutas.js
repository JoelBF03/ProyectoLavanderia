document.addEventListener("DOMContentLoaded", function () {
    console.log("DOM cargado correctamente.");
    const consulta_clientes = document.getElementById("consulta_clientes");
    const perfil_empleado = document.getElementById("perfil_empleado");
    const seguimiento_empleado = document.getElementById("seguimiento_empleado");
    const historial_empleado = document.getElementById("historial_empleado");
    const backup = document.getElementById("backup");


    consulta_clientes.addEventListener("click", function () {
        window.location.href = "../index_empleado/consulta_cliente/consultarClientes.php";
    });

    perfil_empleado.addEventListener("click", function () {
        window.location.href = "../index_empleado/perfil_empleado/perfil_empleado.php";
    });

    seguimiento_empleado.addEventListener("click", function () {
        window.location.href = "../index_empleado/SeguimientoPedidos/seguimientoPedidos.php";
    });

    historial_empleado.addEventListener("click", function () {
        window.location.href = "../index_empleado/Historial_Pedidos/EmpedidosClientes.php";
    });

    backup.addEventListener("click", function(){
        window.location.href = "../index_empleado/backups/backup.php";
    });
});
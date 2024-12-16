document.addEventListener("DOMContentLoaded", function () {
    const pedido_cliente = document.getElementById("pedido_cliente");
    const perfil_cliente = document.getElementById("perfil_cliente");
    const seguimiento_cliente = document.getElementById("seguimiento_cliente");
    const historial_cliente = document.getElementById("historial_cliente");

    pedido_cliente.addEventListener("click", function () {
        window.location.href = "../index_cliente/pedido/pedido.php";
    });

    perfil_cliente.addEventListener("click", function(){
        window.location.href ="../index_cliente/gestion_perfil/perfil.php";
    });

    seguimiento_cliente.addEventListener("click", function () {
        window.location.href = "../index_cliente/seguimiento/seguimiento.php";
    });

    historial_cliente.addEventListener("click", function(){
        window.location.href ="../index_cliente/historial/historial.php";
    });
});
function editar_estado(inputId){
    var inputEstado = document.getElementById(inputId);
    inputEstado.removeAttribute("readonly");
    inputEstado.focus();

    document.getElementById("actualizar_estado").removeAttribute("hidden");
    document.getElementById("boton_editar").disabled = true;
}
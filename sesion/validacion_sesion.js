function validarSesion(){
    var cedula = document.getElementById("sesion_cedula").value.trim();
    var password = document.getElementById("sesion_password").value.trim();

    if (cedula === "" || password === ""){
        window.alert("LLENE TODOS LOS CAMPOS POR FAVOR");
        return false;
    }
}
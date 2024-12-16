function validarFormulario(){
    var nombres = document.getElementById("nombres").value.trim();
    var apellidos = document.getElementById("apellidos").value.trim();
    var cedula = document.getElementById("cedula").value.trim();
    var telefono = document.getElementById("telefono").value.trim();
    var email = document.getElementById("email").value.trim();
    var password = document.getElementById("password").value.trim();
    var v_password = document.getElementById("v_password").value.trim();

    if (nombres === "" || apellidos === "" || cedula === "" || telefono === "" || email === "" || password === "" || v_password === ""){
        window.alert("LLENE TODOS LOS CAMPOS POR FAVOR");
        return false;
    }

    if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(nombres)){
        window.alert("El campo de nombres no debe contener numeros ni caracteres especiales")
        return false;
    }

    if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(apellidos)){
        window.alert("El campo de apellidos no debe contener numeros ni caracteres especiales")
        return false;
    }

    if (cedula.length !== 10){
        window.alert("La cédula debe tener 10 digitos")
        return false;
    }
    
    if (telefono.length !== 10){
        window.alert("El telefono debe tener 10 digitos")
        return false;
    }

    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)){
        window.alert("Ingrese un correo con un formato válido")
        return false;
    }

    if(!/^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])(.{8,})$/.test(password)){
        window.alert("La contraseña debe contener al menos 8 digitos, 1 mayuscula, 1 caracter especial y 1 numero")
        return false;
    }
    
    if(password !== v_password){
        window.alert("Las contraseñas no coinciden")
        return false;
    }
    return true;
}
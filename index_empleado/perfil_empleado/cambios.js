function habilitar_edicion_empleado() {
    // Habilitar campos de entrada
    const inputs = document.querySelectorAll('#form_perfil input[type="text"]');
    inputs.forEach(input => {
        input.removeAttribute('readonly');
        input.style.borderColor = '#4CAF50'; // Estilo para destacar los campos editables
    });

    // Mostrar el botón de guardar cambios
    const guardarBtn = document.getElementById('guardar_cambios');
    guardarBtn.style.display = 'block';

    // Deshabilitar el botón de editar
    const editarBtn = document.getElementById('habilitar_edicion');
    editarBtn.disabled = true;
    editarBtn.style.opacity = '0.6'; // Mostrar visualmente que está deshabilitado
}

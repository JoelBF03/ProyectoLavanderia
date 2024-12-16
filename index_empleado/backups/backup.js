document.addEventListener("DOMContentLoaded", function () {
    const crearRespaldo = document.getElementById("crear_respaldo");
    const eliminarRespaldo = document.getElementById("eliminar_respaldo");
    const listaRespaldo = document.getElementById("lista_respaldo");

    // Crear respaldo
    crearRespaldo.addEventListener('click', function () {
        if (confirm("¿Está seguro de generar un respaldo?")) {
            fetch('generar_respaldo.php', { method: 'POST' })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Respaldo generado correctamente.");
                        cargarRespaldos();  // Recargar la lista de respaldos
                    } else {
                        alert("Error al generar el respaldo: " + data.message);
                    }
                })
                .catch(err => {
                    alert("Ocurrió un error inesperado.");
                    console.error(err);
                });
        }
    });

    // Eliminar respaldo
    eliminarRespaldo.addEventListener('click', function () {
        const respaldo = prompt("Ingrese el nombre del respaldo a eliminar (ejemplo: respaldo_2024-12-06.sql):");
        if (respaldo) {
            fetch('eliminar_respaldo.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ respaldo: respaldo })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Respaldo eliminado correctamente.");
                    cargarRespaldos();  // Recargar la lista de respaldos
                } else {
                    alert("Error al eliminar el respaldo: " + data.message);
                }
            })
            .catch(err => {
                alert("Ocurrió un error inesperado.");
                console.error(err);
            });
        }
    });

    // Cargar los respaldos existentes
    function cargarRespaldos() {
        fetch('listar_respaldo.php')
            .then(response => response.json())
            .then(data => {
                listaRespaldo.innerHTML = '';  // Limpiar la lista
                if (data.success && data.respaldos.length > 0) {
                    data.respaldos.forEach(respaldo => {
                        const li = document.createElement("li");
                        li.textContent = respaldo;
                        listaRespaldo.appendChild(li);
                    });
                } else {
                    listaRespaldo.innerHTML = '<li>No hay respaldos disponibles.</li>';
                }
            })
            .catch(err => {
                alert("Error al cargar los respaldos.");
                console.error(err);
            });
    }

    // Cargar los respaldos al iniciar la página
    cargarRespaldos();
});

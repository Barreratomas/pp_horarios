

document.addEventListener('DOMContentLoaded', function () {
    var miBoton = document.getElementById('toggleButton');

    // Variable para verificar si el botón se puede activar nuevamente
    var botonHabilitado = true;

    miBoton.addEventListener('click', function () {
        // Verificar si el botón se puede activar
        if (!botonHabilitado) {
            return; // Salir de la función si el botón no se puede activar
        }

        // Deshabilitar el botón
        miBoton.disabled = true;

        // Cambiar la clase del botón
        miBoton.classList.toggle('float-right');

        if (miBoton.classList.contains('float-right')) {
            setTimeout(() => {
                miBoton.style.marginLeft = '210px';
                miBoton.style.transition = '0.3s';
                // Habilitar el botón después de 10 milisegundos
                setTimeout(() => {
                    miBoton.disabled = false;
                    botonHabilitado = true;
                }, 10);
            }, 300);
        } else {
            miBoton.style.marginLeft = '0';
            miBoton.style.transition = '0.3s';
            // Habilitar el botón después de 10 milisegundos
            setTimeout(() => {
                miBoton.disabled = false;
                botonHabilitado = true;
            }, 10);
        }

        // Cambiar el estado de la variable para indicar que el botón no se puede activar nuevamente hasta después de 1 segundo
        botonHabilitado = false;
    });
});

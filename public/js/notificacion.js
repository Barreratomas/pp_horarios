

document.addEventListener("DOMContentLoaded", function() {
    // Eliminar mensajes después de un segundo
    setTimeout(function() {
        var errorMessages = document.querySelectorAll('.alert-danger');
        errorMessages.forEach(function(message) {
            message.parentElement.classList.add('hide-messages');
            setTimeout(function() {
                message.remove();
            }, 500); // Tiempo de espera antes de eliminar el mensaje (debe coincidir con el tiempo de transición en CSS)
        });

        var successMessages = document.querySelectorAll('.alert-success');
        successMessages.forEach(function(message) {
            message.parentElement.classList.add('hide-messages');
            setTimeout(function() {
                message.remove();
            }, 500); // Tiempo de espera antes de eliminar el mensaje (debe coincidir con el tiempo de transición en CSS)
        });
    }, 1000);
});

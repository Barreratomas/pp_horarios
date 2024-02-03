document.addEventListener('DOMContentLoaded', function () {
    var miBoton = document.getElementById('toggleButton');

    miBoton.addEventListener('click', function () {
        miBoton.classList.toggle('float-right');
        if (miBoton.classList.contains('float-right')) {
            setTimeout(() => {
            miBoton.style.marginLeft = '205px';
            miBoton.style.transition = '0.3s';
                
            },300);
        } else {
            miBoton.style.marginLeft = '0';
            miBoton.style.transition = '0.3s';
        }
        
        

       
    });
});
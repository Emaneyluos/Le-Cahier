document.addEventListener('DOMContentLoaded', function () {
    // Cibler tous les messages flash
    var flashMessages = document.querySelectorAll('.alert');

    flashMessages.forEach(function (message) {
        // Masquer le message après 10 secondes
        setTimeout(function () {
            closeAlert(message);
        }, 10000);     
    });
});

function closeAlert(element) {
    
    element.style.display = 'none';
}
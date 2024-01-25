document.addEventListener('DOMContentLoaded', function() {

    document.getElementById("header_add-question").addEventListener('click', function() {
        window.location = "/question/new";        
    });

    document.getElementById("header_logo").addEventListener('click', function() {
        window.location = "/";        
    });
});
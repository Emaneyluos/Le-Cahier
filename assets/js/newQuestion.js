document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.question-hidden').forEach(function(el) {
        el.parentElement.classList.add('parent-question-hidden');
    });

    document.getElementById("question_codeProfesseur").addEventListener("keypress", (evt) => {      
        console.log(evt.keyCode);  
       
        if (evt.key > 48 || evt.key < 57) {
            console.log("lettre interdite");
            evt.preventDefault();
        }
    });
    
});

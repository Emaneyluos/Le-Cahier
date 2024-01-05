document.addEventListener('DOMContentLoaded', function () {


    document.querySelectorAll('.question-hidden').forEach(function(el) {
        el.parentElement.classList.add('parent-question-hidden');
    });

    let codeProfesseur = document.getElementById("question_codeProfesseur");

    codeProfesseur.addEventListener("keydown", (event) => {
        var ctrlKey = false;
        if (event.ctrlKey || event.shiftKey || event.altKey || event.metaKey) {
            console.log("ctrlKey");
            ctrlKey = true;
        }

        if (event.key === "Enter" || event.key === "Backspace") {
            ctrlKey = true;
        }

        if (!event.key.match(/[0-9]/) && !ctrlKey) {
            event.preventDefault();
        } 
    });

    codeProfesseur.addEventListener("keyup", (event) => {
        
            if (codeProfesseur.value.length === 6)  {
                let classes = document.getElementById("question_classe");

                while (classes.firstChild) {
                    classes.removeChild(classes.firstChild);
                }

                let codeProfesseur = document.getElementById("question_codeProfesseur").value;
                fetch('/api/professeur/classes/' + codeProfesseur)
                .then(response => response.json())
                .then(data => {
                    let optionArray = [];
                    if (data.length > 0) {
                        data.forEach(classe => {
                            var option = document.createElement('option');
                            option.value = classe.id;
                            option.text = classe.nom;
                            classes.appendChild(option);
                        });

                        document.querySelectorAll('.question-hidden').forEach(function(element) {
                            element.parentElement.classList.remove('parent-question-hidden');
                        });

                    } else {
                        console.log("Aucune classe trouvée.");
                    }
                })
                .catch(error => {
                    console.error('Erreur lors du chargement des questions:', error);
                });

                // // Créer un nouvel élément option
                // var option = document.createElement('option');
                // option.value = '465';
                // option.text = '6ème A';

                // // Ajouter l'option au select
                // select.appendChild(option);

            } else {
                document.querySelectorAll('.question-hidden').forEach(function(element) {
                    element.parentElement.classList.add('parent-question-hidden');
                });
            }
            
        });
    
});

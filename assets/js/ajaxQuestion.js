

document.addEventListener('DOMContentLoaded', function() {
    chargementQuestions(classeId);

    var allButtons = document.getElementsByClassName('load-questions')

    for (var i = 0; i < allButtons.length; i++) {
        allButtons[i].addEventListener('click', function() {
            var dataClasseId = this.getAttribute('data-classe-id');
            console.log("click : " + dataClasseId);
            chargementQuestions(dataClasseId);
        });
    }
        
});

function chargementQuestions(dataClasseId) {
    fetch('/api/question/' + dataClasseId)
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('questions-container');
            container.innerHTML = '';
            if (data.length > 0) {
                data.forEach(question => {
                    container.innerHTML += `
                        <div class="card">
                            <div class="card-header">
                                Question : ${question.question}
                            </div>
                            <div class="card-body">
                                <p>Réponse : ${question.reponse}</p>
                                <div class="groupe">
                                    <div class="groupe_date">
                                        <p class="text-muted">Créée le : ${formatDate(question.creeeLe)}</p>
                                        <p class="text-muted">Modifiée le : ${formatDate(question.modifieLe)}</p>
                                        <p class="text-muted">Répondu le : ${formatDate(question.lastDateReponse)}</p>
                                    </div>
                                    <div class="groupe_cours">
                                        <p class="text-muted">Par : ${question.professeur.nom}</p>
                                        <p class="text-muted">Matière : ${question.matiere.nom}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                });
            } else {
                container.innerHTML = '<p>Aucune question trouvée.</p>';
            }
        })
        .catch(error => {
            console.error('Erreur lors du chargement des questions:', error);
            document.getElementById('questions-container').innerHTML = '<p>Erreur de chargement.</p>';
        });

        console.log('/api/question/' + dataClasseId);
}

function formatDate(dateString) {
    if (!dateString) {
        return '';
    }
    const options = { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit' };
    return new Date(dateString).toLocaleDateString('fr-FR', options);
}
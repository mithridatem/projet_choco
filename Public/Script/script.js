//Récupération du modal
let modal = document.querySelector('#myModal');

//Récupération du span pour fermer le modal
let span = document.getElementsByClassName("close")[0];

//Fonction pour fermer le modal
function closeModal() {
    modal.style.display = "none";
}
// Fonction pour fermer le modal quand on clique à l'extérieur
window.onclick = function(event) {
    if(event.target == modal){
        modal.style.display = "none";
    }
}
let messageAjout = document.querySelector('.messageAjout'); // On a la boîte du message

window.addEventListener("load", function(){ // Lorsque la page va se charger
    if(messageAjout.innerHTML){
        messageAjout.classList.add("afficher"); // On ajoute la classe afficher pour rendre la boîte visible
        setTimeout(function(){
            messageAjout.classList.remove("afficher"); // 1 seconde plus tard, on l'enlève pour la faire disparaître
        }, 1000);
    }
})

let boutonDetails = document.querySelector('.afficherDetails')
let modal = document.querySelector('.modal');
let fermer = document.querySelector('.fermer');

boutonDetails.onclick = function(){
    modal.style.display = "block";
}

fermer.onclick = function(){
    modal.style.display = "none";
}

window.onclick = function(event){
    if(event.target == modal){
        modal.style.display = "none";
    }
}
let messageAjout = document.querySelector('.messageAjout'); // On a la boîte du message

window.addEventListener("load", function(){ // Lorsque la page va se charger
    if(messageAjout.innerHTML){
        messageAjout.classList.add("afficher"); // On ajoute la classe afficher pour rendre la boîte visible
        setTimeout(function(){
            messageAjout.classList.remove("afficher"); // 1 seconde plus tard, on l'enlève pour la faire disparaître
        }, 1000);
    }
})

let boutonDetails = document.querySelector('.afficherDetails'); // On récupère le lien pour afficher l'image
let modal = document.querySelector('.modal'); // On récupère la partie modal
let fermer = document.querySelector('.fermer'); // On récupère ce qui permet de fermer la partie modal

/* Quand on clique sur le produit, on affiche les détails avec la partie modale */
boutonDetails.onclick = function(){
    modal.style.display = "block";
}

/* Quand on clique sur la croix, on supprime/n'affiche plus la partie modale */
fermer.onclick = function(){
    modal.style.display = "none";
}

/* Quand on clique en dehors de la partie modale, on ne l'affiche plus */
window.onclick = function(event){
    if(event.target == modal){
        modal.style.display = "none";
    }
}
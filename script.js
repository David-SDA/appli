let messageAjout = document.querySelector('.messageAjout'); // On a la boîte du message
let boutonAjoutProduit = document.querySelector('.boutonAjoutProduit'); // On a le bouton d'ajout de produit

window.addEventListener("load", function(){ // Lorsque la page va se charger
    if(messageAjout.innerHTML){
        messageAjout.classList.add("afficher"); // On ajoute la classe afficher pour rendre la boîte visible
        setTimeout(function(){
            messageAjout.classList.remove("afficher"); // 1 seconde plus tard, on l'enlève pour la faire disparaître
        }, 1000);
    }
})
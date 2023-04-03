let messageAjout = document.querySelector('.messageAjout'); // On a la boîte du message
let boutonAjoutProduit = document.querySelector('.boutonAjoutProduit'); // On a le bouton d'ajout de produit

boutonAjoutProduit.addEventListener("click", function(){ // Lorsqu'on va cliquer sur l'ajout
    messageAjout.classList.add("afficher"); // On ajoute la classe afficher pour rendre la boîte visible
    setTimeout(function(){
        messageAjout.classList.remove("afficher"); // 5 secondes plus tard, on l'enlève pour la faire disparaître
    }, 5000);
})
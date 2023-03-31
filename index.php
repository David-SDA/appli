<?php
    session_start();
    ob_start();
    // require "functions.php"
    
    echo "<h1>Ajouter un produit</h1>
            <form enctype=\"multipart/form-data\" action=\"traitement.php?action=add\" method=\"post\">
                <p>
                    <label>
                        Nom du produit : 
                        <input type=\"text\" name=\"name\">
                    </label>
                </p>
                <p>
                    <label>
                        Prix du produit : 
                        <input type=\"number\" step=\"any\" name=\"price\">
                    </label>
                </p>
                <p>
                    <label>
                        Quantité désirée : 
                        <input type=\"number\" name=\"qtt\" value=\"1\">
                    </label>
                </p>
                <p>
                    <label>
                        Description : 
                        <textarea name=\"description\" cols=\"60\" rows=\"10\"></textarea>
                    </label>
                </p>
                <p>
                    <label>
                        Image :
                        <input type=\"file\" name=\"file\" required>
                    </label>
                </p>
                <p>
                    <input type=\"submit\" name=\"submit\" value=\"Ajouter le produit\">
                </p>
                
            </form>
            <p>État du dernier ajout : ";
    /* Si on n'a pas de variable de session rassemblant les produits, ou bien si il est vide */
    if((!isset($_SESSION['message']) || empty($_SESSION['message']))){
        echo ""; // Pas d'état à afficher
    }
    else{ // Sinon
        echo $_SESSION['message']; // On affiche le message d'état de l'action du formulaire
    }
    echo "</p>";
    
    $contenu = ob_get_clean();
    $title = "Panier";
    require "template.php";
?>
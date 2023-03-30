<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Ajout produit</title>
    </head>
    <body>
        <header>
            <a href="index.php">Accueil</a>
            <a href="recap.php">Récapitulatif</a>
            <p class="nbProduit"><i>Nombre de produits : 
                <span>
                <?php
                    $nombreProduits = 0;
                    /* Si on n'a pas de variable de session rassemblant les produits, ou bien si il est vide */
                    if((!isset($_SESSION['products']) || empty($_SESSION['products']))){
                        echo $nombreProduits; // On affiche qu'on a bien aucun produits
                    }
                    else{ // Sinon
                        foreach($_SESSION['products'] as $index => $produit){ // Pour chaque produit
                            $nombreProduits += $produit['qtt']; // On ajoute sa quantité au nombre de produits
                        } 
                        echo $nombreProduits; // On affiche le nombre de produits
                    }
                ?>
                </span></i></p>
        </header>
        <div class="contenu">   
            <h1>Ajouter un produit</h1>
            <form enctype="multipart/form-data" action="traitement.php?action=add" method="post">
                <p>
                    <label>
                        Nom du produit : 
                        <input type="text" name="name">
                    </label>
                </p>
                <p>
                    <label>
                        Prix du produit : 
                        <input type="number" step="any" name="price">
                    </label>
                </p>
                <p>
                    <label>
                        Quantité désirée : 
                        <input type="number" name="qtt" value="1">
                    </label>
                </p>
                <p>
                    <label>
                        Description : 
                        <textarea name="description" cols="60" rows="10"></textarea>
                    </label>
                </p>
                <p>
                    <label>
                        Image :
                        <input type="file" name="file" required>
                    </label>
                </p>
                <p>
                    <input type="submit" name="submit" value="Ajouter le produit">
                </p>
                
            </form>
            <p>État du dernier ajout : 
                <?php
                    /* Si on n'a pas de variable de session rassemblant les produits, ou bien si il est vide */
                    if((!isset($_SESSION['message']) || empty($_SESSION['message']))){
                        echo ""; // Pas d'état à afficher
                    }
                    else{ // Sinon
                        echo $_SESSION['message']; // On affiche le message d'état de l'action du formulaire
                    }
                ?>
            </p>
        </div>
    </body>
</html>
<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="style.css">
        <title>Détail de produit</title>
    </head>
    <body>
        <header>
            <a href="index.php">
                <h3>ACCUEIL</h3>
            </a>
            <a href="recap.php">
                <h3>RÉCAPITULATIF</h3>
            </a>
            <p class="nbProduit"><i class="fa fa-shopping-cart"></i>
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
                </span>
            </p>
        </header>
        <div class="contenu">
            <?php
                /* Si on n'a pas de variable de session de la descritption de produit, ou bien si il est vide */
                if((!isset($_SESSION['descriptionProduit']) || empty($_SESSION['descriptionProduit'])))
                {
                    echo ""; // On affiche rien
                }
                else{ // Sinon
                    echo $_SESSION['descriptionProduit']; // On affiche la description du produit
                }
            ?>
        </div>
    </body>
</html>
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
                    if((!isset($_SESSION['products']) || empty($_SESSION['products']))){
                        echo "0";
                    }
                    else{
                        echo count($_SESSION['products']);
                    }
                ?>
                </span></i></p>
        </header>
        <div class="contenu">   
            <h1>Ajouter un produit</h1>
            <form action="traitement.php" method="post">
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
                    <input type="submit" name="submit" value="Ajouter le produit">
                </p>
            </form>
            <p>État du dernier ajout : 
                <?php
                    if((!isset($_SESSION['message']) || empty($_SESSION['message']))){
                        echo "";
                    }
                    else{
                        echo $_SESSION['message'];
                    }
                ?>
            </p>
        </div>
    </body>
</html>
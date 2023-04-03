<?php
    require_once "functions.php"
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="style.css">
        <title>Magasin - Produit | <?= $title ?></title>
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
                    echo getNombreProduit(); // On affiche le nombre de produits dans le panier
                ?>
                </span>
            </p>
        </header>
        <div id="emballage">
            <main class ="contenu">
                <!-- Injection du contenu -->
                <?= $contenu ?>
            </main>
        </div>
        <script src="script.js"></script>
    </body>
</html>
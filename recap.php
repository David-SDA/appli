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
        <title>Récapitulatif des produits</title>
    </head>
    <body>
        <header>
            <a href="traitement.php?action=detail&button=accueil"><!-- On va faire le traitement pour enlever le texte lorsqu'on retourne à l'accueil -->
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
                        echo " " . $nombreProduits; // On affiche qu'on a bien aucun produits
                    }
                    else{ // Sinon
                        foreach($_SESSION['products'] as $index => $produit){ // Pour chaque produit
                            $nombreProduits += $produit['qtt']; // On ajoute sa quantité au nombre de produits
                        } 
                        echo " " . $nombreProduits; // On affiche le nombre de produits
                    }
                ?>
                </span>
            </p>
        </header>
        <?php
            /* Si on n'a pas de variable de session rassemblant les produits, ou bien si il est vide */
            if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
                echo "<p>Aucun produit en session...</p>"; // On affiche qu'on a bien aucun produit en session
            }
            else{ // Sinon, on crée un tableau pour le panier
                echo "<table class=\"contenu\">",
                        "<thead>",
                            "<tr>",
                                "<th>#</th>",
                                "<th>Nom</th>",
                                "<th>Prix</th>",
                                "<th>Quantité</th>",
                                "<th>Total</th>",
                            "</tr>",
                        "</thead>",
                        "<tbody>";
                $totalGeneral = 0; // Création d'une variable pour avoir le total du panier
                foreach($_SESSION['products'] as $index => $product){ // Pour chaque produit, on les insère a la suite du tableau
                    echo "<tr>",    // Ci-dessous, le lien pour supprimer le produit
                            "<td><a href=\"traitement.php?action=delete&index=$index\">❌</a>".$index."</td>",
                                    // Ci-dessous, le lien pour afficher les détails du produit
                            "<td><a href=\"traitement.php?action=detail&index=$index&button=produit\">".$product['name']."</a></td>",
                            "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€"."</td>",
                                // Ci-dessous, le lien pour enlever de la quantité au produit                       Ainsi que pour en ajouter
                            "<td><a href=\"traitement.php?action=down-qtt&index=$index\">- </a>".$product['qtt']."<a href=\"traitement.php?action=up-qtt&index=$index\"> +</a></td>",
                            "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€"."</td>",
                        "</tr>";
                    $totalGeneral+= $product['total']; // Le total de chaque produit est ajouté au total final
                }
                echo "<tr>",
                        "<td colspan=4>Total général : </td>",
                        "<td><strong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",
                     "</tr>",
                    "</tbody>",
                "</table>";
                echo "<a href=\"traitement.php?action=clear\"><button>Vider le panier</button></a>"; // Lien qui effectue l'action de vider le panier
            }
        ?>
    </body>
</html>
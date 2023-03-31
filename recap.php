<?php
    session_start();
    ob_start();

    /* Si on n'a pas de variable de session rassemblant les produits, ou bien si il est vide */
    if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
        echo "<p>Aucun produit en session...</p>"; // On affiche qu'on a bien aucun produit en session
    }
    else{ // Sinon, on crée un tableau pour le panier
        echo "<table>", // RAJOUTER UNE CLASSE POUR TRAVAILLER SUR LE STYLE DE LA TABLE
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
    
    $contenu = ob_get_clean();
    $title = "Panier";
    require "template.php";
?>
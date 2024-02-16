<?php
    session_start();
    ob_start();
    require_once("functions.php");

    /* Si on n'a pas de variable de session rassemblant les produits, ou bien si il est vide */
    if ( !isset($_SESSION['products']) || empty($_SESSION['products']) ) {
        echo "<p>Aucun produit en session...</p>"; // On affiche qu'on a bien aucun produit en session
    }
    else{ // Sinon, on crée un tableau pour le panier
?>        
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
<?php
        $totalGeneral = 0; // Création d'une variable pour avoir le total du panier
        foreach ($_SESSION['products'] as $index => $product) { // Pour chaque produit, on les insère a la suite du tableau
?>            
            <tr>
                <td><?= $index ?></td>
                    <!-- Ci-dessous, le lien pour afficher les détails du produit -->
                <td><a class='afficherDetails' href="traitement.php?action=detail&index=<?= $index ?>"><?= $product['name'] ?></a></td>
                <td><?= number_format($product['price'], 2, ",", "&nbsp;") ?>&nbsp;€</td>
                    <!-- Ci-dessous, le lien pour enlever de la quantité au produit                                                                                                                                             Ainsi que pour en ajouter -->
                <td class='caseQuantite'><a href="traitement.php?action=down-qtt&index=<?= $index ?>"><button class='boutonQuantite moins'>-</button></a><?= $product['qtt'] ?><a href="traitement.php?action=up-qtt&index=<?= $index ?>"><button class='boutonQuantite plus'>+</button></a></td>
                <td><?= number_format($product['total'], 2, ",", "&nbsp;") ?>&nbsp;€</td>
                    <!-- Ci-dessous, le lien pour supprimer le produit -->
                <td><a href="traitement.php?action=delete&index=<?= $index ?>"><button class='boutonDelete'><i class='fa fa-trash' aria-hidden='true'></i></button></a></td>
            </tr>
<?php
            $totalGeneral += $product['total']; // Le total de chaque produit est ajouté au total final
        }
        echo "<tr>",
                "<td><strong>Nombre d'articles : " . getNombreProduit() . "</strong></td>",
                "<td colspan=3><strong>Total général : </strong></td>",
                "<td><strong>" . number_format($totalGeneral, 2, ",", "&nbsp;") . "&nbsp;€</strong></td>",
            "</tr>",
        "</tbody>",
        "</table>";
        echo "<a href=\"traitement.php?action=clear\"><button>Vider le panier</button></a>"; // Lien qui effectue l'action de vider le panier
    }
?>

<?php
    if( isset($_SESSION['descriptionProduit']) || !empty($_SESSION['descriptionProduit']) ){ // Quand on définit la description du produit
?>

    <!-- On fait l'affichage de la partie modal qui contiendra les informations du produit -->
    <div class="modal" style="display:block">
        <div class="contenuModal">
            <span class="fermer">&times;</span>
            <?= $_SESSION['descriptionProduit'] // On affiche dans la boîte modale les détails du produit en question ?>
        </div>
    </div>

<?php
    unset($_SESSION['descriptionProduit']); // On le détruit ensuite, ça permet d'éviter de l'afficher lors du chargement de la page
    }
?>

    <div class='messageSuppression'><?= getAffichageSuppression(); ?></div>

<?php
    $contenu = ob_get_clean();
    $title = "Panier";
    require "template.php";
?>
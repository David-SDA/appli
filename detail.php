<?php
    session_start();
    ob_start();

    /* Si on n'a pas de variable de session de la descritption de produit, ou bien si il est vide */
    if((!isset($_SESSION['descriptionProduit']) || empty($_SESSION['descriptionProduit'])))
    {
        echo ""; // On affiche rien
    }
    else{ // Sinon
        echo $_SESSION['descriptionProduit']; // On affiche la description du produit
    }

    $contenu = ob_get_clean();
    $title = "Détails";
    require "template.php";
?>
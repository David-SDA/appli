<?php
    /* Fonction pour obtenir le nombre de produits dans le panier */
    function getNombreProduit(){
        $nombreProduits = 0;
        /* Si on a une variable de session rassemblant les produits, ou bien si il n'est pas vide */
        if( isset($_SESSION['products']) || !empty($_SESSION['products']) ){
            foreach($_SESSION['products'] as $produit){ // Pour chaque produit
                $nombreProduits += $produit['qtt']; // On ajoute sa quantité au nombre de produits
            } 
        }
        return $nombreProduits;
    }

    /* Fonction pour obtenir l'affichage de la confirmation de l'action de mettre un produit dans le panier */
    function getAffichageConfirmation(){
        $result = "";
        /* Si on a  de variable de session pour le message de confirmation, ou bien si il n'est vide */
        if( !isset($_SESSION['message']) || !empty($_SESSION['message']) ){
            $result .= $_SESSION['message'];
        }
        return $result;
    }
?>
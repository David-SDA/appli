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
        /* Si on a une variable de session pour le message de confirmation, ou bien si il n'est pas vide */
        if( isset($_SESSION['message']) || !empty($_SESSION['message']) ){
            $result .= $_SESSION['message']; // On le recupère pour le message
        }
        return $result;
    }

    /* Fonction pour obtenir l'affichage de la confirmation de la suppression d'un produit du panier */
    function getAffichageSuppression(){
        /* Si on a une variable de session pour le message de confirmation de suppression, ou bien si il n'est pas vide */
        if( isset($_SESSION['messageSuppression']) || !empty($_SESSION['messageSuppression']) ){
            $result = $_SESSION['messageSuppression']; // On le recupère pour le message
            unset($_SESSION['messageSuppression']); // On le détruit pour éviter des problèmes d'affichage
            return $result;
        }
        /* Sinon */
        return false; // On ne fait rien, on retourne false
    }
?>
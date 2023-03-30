<?php
    session_start();

    /* Si une action est faite, on va effectuer le switch */
    if(isset($_GET['action'])){

        switch($_GET['action']){ // On va effectuer des opérations en fonction de l'action
            
            //----------------AJOUTER UN PRODUIT------------------
            case "add" :
                if(isset($_POST['submit'])){ // Si l'action d'envoyer le formulaire est bien faite

                    /* On filtre les inputs du formulaire */
                    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);
                    $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
                    /* Si le filtrage a bien fonctionné */
                    if($name && $price && $qtt && $description){
                        /* On crée un tableau avec tout les attributs nécessaires */
                        $product = [
                            "name" => $name,
                            "price" => $price,
                            "qtt" => $qtt,
                            "total" => $price*$qtt,
                            "description" => $description
                        ];
                        
                        $_SESSION['products'][] = $product; // On l'ajoute à une variable de session
                        $_SESSION['message'] = "Réussi !"; // On crée une variable de session pour le message de réussite de l'opération
                    }
                    else{
                        $_SESSION['message'] = "Échec !"; // On crée une variable de session pour le message d'échec de l'opération
                    }
                }
                header("Location:index.php"); // On reste à l'accueil 
                break;
            
            //----------------SUPPRIMER UN PRODUIT------------------
            case "delete" :
                unset($_SESSION['products'][$_GET['index']]); // On détruit un produit
                $_SESSION['products'] = array_values($_SESSION['products']); // On met les index dans l'ordre
                header("Location:recap.php"); // On reste dans le recapitulatif des produits
                break;
            
            //----------------VIDER LE PANIER------------------
            case "clear" :
                foreach($_SESSION['products'] as $index=>$produit){ // Pour chaque produit dans la variable de session des produits
                    unset($_SESSION['products'][$index]); // On détruit le produit
                }
                header("Location:index.php"); // On retourne à l'accueil
                break;
            
            //----------------AUGMENTER LA QUANTITÉ D'UN PRODUIT------------------
            case "up-qtt" :
                $_SESSION['products'][$_GET['index']]['qtt']++; // La quantité du produit concerné est augmentée
                $_SESSION['products'][$_GET['index']]['total'] += $_SESSION['products'][$_GET['index']]['price']; // Donc son prix total l'est aussi
                $totalGeneral += $_SESSION['products'][$_GET['index']]['price']; // Ainsi que le total de tout les produits
                header("Location:recap.php"); // On reste dans le recapitulatif des produits
                break;
            
            //----------------DIMINUER LA QUANTITÉ D'UN PRODUIT------------------
            case "down-qtt" :
                if($_SESSION['products'][$_GET['index']]['qtt'] == 1){ // Si il reste une quantité de 1 à un produit
                    unset($_SESSION['products'][$_GET['index']]); // On va le détruire
                    $_SESSION['products'] = array_values($_SESSION['products']); // Et on met les index dans l'ordre
                    header("Location:recap.php"); // On reste dans le recapitulatif des produits
                }
                else{ // La quantité est supérieur à 1, on a juste à enlever 1 à la quantité
                    $_SESSION['products'][$_GET['index']]['qtt']--; // La quantité du produit concerné est diminuée 
                    $_SESSION['products'][$_GET['index']]['total'] -= $_SESSION['products'][$_GET['index']]['price']; // Donc son prix total l'est aussi
                    $totalGeneral -= $_SESSION['products'][$_GET['index']]['price'];// Ainsi que le total de tout les produits
                    header("Location:recap.php"); // On reste dans le recapitulatif des produits
                }
                break;

            //----------------AFFICHER LE DÉTAIL D'UN PRODUIT------------------
            case "detail" :

        }
    }
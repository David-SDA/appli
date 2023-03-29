<?php
    session_start();

    if(isset($_GET['action'])){

        switch($_GET['action']){
            //----------------AJOUTER UN PRODUIT------------------
            case "add" :
                if(isset($_POST['submit'])){

                    // filtrer les inputs du formulaire
                    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);
            
                    if($name && $price && $qtt){
                        
                        $product = [
                            "name" => $name,
                            "price" => $price,
                            "qtt" => $qtt,
                            "total" => $price*$qtt
                        ];
            
                        $_SESSION['products'][] = $product;
                        $_SESSION['message'] = "Réussi !";
                    }
                    else{
                        $_SESSION['message'] = "Échec !";
                    }
                }
                break;
            
            //----------------SUPPRIMER UN PRODUIT------------------
            case "delete" :
                unset($_SESSION['products'][$_GET['index']]);
                $_SESSION['products'] = array_values($_SESSION['products']);
                break;
            
            //----------------VIDER LE PANIER------------------
            case "clear" :
                foreach($_SESSION['products'] as $index=>$produit){
                    unset($_SESSION['products'][$index]);
                }
                break;
            
            //----------------AUGMENTER LA QUANTITÉ D'UN PRODUIT------------------
            case "up-qtt" :
            
            //----------------DIMINUER LA QUANTITÉ D'UN PRODUIT------------------
            case "down-qtt" :

            //----------------AFFICHER LE DÉTAIL D'UN PRODUIT------------------
            case "detail" :

        }
    }

    header("Location:index.php");
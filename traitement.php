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
                    if(isset($_FILES['file'])){ // On verifie qu'un file est bien présent
                        $tmpNom = $_FILES['file']['tmp_name']; // Le nom temporaire du fichier qui sera chargé sur la machine serveur 
                        $nom = $_FILES['file']['name']; // Le nom original du fichier
                        $taille = $_FILES['file']['size']; // Sa taille en octets
                        $error =$_FILES['file']['error'];
                    }
                    $tabExtension = explode('.', $nom); // on scinde la chaine en enlevant le point, ça devient un tableau
                    $extension = strtolower(end($tabExtension)); // On met les caractères en minuscule
                    $extensions = ['jpg', 'png', 'jpeg', 'gif']; // Un tableau d'extension que l'on accepte
                    $maxTaille = 400000; // Taille maximale que l'on autorise
                    /* Si le fichier a bien une des extensions accepter et a une taille autorisé */
                    if(in_array($extension, $extensions) && $taille <= $maxTaille && $error == 0){
                        $uniqueName = uniqid('', true);
                        $fileUnique = $uniqueName.".".$extension;
                        move_uploaded_file($tmpNom, './upload/'.$fileUnique); // On déplace le fichier dans un dossier que l'on a créer
                        $cheminImage = "./upload/" . $fileUnique; // On stocke le chemin de l'image
                    }
            
                    /* Si le filtrage a bien fonctionné */
                    if($name && $price && $qtt && $description && $cheminImage){
                        /* On crée un tableau avec tout les attributs nécessaires */
                        $product = [
                            "name" => $name,
                            "price" => $price,
                            "qtt" => $qtt,
                            "total" => $price*$qtt,
                            "description" => $description,
                            "file" => $cheminImage
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
                unlink($_SESSION['products'][$_GET['index']]['file']); //On détruit l'image du produit
                unset($_SESSION['products'][$_GET['index']]); // On détruit un produit
                $_SESSION['products'] = array_values($_SESSION['products']); // On met les index dans l'ordre
                unset($_SESSION['descriptionProduit']); // On détruit la description du produit
                header("Location:recap.php"); // On reste dans le recapitulatif des produits
                break;
            
            //----------------VIDER LE PANIER------------------
            case "clear" :
                foreach($_SESSION['products'] as $index=>$produit){ // Pour chaque produit dans la variable de session des produits
                    unlink($_SESSION['products'][$index]['file']); //On détruit l'image du produit
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
                    unset($_SESSION['descriptionProduit']); // On détruit la description du produit
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
                /* Si on veut aller à l'accueil */
                if(strcmp($_GET['button'], "accueil") == 0){
                    /* Si on n'a pas de variable de session de la descritption de produit, ou bien si il est vide */
                    if((!isset($_SESSION['descriptionProduit']) || empty($_SESSION['descriptionProduit']))){
                        header("Location:index.php"); // On retourne juste à l'accueil
                    }
                    else{ // Sinon
                        unset($_SESSION['descriptionProduit']); // On détruit la description du produit
                        header("Location:index.php"); // On retourne à l'accueil
                    }
                }
                else{ // Sinon (c'est à dire qu'on clique sur un produit)
                    $_SESSION['descriptionProduit'] = "<p>Description :
                    <br> <img src=\"" . $_SESSION['products'][$_GET['index']]['file'] . "\" alt=\"Une image\">
                    <br>Produit : " . $_SESSION['products'][$_GET['index']]['name'] . 
                    "<br>Description : " . $_SESSION['products'][$_GET['index']]['description'] . "<br></p>"; // On définit la variable de session de la description du produit
                    header("Location:recap.php"); // On reste dans le recapitulatif des produits
                }
                break;
        }
    }
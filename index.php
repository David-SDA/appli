<?php
    session_start();
    ob_start();
    require_once "functions.php";
?>
    <div class='messageAjout'><?= getAffichageConfirmation() ?></div>; <!-- On affiche le message de confirmation -->
    <h1>Ajouter un produit</h1>
    <form enctype='multipart/form-data' action='traitement.php?action=add' method='post'>
        <p>
            <label>
                Nom du produit : 
                <input type='text' name='name'>
            </label>
        </p>
        <p>
            <label>
                Prix du produit : 
                <input type='number' step='any' name='price'>
            </label>
        </p>
        <p>
            <label>
                Quantité désirée :
                <input type='number' name='qtt' value='1'>
            </label>
        </p>
        <p>
            <label>
                Description : 
                <textarea name='description' cols='60' rows='10'></textarea>
            </label>
        </p>
        <p>
            <label>
                Image :
                <input type='file' name='file'>
            </label>
        </p>
        <p>
            <input type='submit' name='submit' class='boutonAjoutProduit' value='Ajouter le produit'>
        </p>     
    </form>

<?php
    $contenu = ob_get_clean();
    $title = "Accueil";
    require "template.php";
?>
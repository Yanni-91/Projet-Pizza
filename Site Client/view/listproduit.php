<?php
require_once("controller/controllerPanier.php");
require_once("model/panier.php");
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des produits</title>
    <link rel="stylesheet" type="text/css" href="view/css/autreProduits.css"/> 
</head>
<body>
    <!--<h1>Liste des produits</h1>-->
    <div class="produit-container">
        <?php foreach ($tableau as $produit) : ?>
            <div class="produit-card">
                <img src="image/<?= $produit->get("nom_produit") ?>.jpg" class="produit-image">
		<div class="produit-name">
                    <p><?= $produit->get("nom_produit") ?></p>
                </div>
                <div class="produit-description">
                    <p><?= $produit->get("description_produit") ?></p>
                </div>
                <div class="price-and-button">
                    <div class="produit-price">
                        <p><?= $produit->get("prix_produit") ?> €</p>
                    </div>
                    <form method="post" action="">
                        <input type="hidden" name="action" value="ajouterAuPanier">
                        <input type="hidden" name="id_produit" value="<?= $produit->get("id_produit") ?>">
                        <button type="submit" class="add-to-cart-button">Ajouter au panier</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
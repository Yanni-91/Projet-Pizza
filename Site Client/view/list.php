<!-- view/list.php -->
<?php
// projet/controller/controllerPanier.php
error_reporting(E_ERROR | E_PARSE);
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
    <title>Liste des pizzas</title>
    <link rel="stylesheet" type="text/css" href="view/css/listePizza.css">
    <link rel="stylesheet" type="text/css" href="view/css/pub.css">
</head>
<body>
<?php
if ($action == "displayAll") {
    echo '<div class="conteneur">';
    echo '<div class="pizzaDuMoment">';
    
    $pizzasDuMoment = controllerPizza::getPizzaMoment();
    
    foreach ($pizzasDuMoment as $pizza) {
        echo '<img src="image/' . $pizza['nom_pizza'] . '.jpg" class="pizza-image">';
    }
    
    echo '</div>';
    
    echo '<div class="divDroite">';
    echo '<img src="gif/EM.gif" alt="en ce moment" class="imageEM">';
    
    $pizzasDuMoment = controllerPizza::getPizzaMoment();
    
    foreach ($pizzasDuMoment as $pizza) {
        echo '<div class="pizza">';
        echo '<h2>' . $pizza['nom_pizza'] . '</h2>';
        echo '<p>' . $pizza['description_pizza'] . '</p>';
        echo '<p>Prix : ' . $pizza['prix_pizza'] . '</p>';
        echo '</div>';
    }
    
    echo '</div>';
    echo '</div>';
}
?>

    <?/* var_dump($_SESSION['panier']); */?>
    <div class="pizza-container">
        <?php foreach ($tableau as $pizza) : ?>
            <div class="pizza-card">
                <img src="image/<?= $pizza->get("nom_pizza") ?>.jpg" class="pizza-image">
                <p class="pizza-nom"><?= $pizza->get("nom_pizza") ?></p>
                <p class="pizza-description"><?= $pizza->get("description_pizza") ?></p>
                <div class="price-and-button card-content">
                    <p class="pizza-price"><?= $pizza->get("prix_pizza") ?> €</p>
                    <form method="post" action="">
                        <input type="hidden" name="action" value="ajouterAuPanier">
                        <input type="hidden" name="id_pizza" value="<?= $pizza->get("id_pizza") ?>">
                        <button type="submit" class="add-to-cart-button">Ajouter au panier</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
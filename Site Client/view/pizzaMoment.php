<?php
require_once('controller/controllerPizza.php');
?>

<div class="conteneur">
    <div class="pizzaDuMoment">
        <!-- Contenu de la div Pizza Du Moment -->
        <?php
        $pizzasDuMoment = controllerPizza::getPizzaMoment();

        foreach ($pizzasDuMoment as $pizza) {
            echo '<img src="image/' . $pizza['nom_pizza'] . '.jpg" class="pizza-imageEM">';
        }
        ?>
        
    </div>

    <div class="divDroite">
    <img src="gif/EM.gif" alt="en ce moment" class="imageEM">
        <?php
        $pizzasDuMoment = controllerPizza::getPizzaMoment();

        foreach ($pizzasDuMoment as $pizza) {
            echo '<div class="pizza">';
            echo '<h2>"' . $pizza['nom_pizza'] . '"</h2>';
            echo '<p>à partir de ' . $pizza['prix_pizza'] . '</p>';
            echo '</div>';
        }
        ?>
    </div>
</div>
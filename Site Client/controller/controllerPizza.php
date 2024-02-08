<?php
require_once("model/pizza.php");

class controllerPizza {
    public static function displayAll() {
        connexion::connect(); 
        $tableau = pizza::getAll();
        include("view/list.php");
    }
    public static function displayVegan(){
        connexion::connect();
        $tableau = pizza::getVegan();
        include("view/list.php");
        
    }

    /*fonction qui récup PizzaMoment*/
    public static function getPizzaMoment() {
        $requete = "SELECT * FROM PizzaDuMoment";
        $resultat = connexion::pdo()->query($requete);
        $tableau = $resultat->fetchAll();
        return $tableau;
    }


    public static function displayIngredients($idPizza) {
        connexion::connect();
        $ingredients = pizza::getIngredients($idPizza);
        return $ingredients;
        include("view/list.php");
    }
}

<?php
require_once("model/autre_produit.php");

class controllerAutre_Produit {
    public static function displayProduit() {
        connexion::connect(); // Ajoutez cette ligne pour établir la connexion
        $tableau = autre_produit::getAll();
        include("view/listproduit.php");
    }
}
<?php
$action = "displayAll"; // Définit l'action par défaut sur displayAll
$validActions = ["displayStats", "displayPizzaEnAvant", "displayGereStock", "displayAlerte", "displayAjouterPizza", "displayIngredient", "displayProduit"];

if (isset($_GET["action"]) && in_array($_GET["action"], $validActions)) {
    $action = $_GET["action"];
}

// Objet par défaut pour displayAll
$objet = "Pizza";

// Définir le contrôleur en fonction de l'objet sélectionné
$contrôleur = "contrôleur" . ucfirst($objet);

// Inclut les fichiers nécessaires
require_once("config/connexion.php");
include("view/menu.html");
connexion::connect();

// Gérer les différentes actions
if ($action == "displayStats") {
    include("view/stats.php");
    /*include("view/statsClient.php");
    include("view/statsPizza.php");
    include("view/statsAutreProduits.php");*/

} elseif ($action == "displayPizzaEnAvant") {
    include("model/pizzaEnAvant.php");
} elseif ($action == "displayGereStock") {
    include("view/gereStock.html");
} elseif ($action == "displayAlerte") {
   
} elseif ($action == "displayAjouterPizza") {
    include("model/ajouterPizza.php"); // Ajoutez votre formulaire d'ajout de pizza
} elseif ($action == "displayIngredient") {
    include("model/gereStockIngredient.php"); // Ajoutez votre vue pour afficher les ingrédients
} elseif ($action == "displayProduit") {
    include("model/gereStockProduit.php"); // Ajoutez votre vue pour afficher les produits
} 
?>


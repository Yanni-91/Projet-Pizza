<?php
$action = "displayAll"; // Default action
$validActions = ["displayAll", "displayProduit", "displayStats", "displayVegan"];

if (isset($_GET["action"]) && in_array($_GET["action"], $validActions)) {
    $action = $_GET["action"];
}
// Default object for displayAll
$objet = "Pizza";

// Define the controller based on the selected object
$controller = "controller" . ucfirst($objet);

// Include necessary files
require_once("config/connexion.php");
connexion::connect();

// Handle the different actions
if ($action == "displayProduit") {
    // Use the controllerAutre_Produit for displaying other products
    require_once("controller/controllerAutre_Produit.php");
    controllerAutre_Produit::$action();
} elseif ($action == "displayVegan") {
    // Use the controllerPizza for displaying vegan pizzas
    require_once("controller/controllerPizza.php");
    controllerPizza::displayVegan();
} elseif ($action == "displayStats") {
    include("view/stats.php");
}
    else {
    // For other actions, execute the action of the default controller
    require_once("controller/$controller.php");
    $controller::$action();
}

// Include common views
include("view/vuePanier.php");
include("view/header.php");
include("view/footer.php");
?>

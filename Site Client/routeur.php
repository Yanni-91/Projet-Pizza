<?php
include("view/menu.php");
error_reporting(E_ERROR | E_PARSE);
$action = "displayAbout"; // Default action
$validActions = ["displayAll", "displayProduit", "displayStats", "displayVegan", "displayClient", "displayAbout", "displayPanier", "displayIngredients","displayPaiement"];

if (isset($_GET["action"]) && in_array($_GET["action"], $validActions)) {
    $action = $_GET["action"];
}

$objet = "Pizza";


$controller = "controller" . ucfirst($objet);


require_once("config/connexion.php");
connexion::connect();

if ($action == "displayProduit") {
    
    require_once("controller/controllerAutre_Produit.php");
    controllerAutre_Produit::$action();
    
} elseif ($action == "displayVegan") {
    require_once("controller/controllerPizza.php");
    controllerPizza::displayVegan();
}  elseif ($action == "displayClient"){
    include("view/formulaireClient.php");
}
elseif($action == "displayPaiement"){
    include("view/formulairePaiement.php");
}
elseif($action == "displayAbout") {
    include("view/about.php");
}
elseif($action=="displayPanier"){
    include("view/vuePanier.php");
}
elseif($action=="displayIngredients"){
    require_once("controller/controllerPizza.php");
}
else {
       
    include("view/pizzaMoment.php");
    require_once("controller/$controller.php");
    $controller::$action();
}

include("view/header.php");
include("view/footer.php");
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
?>

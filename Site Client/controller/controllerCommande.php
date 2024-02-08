<?php
require_once("config/connexion.php");
require_once("controllerClient.php");
require_once("model/autre_produit.php");
require_once("model/pizza.php");
require_once("model/commande.php");
require_once("model/panier.php");

// Start the session
if(!isset($_SESSION)) 
{ 
    session_start(); 
}

if($_SERVER["REQUEST_METHOD"] == "POST") { // or POST if your form uses POST method
    if(isset($_POST['action']) && $_POST['action'] === 'ajouterCommande') {
        date_default_timezone_set('Europe/Paris');
        $idCommande = commande::generateIdCommande();
        $dateCommande = date("Y-m-d H:i:s");
        $methodePaiement = "Carte de crédit";
        $montantCommande = panier::getMontantTotal();
        $idClient = ControllerClient::generateIdClient()-1;
        $idStatut = 2;
        $idPizzaiolo = rand(1, 5);
        commande::insererCommande($idCommande, $dateCommande, $methodePaiement, $montantCommande, $idClient, $idStatut, $idPizzaiolo);
    }
}
?>
<?php
require_once("controllerClient.php");
require_once("model/autre_produit.php");
require_once("model/pizza.php");
require_once("model/commande.php");
require_once("model/comprendre.php");
require_once("model/panier.php");

if(!isset($_SESSION)) 
{ 
    session_start(); 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['adresse'], $_POST['prenom'], $_POST['telephone'], $_POST['nom']) &&
    !empty($_POST['adresse']) && !empty($_POST['prenom']) && !empty($_POST['telephone']) && !empty($_POST['nom'])) {

    // Obtenez les valeurs des champs
    $adresse = $_POST['adresse'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];
    $nom = $_POST['nom'];

    // Genere un id client
    $idClient = ControllerClient::generateIdClient();
    ControllerClient::createNewClient($idClient, $prenom, $adresse, $telephone, $nom);


    date_default_timezone_set('Europe/Paris');
    $idCommande = commande::generateIdCommande();
    $dateCommande = date("Y-m-d H:i:s");
    $methodePaiement = "Carte de crédit";
    $montantCommande = panier::getMontantTotal();
    $idClient = ControllerClient::generateIdClient()-1;
    $idStatut = 2;
    $idPizzaiolo = rand(1, 5);
    commande::insererCommande($idCommande, $dateCommande, $methodePaiement, $montantCommande, $idClient, $idStatut, $idPizzaiolo);

    foreach ($_SESSION['panier'] as $item) {
        $produit = $item['produit'];
        $quantite = $item['quantite'];

        if ($produit instanceof Pizza) {
            // Si c'est une pizza, insérer dans la table contenir
            $idPizza = $produit->get("id_pizza");
            Comprendre::insererContenir(commande::generateIdCommande()-1, $idPizza, $quantite);
        } elseif ($produit instanceof Autre_Produit) {
            // Si c'est un produit, insérer dans la table peut_contenir
            $idProduit = $produit->get("id_produit");
            Comprendre::insererPeutContenir(commande::generateIdCommande()-1, $idProduit, $quantite);
        }
    }

    unset($_SESSION['panier']);
    header("Location: routeur.php?action=displayPaiement");
    exit();




} 
}
?>
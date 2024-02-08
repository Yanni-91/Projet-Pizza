<?php
error_reporting(E_ERROR | E_PARSE);
// Controller/ControllerPanier.php
require_once("model/panier.php");
require_once("model/autre_produit.php");
require_once("model/pizza.php");
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'ajouterAuPanier') {
            if (isset($_POST['id_pizza'])) {
                $idPizza = $_POST['id_pizza'];
                $pizza = Pizza::getOne($idPizza);
                Panier::ajouterAuPanier($pizza);
            } elseif (isset($_POST['id_produit'])) {
                $idProduit = $_POST['id_produit'];
                $produit = Autre_Produit::getOne($idProduit);
                Panier::ajouterAuPanier($produit);
            }
        } elseif ($_POST['action'] === 'supprimerDuPanier') {
            if (isset($_POST['id_pizza'])) {
                $idPizza = $_POST['id_pizza'];
                Panier::supprimerDuPanier($idPizza);
            } elseif (isset($_POST['id_produit'])) {
                $idProduit = $_POST['id_produit'];
                Panier::supprimerDuPanier($idProduit);
            }
        }
        elseif ($_POST['action'] === 'diminuerQuantite') {
            if (isset($_POST['id_pizza'])) {
                $idPizza = $_POST['id_pizza'];
                Panier::diminuerQuantite($idPizza);
            } elseif (isset($_POST['id_produit'])) {
                $idProduit = $_POST['id_produit'];
                Panier::diminuerQuantite($idProduit);
            }
        }
        elseif ($_POST['action'] === 'augmenterQuantite') {
            if (isset($_POST['id_pizza'])) {
                $idPizza = $_POST['id_pizza'];
                Panier::augmenterQuantite($idPizza);
            } elseif (isset($_POST['id_produit'])) {
                $idProduit = $_POST['id_produit'];
                Panier::augmenterQuantite($idProduit);
            }
        }
        // Gérez d'autres actions liées à la gestion du panier
        // ...
    }
}
?>

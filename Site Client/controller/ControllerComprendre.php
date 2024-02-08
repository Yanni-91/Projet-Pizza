<?php
require_once("model/comprendre.php");
require_once("model/autre_produit.php");
require_once("model/pizza.php");
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['action']) && $_POST['action'] === 'ajouterComprendre') {
                // Parcourir le panier
                foreach ($panier as $item) {
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

}
}
?>

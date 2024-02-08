<?php
require_once("objet.php");

class autre_produit extends objet {
    protected static string $classe = "Autre_Produit";
    protected static string $identifiant = "id_produit";
    protected ?int $id_produit;
    protected ?string $nom_produit;
    protected ?string $description_produit;
    protected ?float $prix_produit;
    protected ?int $id_stock_produit;

    public function __construct($id_produit = null, $nom_produit = null, $description_produit = null, $prix_produit = null, $id_stock_produit = null) {
        $this->id_produit = $id_produit;
        $this->nom_produit = $nom_produit;
        $this->description_produit = $description_produit;
        $this->prix_produit = $prix_produit;
        $this->id_stock_produit = $id_stock_produit;
    }

    public function __toString() {
        return "Le produit $this->nom_produit coûte $this->prix_produit €";
    }
}
?>

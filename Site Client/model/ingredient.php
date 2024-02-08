<?php
require_once("objet.php");

class Ingredient extends objet {
    protected static string $classe = "Ingredient";
    protected static string $identifiant = "id_ingredient";
    protected ?int $id_ingredient;
    protected ?string $nom_ingredient;
    protected ?int $id_stock;

    public function __construct(?int $id_ingredient = null, ?string $nom_ingredient = null, ?int $id_stock = null) {
        $this->id_ingredient = $id_ingredient;
        $this->nom_ingredient = $nom_ingredient;
        $this->id_stock = $id_stock;
    }

    public function __toString() {
        $chaine = "id_ingredient : $this->id_ingredient  nom_ingredient : $this->nom_ingredient id_stock : $this->id_stock ";
        return $chaine;
    }

    public static function getAll() {
        $query = "SELECT * FROM Ingredient";
        $connection = connexion::pdo();
        $stmt = $connection->query($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Ingredient');
        return $stmt->fetchAll();
    }
}
?>
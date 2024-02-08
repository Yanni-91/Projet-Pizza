<?php
require_once("objet.php");

class pizza extends objet {






    protected static string $classe = "Pizza";
    protected static string $identifiant = "id_pizza";
    protected ?int $id_pizza;
    protected ?string $nom_pizza;
    protected ?string $description_pizza;
    protected ?float $prix_pizza;

    public function __construct(?int $id_pizza = null, ?string $nom_pizza = null, ?string $description_pizza = null, ?float $prix_pizza = null) {
        $this->id_pizza = $id_pizza;
        $this->nom_pizza = $nom_pizza;
        $this->description_pizza = $description_pizza;
        $this->prix_pizza = $prix_pizza;
    }

    public function __toString() {
        $chaine = "id_pizza : $this->id_pizza  nomProduit : $this->nom_pizza description_pizza  : $this->description_pizza prix : $this->prix_pizza ";
        return $chaine;
    }

    public static function getVegan(){
        $requete = "SELECT * FROM Pizza WHERE description_pizza LIKE '%Vegan%'";
        $resultat = connexion::pdo()->query($requete);
        $resultat->setFetchmode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, self::$classe);
        $tableau = $resultat->fetchAll();
        return $tableau;
    }    

    public function getNomPizza() {
        return $this->nom_pizza;
    }

    public function getDescriptionPizza() {
        return $this->description_pizza;
    }

    public function getPrixPizza() {
        return $this->prix_pizza;
    }

    // ... (autres méthodes)
}
?>



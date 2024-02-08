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

    public static function getIngredients($idPizza) {
        // Utilisez la requête SQL pour récupérer les ingrédients de la pizza courante
        $query = "SELECT * FROM Ingredient I
        INNER JOIN Posseder P ON I.id_ingredient = P.id_ingredient
         WHERE P.id_pizza = :id_pizza";
        $params = array(':id_pizza' => $idPizza);
        // Obtenez une instance de connexion (remplacez connexion::pdo() par votre méthode de connexion réelle)
        $connection = connexion::pdo();
        // Préparez la requête
        $stmt = $connection->prepare($query);
        // Exécutez la requête avec les paramètres
        $stmt->execute($params);
        // Configurez le mode de récupération
        $stmt->setFetchMode(PDO::FETCH_CLASS, self::$classe);
        // Récupérez tous les résultats
        $ingredients = $stmt->fetchAll();
        //renvoie un tableau d'ingrédients d'une pizza
        return $ingredients;
    }
}
?>

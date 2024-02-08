<?php
class objet {
    public function get($attribut){
        return $this->$attribut;
    }

    public function set($attribut, $valeur) : void{
        $this->$attribut = $valeur;
    }
    public static function getAll(){
        $classeRecuperee = static::$classe;
        $requete = "SELECT * FROM $classeRecuperee";
        $resultat = connexion::pdo()->query($requete);
        $resultat->setFetchmode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $classeRecuperee);
        $tableau = $resultat->fetchAll();
        return $tableau;
    }
    public static function getBestClients() {
        $requete = "SELECT * FROM MeilleursClients";
        $resultat = connexion::pdo()->query($requete);
        $tableau = $resultat->fetchAll();
        return $tableau;
    }
    public static function getBestPizza() {
        $requete = "SELECT * FROM MeilleursPizzas";
        $resultat = connexion::pdo()->query($requete);
        $tableau = $resultat->fetchAll();
        return $tableau;
    }

    public static function getBestProduit() {
        $requete = "SELECT * FROM MeilleursProduits";
        $resultat = connexion::pdo()->query($requete);
        $tableau = $resultat->fetchAll();
        return $tableau;
    }

    public static function getCA() {
        $requete = "SELECT * FROM Vue_TotalDepenses";
        $resultat = connexion::pdo()->query($requete);
        $premiereLigne = $resultat->fetch();
        return $premiereLigne;
    }

    public static function getOne($id) {
        $classeRecuperee = static::$classe;
        $identifiantRecuperee = static::$identifiant;
    
        $requete = "SELECT * FROM $classeRecuperee WHERE $identifiantRecuperee = :id";
        $statement = connexion::pdo()->prepare($requete);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $resultat = $statement->fetch(PDO::FETCH_ASSOC);
    
        // Affichez la structure du tableau associatif pour le débogage
        //var_dump($resultat);
    
        if ($resultat) {
            // Utilisez directement les clés du tableau associatif
            return new $classeRecuperee(
                $resultat['id_pizza'] ?? null,
                $resultat['nom_pizza'] ?? null,
                $resultat['description_pizza'] ?? null,
                $resultat['prix_pizza'] ?? null,
            );
        }
    
        return null;
    }

}
?>

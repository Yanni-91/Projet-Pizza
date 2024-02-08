<?php 
require_once("config/connexion.php");
require_once("controller/ControllerComprendre.php");

class Comprendre {
    public static function insererContenir($idCommande, $idPizza, $quantite) {
        $conn = connexion::pdo();

        if ($conn == null) {
            echo("Erreur de connexion à la bd");
            return;
        }

        $sql = "INSERT INTO Contenir (id_commande, id_pizza, quantite_pizza) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Lier les paramètres
        $stmt->bindValue(1, $idCommande);
        $stmt->bindValue(2, $idPizza);
        $stmt->bindValue(3, $quantite);

        // Exécuter la requête et vérifier les erreurs
        if (!$stmt->execute()) {
            echo "Erreur lors de l'insertion dans la table contenir : " . implode(', ', $stmt->errorInfo());
        }

        $stmt->closeCursor();
    }

    public static function insererPeutContenir($idCommande, $idProduit, $quantite) {
        $conn = connexion::pdo();

        if ($conn == null) {
            echo("Erreur de connexion à la bd");
            return;
        }

        $sql = "INSERT INTO Peut_contenir (id_commande, id_produit, quantite_produit) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Lier les paramètres
        $stmt->bindValue(1, $idCommande);
        $stmt->bindValue(2, $idProduit);
        $stmt->bindValue(3, $quantite);

        // Exécuter la requête et vérifier les erreurs
        if (!$stmt->execute()) {
            echo "Erreur lors de l'insertion dans la table peut_contenir : " . implode(', ', $stmt->errorInfo());
        }

        $stmt->closeCursor();
    }
}
?>

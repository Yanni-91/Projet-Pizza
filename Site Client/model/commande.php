<?php
require_once("config/connexion.php");
class commande{
    public static function insererCommande($idCommande,$dateCommande,$methodePaiement,$montantCommande,$idClient,$idStatut,$idPizzaiolo){
        $conn = connexion::pdo(); // Utilisez la connexion existante

        if ($conn == null) {
            echo("Erreur de connexion à la bd");
            return; // Terminate the function if the connection fails
        }

        $sql = "INSERT INTO Commande (id_commande, date_commande, methode_paiement, montant_commande, id_client, id_statut, id_pizzaiolo) VALUES (? ,?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        // Lier les paramètres
        $stmt->bindValue(1, $idCommande);
        $stmt->bindValue(2, $dateCommande);
        $stmt->bindValue(3, $methodePaiement);
        $stmt->bindValue(4, $montantCommande);
        $stmt->bindValue(5, $idClient);
        $stmt->bindValue(6, $idStatut);
        $stmt->bindValue(7, $idPizzaiolo);

        // Exécuter la requête et vérifier les erreurs
        if ($stmt->execute()) {
            echo "New client created successfully";
        } else {
            echo "Error: " . $stmt->errorInfo()[2]; // Affiche l'erreur spécifique à PDO
        }

        $stmt->closeCursor();
    }
    public static function generateIdCommande() {
        $conn = connexion::pdo();
        if ($conn == null) {
            echo "Erreur de connexion à la base de données.";
            return null;
        }

        // Requête qui renvoie l'id client le plus grand +1 (SELECT MAX(id_client)+1 FROM Client C)
        $sql = "SELECT MAX(id_commande) + 1 AS next_id_commande FROM Commande";

        // Exécuter la requête et vérifier les erreurs
        try {
            $stmt = $conn->query($sql);
            if (!$stmt) {
                echo "Erreur lors de l'exécution de la requête : " . implode(', ', $conn->errorInfo());
                return null;
            }

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
            if ($result && $result['next_id_commande'] != null) {
                return $result['next_id_commande'];
            } else {
                return 1;
            }
        } catch (PDOException $e) {
            echo "Erreur PDO lors de l'exécution de la requête : " . $e->getMessage();
            return null;
        }
    } 
}
<?php
require_once("model/autre_produit.php");
require_once("model/pizza.php");
require_once("config/connexion.php");
// Start the session
if(!isset($_SESSION)) 
{ 
    session_start(); 
}

class ControllerClient {

    public static function createNewClient($idClient, $prenom, $adresse, $telephone, $nom) {
        $conn = connexion::pdo(); // Utilisez la connexion existante

        if ($conn == null) {
            echo("Erreur de connexion à la bd");
            return; // Terminate the function if the connection fails
        }

        $sql = "INSERT INTO Client (id_client, adresse_client, nom_client, prenom_client, telephone_client) VALUES (? ,?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        // Lier les paramètres
        $stmt->bindValue(1, $idClient);
        $stmt->bindValue(2, $adresse);
        $stmt->bindValue(3, $nom);
        $stmt->bindValue(4, $prenom);
        $stmt->bindValue(5, $telephone);

        // Exécuter la requête et vérifier les erreurs
        if ($stmt->execute()) {
            echo "New client created successfully";
        } else {
            echo "Error: " . $stmt->errorInfo()[2]; // Affiche l'erreur spécifique à PDO
        }

        $stmt->closeCursor();
    }

    public static function generateIdClient() {
        $conn = connexion::pdo();
        if ($conn == null) {
            echo "Erreur de connexion à la base de données.";
            return null;
        }

        // Requête qui renvoie l'id client le plus grand +1 (SELECT MAX(id_client)+1 FROM Client C)
        $sql = "SELECT MAX(id_client) + 1 AS next_id FROM Client";

        // Exécuter la requête et vérifier les erreurs
        try {
            $stmt = $conn->query($sql);
            if (!$stmt) {
                echo "Erreur lors de l'exécution de la requête : " . implode(', ', $conn->errorInfo());
                return null;
            }

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
            if ($result && $result['next_id'] != null) {
                return $result['next_id'];
            } else {
                return 1;
            }
        } catch (PDOException $e) {
            echo "Erreur PDO lors de l'exécution de la requête : " . $e->getMessage();
            return null;
        }
    } 
}
?>

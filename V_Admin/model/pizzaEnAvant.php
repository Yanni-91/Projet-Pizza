<?php
// Utilisez votre propre connexion à la base de données
require_once("config/connexion.php");
connexion::connect();

// Vérifier si l'ID de la pizza est présent dans la requête POST
if (isset($_POST['pizza_id'])) {
    $pizzaId = $_POST['pizza_id'];

    // Préparer et exécuter la requête pour créer la vue
    $sql = $sql = "CREATE OR REPLACE VIEW PizzaDuMoment AS
    SELECT *
    FROM Pizza
    WHERE id_pizza = :pizzaId";


    $stmt = connexion::pdo()->prepare($sql);
    $stmt->bindParam(':pizzaId', $pizzaId, PDO::PARAM_INT);

    try {
        $stmt->execute();
        echo "La vue PizzaDuMoment a été créée avec succès pour la pizza d'ID : $pizzaId";
    } catch (PDOException $e) {
        echo "Erreur lors de la création de la vue : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="view/css/pMoment.css">
    <title>Choisissez une Pizza à mettre en avant</title>
</head>
<body>
    <div class="form-container">
        <h1>Choisissez une Pizza à mettre en avant</h1>
        <form method="POST" action="">
            <label for="pizza_id">L'ID de la pizza ICI :</label>
            <input type="text" name="pizza_id" placeholder="ID pizza" required>
        <button type="submit" class="shadow__btn">
            AJOUTER PIZZA DU MOMENT
        </button>
    </form>
    </div>
</body>
</html>

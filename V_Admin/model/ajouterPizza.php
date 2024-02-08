<?php
// Utilisez votre propre connexion à la base de données
require_once("config/connexion.php");
connexion::connect();

// Vérifier si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nomPizza = $_POST['nom_pizza'];
    $descriptionPizza = $_POST['description_pizza'];
    $prixPizza = $_POST['prix_pizza'];
    $ingredients = isset($_POST['ingredients']) ? $_POST['ingredients'] : [];

    try {
        // Étape 1: Récupérer le nouvel ID pour la pizza
        $sqlGetNewPizzaId = "SELECT MAX(id_pizza) + 1 AS new_id FROM Pizza";
        $stmtGetNewPizzaId = connexion::pdo()->prepare($sqlGetNewPizzaId);
        $stmtGetNewPizzaId->execute();
        $result = $stmtGetNewPizzaId->fetch(PDO::FETCH_ASSOC);
        $newPizzaId = $result['new_id'];

        // Étape 2: Insérer la pizza dans la table 'Pizza'
        $sqlInsertPizza = "INSERT INTO Pizza (id_pizza, nom_pizza, description_pizza, prix_pizza) 
                           VALUES (:idPizza, :nomPizza, :descriptionPizza, :prixPizza)";
        
        $stmtInsertPizza = connexion::pdo()->prepare($sqlInsertPizza);
        $stmtInsertPizza->bindParam(':idPizza', $newPizzaId, PDO::PARAM_INT);
        $stmtInsertPizza->bindParam(':nomPizza', $nomPizza, PDO::PARAM_STR);
        $stmtInsertPizza->bindParam(':descriptionPizza', $descriptionPizza, PDO::PARAM_STR);
        $stmtInsertPizza->bindParam(':prixPizza', $prixPizza, PDO::PARAM_STR);
        $stmtInsertPizza->execute();

        // Étape 3: Insérer les relations entre la pizza et les ingrédients dans la table 'Posseder'
        foreach ($ingredients as $ingredientId) {
            $sqlInsertPosseder = "INSERT INTO Posseder (id_pizza, id_ingredient) VALUES (:idPizza, :idIngredient)";
            $stmtInsertPosseder = connexion::pdo()->prepare($sqlInsertPosseder);
            $stmtInsertPosseder->bindParam(':idPizza', $newPizzaId, PDO::PARAM_INT);
            $stmtInsertPosseder->bindParam(':idIngredient', $ingredientId, PDO::PARAM_INT);
            $stmtInsertPosseder->execute();
        }

        echo "Pizza ajoutée avec succès !";
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout de la pizza : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="view/css/ajoutP.css">
    <title>Ajouter une Pizza</title>
</head>
<body>
<div class="pizzaForm">
    <h1>Formulaire d'ajout de Pizza</h1>
    <form method="POST" action="">
        <label for="nom_pizza">Nom de la Pizza :</label>
        <input type="text" name="nom_pizza" required>

        <label for="description_pizza">Description :</label>
        <textarea name="description_pizza" required></textarea>

        <label for="prix_pizza">Prix :</label>
        <input type="text" name="prix_pizza" required>

        <label for="ingredients">Ingrédients :</label>
        <?php
        // Récupérer la liste des ingrédients depuis la table 'Ingredient'
        $sqlIngredients = "SELECT id_ingredient, nom_ingredient FROM Ingredient";
        $stmtIngredients = connexion::pdo()->query($sqlIngredients);
        $ingredients = $stmtIngredients->fetchAll(PDO::FETCH_ASSOC);

        // Afficher chaque ingrédient avec une case à cocher
        foreach ($ingredients as $ingredient) {
            echo "<label ><input type='checkbox' name='ingredients[]' value='" . $ingredient['id_ingredient'] . "'>" . $ingredient['nom_ingredient'] . "</label><br>";
        }
        ?>

        <button type="submit">Ajouter la Pizza</button>
    </form>
</div>
</body>
</html>

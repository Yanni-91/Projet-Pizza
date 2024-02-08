<?php
// Inclure votre fichier de connexion à la base de données
require_once("config/connexion.php");
connexion::connect();

// Récupérer les ingrédients depuis la table Ingredient
$sql = "SELECT id_ingredient, nom_ingredient, quantite_ingredient, Ingredient.id_stock FROM Ingredient INNER JOIN Stock ON Ingredient.id_stock = Stock.id_stock";
$stmt = connexion::pdo()->query($sql);
$ingredients = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($ingredients as $ingredient) {
        // Vérifie si la quantité a été soumise via le formulaire
        if (isset($_POST['quantite_' . $ingredient['id_ingredient']])) {
            $newQuantity = $_POST['quantite_' . $ingredient['id_ingredient']];
            
            // Mettez à jour la quantité dans la base de données
            $updateSql = "UPDATE Stock SET quantite_ingredient = :newQuantity WHERE id_stock = :idStock";
            $updateStmt = connexion::pdo()->prepare($updateSql);
            $updateStmt->bindParam(':newQuantity', $newQuantity, PDO::PARAM_INT);
            $updateStmt->bindParam(':idStock', $ingredient['id_stock'], PDO::PARAM_INT);
            $updateStmt->execute();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="view/css/ig.css">
    <title>Affichage des Ingrédients</title>
</head>
<body>
<div class="dispIG">
    <h1>Affichage des Ingrédients</h1>
    <form method="POST" action="">
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nom de l'Ingrédient</th>
                <th>Quantité</th>
            </tr>
            <?php foreach ($ingredients as $ingredient) : ?>
                <tr>
                    <td><?= $ingredient['id_ingredient']; ?></td>
                    <td><?= $ingredient['nom_ingredient']; ?></td>
                    <td>
                        <input type="number" name="quantite_<?= $ingredient['id_ingredient']; ?>" value="<?= $ingredient['quantite_ingredient']; ?>">
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <button type="submit">Mettre à jour la quantité</button>
    </form>
            </div>
</body>
</html>

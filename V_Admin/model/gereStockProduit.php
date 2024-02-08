<?php
// Inclure votre fichier de connexion à la base de données
require_once("config/connexion.php");
connexion::connect();

// Récupérer les produits depuis la table Autre_Produit
$sql = "SELECT id_produit, nom_produit, description_produit, prix_produit, quantite_produit, Autre_Produit.id_stock_produit FROM Autre_Produit INNER JOIN Stock_Produit ON Autre_Produit.id_stock_produit = Stock_Produit.id_stock_produit";
$stmt = connexion::pdo()->query($sql);
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($produits as $produit) {
        // Vérifie si la quantité a été soumise via le formulaire
        if (isset($_POST['quantite_produit_' . $produit['id_produit']])) {
            $newQuantityProduit = $_POST['quantite_produit_' . $produit['id_produit']];
            
            // Mettez à jour la quantité dans la base de données
            $updateSqlProduit = "UPDATE Stock_Produit SET quantite_produit = :newQuantityProduit WHERE id_stock_produit = :idStockProduit";
            $updateStmtProduit = connexion::pdo()->prepare($updateSqlProduit);
            $updateStmtProduit->bindParam(':newQuantityProduit', $newQuantityProduit, PDO::PARAM_INT);
            $updateStmtProduit->bindParam(':idStockProduit', $produit['id_stock_produit'], PDO::PARAM_INT);
            $updateStmtProduit->execute();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="view/css/prod.css">
    <title>Affichage des Produits</title>
</head>
<body>
<div class="dispPROD">
    <h1>Affichage des Produits</h1>
    <form method="POST" action="">
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nom du Produit</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Quantité</th>
            </tr>
            <?php foreach ($produits as $produit) : ?>
                <tr>
                    <td><?= $produit['id_produit']; ?></td>
                    <td><?= $produit['nom_produit']; ?></td>
                    <td><?= $produit['description_produit']; ?></td>
                    <td><?= $produit['prix_produit']; ?></td>
                    <td>
                        <input type="number" name="quantite_produit_<?= $produit['id_produit']; ?>" value="<?= $produit['quantite_produit']; ?>">
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <button type="submit">Mettre à jour la quantité des produits</button>
    </form>
</div>
</body>
</html>

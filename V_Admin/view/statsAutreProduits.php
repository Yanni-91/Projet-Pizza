<!-- view/bestAutreProduits.php -->
<?php
require_once("model/objet.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BestSeller - Autre Produit</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>BestSeller - Autre Produit</h1>
    <table>
        <thead>
            <tr>
                <!-- Add column headers based on your data structure -->
                <th>Nom du Produit</th>
                <th>Nombre de commandes</th>
                <th>Nombre total de produits vendus</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $tableauAutreProduits = objet::getBestProduit();
            foreach ($tableauAutreProduits as $produit) : ?>
                <tr>
                    <!-- Display product information based on your structure -->
                    <td><?= $produit['nom_produit'] ?></td>
                    <td><?= $produit['nb_commandes'] ?></td>
                    <td><?= $produit['nb_produits_total'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

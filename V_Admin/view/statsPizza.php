<!-- view/stats.php -->
<?php
require_once("model/objet.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BestSeller</title>
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
    <h1>BestSeller</h1>
    <table>
        <thead>
            <tr>
                <!-- Add column headers based on your data structure -->
                <th>Nom de la Pizza</th>
                <th>Nombre de commandes</th>
                <th>Nombre total de pizzas vendues</th>
                <th>Montant total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $tableauPizzas = objet::getBestPizza();
            foreach ($tableauPizzas as $pizza) : ?>
                <tr>
                    <!-- Display pizza information based on your structure -->
                    <td><?= $pizza['nom_pizza'] ?></td>
                    <td><?= $pizza['nombre_commandes'] ?></td>
                    <td><?= $pizza['nombre_total_pizzas'] ?></td>
                    <td><?= $pizza['montant_total'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

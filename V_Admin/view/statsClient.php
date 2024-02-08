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
    <title>Meilleurs Clients</title>
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
    <h1>Meilleurs Clients</h1>
    <table>
        <thead>
            <tr>
                <!-- Ajoutez les en-têtes de colonnes en fonction de votre vue -->
                <th>prénom du client</th>
                <th>Nombre de commandes</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $tableau = objet::getBestClients();
            foreach ($tableau as $client) : ?>
                <tr>
                    <!-- Ajoutez les données de la vue en fonction de votre structure -->
                    <td><?= $client['prenom_client'] ?></td>
                    <td><?= $client['argent_depense'] ?></td>
                </tr>
            <?php endforeach; ?>
           
            
        </tbody>
    </table>

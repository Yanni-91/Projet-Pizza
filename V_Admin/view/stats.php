<?php
require_once("model/objet.php");
?>
<link rel="stylesheet" type="text/css" href="view/css/stats.css">
<title>Meilleurs Clients</title>
</head>
<body>
<div class="cardCA">
    <div class="title">
        <span>
            <svg width="20" fill="currentColor" height="20" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                <path d="M1362 1185q0 153-99.5 263.5t-258.5 136.5v175q0 14-9 23t-23 9h-135q-13 0-22.5-9.5t-9.5-22.5v-175q-66-9-127.5-31t-101.5-44.5-74-48-46.5-37.5-17.5-18q-17-21-2-41l103-135q7-10 23-12 15-2 24 9l2 2q113 99 243 125 37 8 74 8 81 0 142.5-43t61.5-122q0-28-15-53t-33.5-42-58.5-37.5-66-32-80-32.5q-39-16-61.5-25t-61.5-26.5-62.5-31-56.5-35.5-53.5-42.5-43.5-49-35.5-58-21-66.5-8.5-78q0-138 98-242t255-134v-180q0-13 9.5-22.5t22.5-9.5h135q14 0 23 9t9 23v176q57 6 110.5 23t87 33.5 63.5 37.5 39 29 15 14q17 18 5 38l-81 146q-8 15-23 16-14 3-27-7-3-3-14.5-12t-39-26.5-58.5-32-74.5-26-85.5-11.5q-95 0-155 43t-60 111q0 26 8.5 48t29.5 41.5 39.5 33 56 31 60.5 27 70 27.5q53 20 81 31.5t76 35 75.5 42.5 62 50 53 63.5 31.5 76.5 13 94z">
                </path>
            </svg>
        </span>
        <p class="title-text">
            Chiffres d'afffaires
        </p>
    </div>
    <div class="data">
        <p>
        <?php
        $CA = objet::getCA();
        echo $CA['total_depense'];
        ?>
        </p> 
        <div class="range">
            <div class="fill">
            </div>
        </div>
    </div>
</div>
<div class="stats-container">
    <div class="stats-section">
        <h1>Meilleurs Clients</h1>
        <table>
            <thead>
                <tr>
                    <!-- Ajoutez les en-têtes de colonnes en fonction de votre vue -->
                    <th>nom du client</th>
                    <th>prénom du client</th>
                    <th>Total Dépenser</th>
                    <th>Nombre de Commandes</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $tableau = objet::getBestClients();
                foreach ($tableau as $client) : ?>
                    <tr>
                        <!-- Ajoutez les données de la vue en fonction de votre structure -->
                        <td><?= $client['nom_client'] ?></td>
                        <td><?= $client['prenom_client'] ?></td>
                        <td><?= $client['argent_depense'] ?></td>
                        <td><?= $client['nombre_commandes'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="stats-section">
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
    </div>

    <div class="stats-section">
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
    </div>
</div>
</body>
</html>

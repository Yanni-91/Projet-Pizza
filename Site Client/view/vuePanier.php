<?php
error_reporting(E_ERROR | E_PARSE);
require_once("model/panier.php");
require_once("model/autre_produit.php");
require_once("model/pizza.php");
require_once("list.php");
require_once("listproduit.php");
if (!isset($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link rel="stylesheet" type="text/css" href="view/css/panier.css" />
</head>

<body>
    <div class="panier-container">
        <h1>Votre panier</h1>
        <table>
            <thead>
                <tr>
                    <th>Pizza</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $totalCommande = 0;
                foreach (Panier::getListeProduits() as $produit) :
                    $quantite = Panier::getQuantite($produit['produit']->get(property_exists($produit['produit'], 'id_produit') ? 'id_produit' : 'id_pizza'));
                    $prixUnitaire = $produit['produit']->get(property_exists($produit['produit'], 'id_produit') ? 'prix_produit' : 'prix_pizza');
                    $totalProduit = $prixUnitaire * $quantite;
                    $totalCommande += $totalProduit;
                ?>
                    <tr>
                        <td><?= $produit['produit']->get(property_exists($produit['produit'], 'id_produit') ? 'nom_produit' : 'nom_pizza') ?></td>
                        <td>
                            <div class="actions">
                                <form method="post" action="">
                                    <input type="hidden" name="action" value="diminuerQuantite">
                                    <input type="hidden" name="<?= property_exists($produit['produit'], 'id_produit') ? 'id_produit' : 'id_pizza' ?>" value="<?= $produit['produit']->get(property_exists($produit['produit'], 'id_produit') ? 'id_produit' : 'id_pizza') ?>">
                                    <button class="quantity" type="submit">-</button>
                                </form>

                                <?= Panier::getQuantite($produit['produit']->get(property_exists($produit['produit'], 'id_produit') ? 'id_produit' : 'id_pizza')) ?>

                                <form method="post" action="">
                                    <input type="hidden" name="action" value="augmenterQuantite">
                                    <input type="hidden" name="<?= property_exists($produit['produit'], 'id_produit') ? 'id_produit' : 'id_pizza' ?>" value="<?= $produit['produit']->get(property_exists($produit['produit'], 'id_produit') ? 'id_produit' : 'id_pizza') ?>">
                                    <button class="quantity" type="submit">+</button>
                                </form>
                            </div>
                        </td>
                        <td><?= $produit['produit']->get(property_exists($produit['produit'], 'id_produit') ? 'prix_produit' : 'prix_pizza') * Panier::getQuantite($produit['produit']->get(property_exists($produit['produit'], 'id_produit') ? 'id_produit' : 'id_pizza')) ?> €</td>
                        <td>
                            <form method="post" action="">
                                <input type="hidden" name="action" value="supprimerDuPanier">
                                <input type="hidden" name="<?= property_exists($produit['produit'], 'id_produit') ? 'id_produit' : 'id_pizza' ?>" value="<?= $produit['produit']->get(property_exists($produit['produit'], 'id_produit') ? 'id_produit' : 'id_pizza') ?>">
                                <button type="submit">Supprimer du panier</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="passerCommande">
            <h2 class="affichageMontant">Montant total : <?= $totalCommande; ?> €</h2>
            <?php
            //Affichage du bouton qui permet de passer la commande
            if (!empty(Panier::getListeProduits())) {
            echo '<div class="btnPasserCommande">
                        <form method="post" action="routeur.php?action=displayClient">
                        <button type="submit">Payer la commande</button>
                        </form>
                </div>';
            }
            ?>
        </div>
    </div>
</body>

</html>

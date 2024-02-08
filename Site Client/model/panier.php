<?php
// model/panier.php
class Panier {
    public static function ajouterAuPanier($produit) {
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }

        // Vérifie si le produit est déjà dans le panier
        $produitExiste = false;
        foreach ($_SESSION['panier'] as &$item) {
            $identifiantProduit = self::getIdentifiantProduit($item['produit']);
            if ($item['produit']->get($identifiantProduit) == $produit->get($identifiantProduit)) {
                $item['quantite']++;
                $produitExiste = true;
                break;
            }
        }

        // Si le produit n'est pas encore dans le panier, l'ajoute avec quantité 1
        if (!$produitExiste) {
            $_SESSION['panier'][] = [
                'produit' => $produit,
                'quantite' => 1
            ];
        }
    }

    public static function supprimerDuPanier($idProduit) {
        if (isset($_SESSION['panier'])) {
            foreach ($_SESSION['panier'] as $key => &$item) {
                $identifiantProduit = self::getIdentifiantProduit($item['produit']);
                if ($item['produit']->get($identifiantProduit) == $idProduit) {
                    unset($_SESSION['panier'][$key]);
                    break;
                }
            }
        }
    }

    public static function augmenterQuantite($idProduit) {
        if (isset($_SESSION['panier'])) {
            foreach ($_SESSION['panier'] as &$item) {
                $identifiantProduit = self::getIdentifiantProduit($item['produit']);
                if ($item['produit']->get($identifiantProduit) == $idProduit) {
                    $item['quantite']++;
                    break;
                }
            }
        }
    }

    public static function diminuerQuantite($idProduit) {
        if (isset($_SESSION['panier'])) {
            foreach ($_SESSION['panier'] as $key => &$item) {
                $identifiantProduit = self::getIdentifiantProduit($item['produit']);
                if ($item['produit']->get($identifiantProduit) == $idProduit) {
                    // Décrémente la quantité, si elle est supérieure à 1
                    if ($item['quantite'] > 1) {
                        $item['quantite']--;
                    } else {
                        // Supprime l'élément du panier si la quantité est égale à 1
                        unset($_SESSION['panier'][$key]);
                    }
                    break;
                }
            }
        }
    }

    public static function getListeProduits() {
        return isset($_SESSION['panier']) ? $_SESSION['panier'] : [];
    }

    public static function getQuantite($idProduit) {
        if (isset($_SESSION['panier'])) {
            foreach ($_SESSION['panier'] as $item) {
                $identifiantProduit = self::getIdentifiantProduit($item['produit']);
                if ($item['produit']->get($identifiantProduit) == $idProduit) {
                    return $item['quantite'];
                }
            }
        }

        return 0;
    }

    private static function getIdentifiantProduit($produit) {
        return property_exists($produit, 'id_produit') ? 'id_produit' : (property_exists($produit, 'id_pizza') ? 'id_pizza' : null);
    }

    public static function getMontantTotal() {
        $montantTotal = 0;

        if (isset($_SESSION['panier'])) {
            foreach ($_SESSION['panier'] as $item) {
                $produit = $item['produit'];
                $quantite = $item['quantite'];

                if ($produit instanceof Pizza) {
                    $montantTotal += $produit->get('prix_pizza') * $quantite;
                } elseif ($produit instanceof Autre_Produit) {
                    $montantTotal += $produit->get('prix_produit') * $quantite;
                }
            }
        }

        return $montantTotal;
    }
    public static function getNombreElementsPanier() {
        return isset($_SESSION['panier']) ? count($_SESSION['panier']) : 0;
    } 


}
?>

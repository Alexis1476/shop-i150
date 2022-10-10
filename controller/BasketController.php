<?php

/**
 * ETML
 * Date: 10/10/2022
 * Auteur: Alexis Rojas
 * Description: Class qui controle les actions rélatives au panier
 */
class BasketController extends Controller
{
    /**
     * Dispatch current action
     * @return mixed
     */
    public function display()
    {
        $action = $_GET['action'];

        return call_user_func(array($this, $action));
    }

    /**
     * Affiche le panier
     * @return false|string
     */
    public function show()
    {
        $shopRepository = new ShopRepository();
        $data = [];
        $products = [];

        // Get products in basket
        if (isset($_SESSION['products'])) {
            foreach ($_SESSION['products'] as $product => $quantity) {
                $data[] = $shopRepository->findOne($product);
            }
            // Calcul avec le decompte
            foreach ($data as $product) {
                if ($product[0]['proDiscount']) {
                    // Si le decompte est en pourcentage
                    if ($product[0]['proDiscountType'] == '%') {
                        $product[0]['proPrice'] = round($product[0]['proPrice'] - ($product[0]['proPrice'] * $product[0]['proDiscount']) / 100);
                    } // Si le decompte c'est en - CHF
                    else {
                        $product[0]['proPrice'] = round($product[0]['proPrice'] - $product[0]['proDiscount'], 1);
                    }
                }
                $products[] = $product;
            }
        } else {
            unset($_SESSION['totalProducts']);
        }

        $view = file_get_contents('view/page/basket/list.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Fait un achat instantané d'un produit
     * @return void
     */
    public function instantPurchase()
    {
        // Si le tableau contenant les id des produits n'existe pas
        if (!isset($_SESSION['products'])) {
            $_SESSION['products'] = [];
        }
        // Si un produit existe déjà on incrémente la quantité
        if (!isset($_SESSION['products'][$_GET['id']])) {
            $_SESSION['products'] += [$_GET['id'] => 1]; // Quantité initiale
        }

        header('Location: index.php?controller=order&action=delivery');
    }

    /**
     * Ajoute un produit au panier
     * @return void
     */
    public function add()
    {
        $_SESSION['totalProducts'] = 0;
        // Si le tableau contenant les id des produits n'existe pas
        if (!isset($_SESSION['products'])) {
            $_SESSION['products'] = [];

        }
        // Si un produit existe déjà on incrémente la quantité
        if (isset($_SESSION['products'][$_GET['id']])) {
            $_SESSION['products'][$_GET['id']]++;
        } else {
            $_SESSION['products'] += [$_GET['id'] => 1]; // Quantité initiale
        }

        // Calcul total panier
        $shopRepository = new ShopRepository();
        $data = [];
        $products = [];

        // Get products in basket
        if (isset($_SESSION['products'])) {
            foreach ($_SESSION['products'] as $product => $quantity) {
                $data[] = $shopRepository->findOne($product);
            }
            // Calcul avec le decompte
            foreach ($data as $product) {
                if ($product[0]['proDiscount']) {
                    // Si le decompte est en pourcentage
                    if ($product[0]['proDiscountType'] == '%') {
                        $product[0]['proPrice'] = round($product[0]['proPrice'] - ($product[0]['proPrice'] * $product[0]['proDiscount']) / 100);
                    } // Si le decompte c'est en - CHF
                    else {
                        $product[0]['proPrice'] = round($product[0]['proPrice'] - $product[0]['proDiscount'], 1);
                    }
                }
                $products[] = $product;
            }
        }
        // Calcul total panier
        $_SESSION['totalProducts'] = 0;
        foreach ($products as $product) :
            $sousTotal = $_SESSION['products'][$product[0]['idProduct']] * $product[0]['proPrice'];
            $sousTotal = round($sousTotal, 2);
            $_SESSION['totalProducts'] += $sousTotal;
        endforeach;

        header('Location: index.php?controller=basket&action=show');
    }

    /**
     * Incrémente ou décrémente la quantité du produit du panier
     * @return void
     */
    public function modify()
    {
        $shopRepository = new ShopRepository();
        $product = $shopRepository->findOne($_GET['id']);
        // Incrémenter la quantité
        if ($_GET['add'] === 'true') {
            if (++$_SESSION['products'][$_GET['id']] > $product[0]['proQuantity']) {
                --$_SESSION['products'][$_GET['id']];
            }
        } else {
            if (--$_SESSION['products'][$_GET['id']] == 0) {
                unset($_SESSION['products'][$_GET['id']]);
            }
        }
        // S'il n'y a plus de produits dans le panier
        if (!$_SESSION['products']) {
            unset($_SESSION['totalProducts']);
        }
        header('Location: index.php?controller=basket&action=show');
    }

    /**
     * Supprime un produit du panier
     * @return void
     */
    public function delete()
    {
        unset($_SESSION['products'][$_GET['id']]);
        if (!$_SESSION['products']) {
            unset($_SESSION['totalProducts']);
        }
        header('Location: index.php?controller=basket&action=show');
    }
}
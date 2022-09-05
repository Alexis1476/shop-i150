<?php

class BasketController extends Controller
{
    public function display()
    {
        $action = $_GET['action'];

        return call_user_func(array($this, $action));
    }

    public function show()
    {
        $shopRepository = new ShopRepository();
        $products = [];

        // Get products in basket
        if (isset($_SESSION['products'])) {
            foreach ($_SESSION['products'] as $product => $quantity) {
                $products[] = $shopRepository->findOne($product);
            }
        }
        /*$sousTotal = 0;
        foreach ($products as $product) {

        }
        $total =*/
        $view = file_get_contents('view/page/basket/list.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    public function delete()
    {
        unset($_SESSION['products'][$_GET['id']]);
        header('Location: index.php?controller=basket&action=show');
    }

    public function add()
    {
        /*TODO: Ajouter produit au panier -> revenir en arrière*/
        if (!isset($_SESSION['products'])) {
            $_SESSION['products'] = [];
        }
        if (isset($_SESSION['products'][$_GET['id']])) {
            $_SESSION['products'][$_GET['id']]++;
            echo 'Ajouté';
        } else {
            $_SESSION['products'] += [$_GET['id'] => 1]; // Quantité
            var_dump($_SESSION);
        }
    }
}
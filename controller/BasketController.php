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
        /*TODO: Afficher liste des produits du panier*/
        $shopRepository = new ShopRepository();
        $products = [];
        // Get products in basket
        foreach ($_SESSION['products'] as $product) {
            $products[] = $shopRepository->findOne($product);
        }

        $view = file_get_contents('view/page/basket/list.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    public function add()
    {
        /*TODO: Ajouter produit au panier -> revenir en arrière*/
        if (!isset($_SESSION['products'])) {
            $_SESSION['products'] = [];
        }
        if (in_array($_GET['id'], $_SESSION['products'])) {
            echo 'Ajouté';
        } else {
            $_SESSION['products'][] = $_GET['id'];
            var_dump($_SESSION);
        }
    }
}
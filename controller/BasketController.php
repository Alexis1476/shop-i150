<?php

/**
 * ETML
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
        $products = [];

        // Get products in basket
        if (isset($_SESSION['products'])) {
            foreach ($_SESSION['products'] as $product => $quantity) {
                $products[] = $shopRepository->findOne($product);
            }
        }

        $view = file_get_contents('view/page/basket/list.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }
}
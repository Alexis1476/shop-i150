<?php

class BasketController extends Controller
{
    public function display()
    {
        $action = $_GET['action'];

        return call_user_func(array($this, $action));
    }

    public function delivery()
    {

        $view = file_get_contents('view/page/basket/delivery.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
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

        $view = file_get_contents('view/page/basket/list.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

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

        header('Location: index.php?controller=basket&action=show');
    }

    public function delete()
    {
        unset($_SESSION['products'][$_GET['id']]);
        header('Location: index.php?controller=basket&action=show');
    }

    public function add()
    {
        if (!isset($_SESSION['products'])) {
            $_SESSION['products'] = [];
        }
        if (isset($_SESSION['products'][$_GET['id']])) {
            $_SESSION['products'][$_GET['id']]++;
        } else {
            $_SESSION['products'] += [$_GET['id'] => 1]; // Quantité
        }
        header('Location: index.php?controller=basket&action=show');
    }
}
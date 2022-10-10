<?php
/**
 * ETML
 * Date: 10/10/2022
 * Description: Class qui gère les produits du shop
 */

include_once 'classes/ShopRepository.php';

class ShopController extends Controller
{

    /**
     * Dispatch current action
     *
     * @return mixed
     */
    public function display()
    {

        $action = $_GET['action'] . "Action";

        // return $this->$page();

        /* TODO :
        $this-°view = file_get_contents('view/page/' . $controller . '/' . $action . '.html');
        */

        return call_user_func(array($this, $action));
    }

    /**
     * Display List Action
     *
     * @return string
     */
    private function listAction()
    {
        $shopRepository = new ShopRepository();
        $data = $shopRepository->findAll();
        $products = [];
        foreach ($data as $product) {
            // Si le produit a un decompte
            $product += ['total' => $product['proPrice']];
            if ($product['proDiscount']) {
                // Si le decompte est en pourcentage
                if ($product['proDiscountType'] == '%') {
                    $product['total'] = round($product['proPrice'] - ($product['proPrice'] * $product['proDiscount']) / 100, 1);
                } // Si le decompte c'est en - CHF
                else {
                    $product['total'] = round($product['proPrice'] - $product['proDiscount'],1);
                }
            }
            $products[] = $product;
        }
        $view = file_get_contents('view/page/shop/list.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Display Detail Action
     *
     * @return string
     */
    private function detailAction()
    {

        $shopRepository = new ShopRepository();
        $product = $shopRepository->findOne($_GET['id']);

        $view = file_get_contents('view/page/shop/detail.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;

    }
}
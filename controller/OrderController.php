<?php

class OrderController extends Controller
{
    public function display()
    {
        $action = $_GET['action'];

        return call_user_func(array($this, $action));
    }

    public function delivery()
    {
        $postePrice = 7.95;
        $view = file_get_contents('view/page/order/delivery.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    public function payment()
    {
        if (!isset($_POST['deliveryMethod']) && isset($_POST['form']))
            header('Location: index.php?controller=order&action=delivery&error');

        /*TODO: Sauvegarder l'élection utilisateur*/
        $invoicePrice = 2;
        $creditCard = 2;

        $view = file_get_contents('view/page/order/payment.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    public function addresse()
    {
        if (!isset($_POST['paymentMethod']))
            header('Location: index.php?controller=order&action=payment&error');

        $view = file_get_contents('view/page/order/addresse.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    public function summary()
    {
        // TODO: Gerer formulaire d'avant (erreurs)

        $view = file_get_contents('view/page/order/summary.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }
}
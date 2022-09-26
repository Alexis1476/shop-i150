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
        // Suppresion des erreurs de la session
        if (isset($_SESSION['errors']))
            $errors = $_SESSION['errors'];
        unset($_SESSION['errors']);

        // Si l'utilisateur n'a pas selectionné un moyen de paiement
        if (!isset($_POST['paymentMethod']) && isset($_POST['form']))
            header('Location: index.php?controller=order&action=payment&error');

        $view = file_get_contents('view/page/order/addresse.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    public function summary()
    {
        define('ERROR_MESSAGE', 'Remplissez ce champ correctement');
        // TODO: Gerer formulaire d'avant (erreurs)
        if (!$_POST['title'] || !preg_match("/^[a-z|A-Z]+$/", $_POST['title'])) {
            $_SESSION['errors']['title'] = ERROR_MESSAGE;
        }
        if (!$_POST['firstName'] || !preg_match("/^[a-z|A-Z]+$/", $_POST['firstName'])) {
            $_SESSION['errors']['firstName'] = ERROR_MESSAGE;
        }
        if (!$_POST['lastName'] || !preg_match("/^[a-z|A-Z]+$/", $_POST['lastName'])) {
            $_SESSION['errors']['lastName'] = ERROR_MESSAGE;
        }
        if (!$_POST['street'] || !preg_match("/^[a-z |A-Z0-9]+$/", $_POST['street'])) {
            $_SESSION['errors']['street'] = ERROR_MESSAGE;
        }
        if (!$_POST['streetNumber'] || !preg_match("/^[0-9]+$/", $_POST['streetNumber'])) {
            $_SESSION['errors']['streetNumber'] = ERROR_MESSAGE;
        }
        if (!$_POST['pc'] || !preg_match("/^[0-9]{4}$/", $_POST['pc'])) {
            $_SESSION['errors']['pc'] = ERROR_MESSAGE;
        }
        if (!$_POST['locality'] || !preg_match("/^[a-z |A-Z]+$/", $_POST['locality'])) {
            $_SESSION['errors']['locality'] = ERROR_MESSAGE;
        }
        if (!$_POST['mail'] || !preg_match("/^\S+@\S+\.[A-Z|a-z]+$/", $_POST['mail'])) {
            $_SESSION['errors']['mail'] = ERROR_MESSAGE;
        }
        if (!$_POST['phone'] || !preg_match("/^(\+41|0)7([0-9]{8})$/", $_POST['phone'])) {
            $_SESSION['errors']['phone'] = ERROR_MESSAGE;
        }
        // Recupère les données dans la session
        $_SESSION['title'] = $_POST['title'];
        $_SESSION['firstName'] = $_POST['firstName'];
        $_SESSION['lastName'] = $_POST['lastName'];
        $_SESSION['street'] = $_POST['street'];
        $_SESSION['streetNumber'] = $_POST['streetNumber'];
        $_SESSION['pc'] = $_POST['pc'];
        $_SESSION['locality'] = $_POST['locality'];
        $_SESSION['mail'] = $_POST['mail'];
        $_SESSION['phone'] = $_POST['phone'];

        // S'il y a des erreurs dans le formulaire
        if (isset($_SESSION['errors']) && $_SESSION['errors']) {
            header('Location: index.php?controller=order&action=addresse');
        }
        $shopRepository = new ShopRepository();
        $products = [];

        // Get products in basket
        if (isset($_SESSION['products'])) {
            foreach ($_SESSION['products'] as $product => $quantity) {
                $products[] = $shopRepository->findOne($product);
            }
        }

        $view = file_get_contents('view/page/order/summary.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }
}
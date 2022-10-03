<?php

/**
 * ETML
 * Auteur: Alexis Rojas
 * Description: Class qui controle les actions rélatives à la commande
 */
class OrderController extends Controller
{
    public function deliveryMethods(){
        include './data/deliveryMethods.php';
        return $deliveryMethods;
    }
    public function paymentMethods(){
        include './data/paymentMethods.php';
        return $paymentMethods;
    }
    /**
     * Dispatch current action
     * @return mixed
     */
    public function display()
    {
        $action = $_GET['action'];

        return call_user_func(array($this, $action));
    }
    public function delivery()
    {
        // Si le serveur traite une méthode post
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Si aucune option n'est selectionnée
            if (!isset($_POST['deliveryMethod']))
                header('Location: index.php?controller=order&action=delivery&error');
            else{
                // Enregistre le moyen de paiement -> avance au prochain formulaire
                $_SESSION['deliveryMethod'] = $_POST['deliveryMethod'];
                header('Location: index.php?controller=order&action=payment');
            }
        }

        $deliveryMethods = $this->deliveryMethods();

        $view = file_get_contents('view/page/order/delivery.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }
    public function payment()
    {
        // Si le serveur traite une méthode post
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Si aucune option n'est selectionnée
            if (!isset($_POST['paymentMethod']))
                header('Location: index.php?controller=order&action=payment&error');
            else{
                // Enregistre le moyen de paiement -> avance au prochain formulaire
                $_SESSION['paymentMethod'] = $_POST['paymentMethod'];
                header('Location: index.php?controller=order&action=addresse');
            }   
        }

        $paymentMethods = $this->paymentMethods();

        $view = file_get_contents('view/page/order/payment.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }
    public function addresse()
    {
        $errors = [];
        // Si le serveur traite une méthode post
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            define('ERROR_MESSAGE', 'Remplissez ce champ correctement');
            // Validation des données
            if (!$_POST['title'] || !preg_match("/^[a-z|A-Z]+$/", $_POST['title'])) {
                $errors['title'] = ERROR_MESSAGE;
            }
            if (!$_POST['firstName'] || !preg_match("/^[a-z|A-Z]+$/", $_POST['firstName'])) {
                $errors['firstName'] = ERROR_MESSAGE;
            }
            if (!$_POST['lastName'] || !preg_match("/^[a-z|A-Z]+$/", $_POST['lastName'])) {
                $errors['lastName'] = ERROR_MESSAGE;
            }
            if (!$_POST['street'] || !preg_match("/^[a-z |A-Z0-9]+$/", $_POST['street'])) {
                $errors['street'] = ERROR_MESSAGE;
            }
            if (!$_POST['streetNumber'] || !preg_match("/^[0-9]+$/", $_POST['streetNumber'])) {
                $errors['streetNumber'] = ERROR_MESSAGE;
            }
            if (!$_POST['pc'] || !preg_match("/^[0-9]{4}$/", $_POST['pc'])) {
                $errors['pc'] = ERROR_MESSAGE;
            }
            if (!$_POST['locality'] || !preg_match("/^[a-z |A-Z]+$/", $_POST['locality'])) {
                $errors['locality'] = ERROR_MESSAGE;
            }
            if (!$_POST['mail'] || !preg_match("/^\S+@\S+\.[A-Z|a-z]+$/", $_POST['mail'])) {
                $errors['mail'] = ERROR_MESSAGE;
            }
            if (!$_POST['phone'] || !preg_match("/^(\+41|0)7([0-9]{8})$/", $_POST['phone'])) {
                $errors['phone'] = ERROR_MESSAGE;
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

            // S'il n'y a pas d'erreurs
            if (!$errors) {
                header('Location: index.php?controller=order&action=summary');
            }
        }

        $view = file_get_contents('view/page/order/addresse.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }
    public function summary(){
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
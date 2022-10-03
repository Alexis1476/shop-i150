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
                $_SESSION['paymentMethod'] = $_POST['deliveryMethod'];
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
}
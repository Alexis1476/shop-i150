<?php

/**
 * ETML
 * Date: 10/10/2022
 * Auteur: Alexis Rojas
 * Description: Class qui controle les actions rélatives à la commande
 */
include_once 'classes/AdminRepository.php';
include_once 'classes/OrderRepository.php';

/**
 * Class qui controle les actions rélatives à la commande
 */
class OrderController extends Controller
{
    /**
     * Retourne les modes de livraison
     * @return array
     */
    public function deliveryMethods()
    {
        include './data/deliveryMethods.php';
        return $deliveryMethods;
    }

    /**
     * Retourne les modes de paiement
     * @return array
     */
    public function paymentMethods()
    {
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

    /**
     * Affiche le formulaire du mode de livraison
     * @return mixed
     */
    public function delivery()
    {
        // Si le serveur traite une méthode post
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Si aucune option n'est selectionnée
            if (!isset($_POST['deliveryMethod']))
                header('Location: index.php?controller=order&action=delivery&error');
            else {
                // Enregistre le moyen de paiement -> avance au prochain formulaire
                $_SESSION['deliveryMethodId'] = $_POST['deliveryMethod'];
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

    /**
     * Affiche le formulaire du mode de paiement
     * @return mixed
     */
    public function payment()
    {
        // Si le serveur traite une méthode post
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Si aucune option n'est selectionnée
            if (!isset($_POST['paymentMethod']))
                header('Location: index.php?controller=order&action=payment&error');
            else {
                // Enregistre le moyen de paiement -> avance au prochain formulaire
                $_SESSION['paymentMethodId'] = $_POST['paymentMethod'];
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

    /**
     * Affiche le formulaire des données du client
     * @return mixed
     */
    public function addresse()
    {
        $errors = [];
        // Si le serveur traite une méthode post
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    /**
     * Affiche le récapitulatif de la commande
     * @return mixed
     */
    public function summary()
    {
        $shopRepository = new ShopRepository();
        $products = [];

        // Get products in basket
        if (isset($_SESSION['products'])) {
            foreach ($_SESSION['products'] as $product => $quantity) {
                $products[] = $shopRepository->findOne($product);
            }
        }

        // Mode de livraison
        $deliveryMethods = $this->deliveryMethods();

        $delivery = [];
        foreach ($deliveryMethods as $key => $value) {
            if ($value['id'] == $_SESSION['deliveryMethodId'])
                $delivery = $value;
        }
        // Calcul montant mode de livraison
        $delivery['calcul'] = 0;
        if ($delivery['operator'] == '+') {
            $delivery['calcul'] = $delivery['value'];
        } else {
            $delivery['calcul'] = $_SESSION['totalProducts'] * $delivery['value'];
        }
        $totaux['delivery'] = round($_SESSION['totalProducts'] + $delivery['calcul'], 1);

        // Mode de paiement
        $paymentMethods = $this->paymentMethods();
        $payment = [];
        foreach ($paymentMethods as $key => $value) {
            if ($value['id'] == $_SESSION['paymentMethodId'])
                $payment = $value;
        }

        // Calcul montant mode de livraison
        $payment['calcul'] = 0;
        if ($payment['operator'] == '+') {
            $payment['calcul'] = $payment['value'];
        } else {
            $payment['calcul'] = round($totaux['delivery'] * $payment['value'], 1);
        }
        $_SESSION['total'] = round($payment['calcul'] + $totaux['delivery'], 1);
        $_SESSION['totaux'] = $totaux;
        $_SESSION['deliveryMethod'] = $delivery;
        $_SESSION['paymentMethod'] = $payment;

        $view = file_get_contents('view/page/order/summary.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Enregistre les données de la commande dans la base de données
     * @return void
     */
    public function sendOrder()
    {
        $orderRepository = new OrderRepository();
        $adminRepository = new AdminRepository();
        $shopRepository = new ShopRepository();

        // Generer numéro de commande
        if (isset($_SESSION['products'])) {
            $_SESSION['orderNumber'] = date_create()->format('mdHis');

            // Creer commande
            $idOrder = $orderRepository->insert(
                $_SESSION['title'],
                $_SESSION['firstName'],
                $_SESSION['lastName'],
                $_SESSION['locality'],
                $_SESSION['mail'],
                $_SESSION['orderNumber'],
                $_SESSION['phone'],
                $_SESSION['street'],
                $_SESSION['streetNumber'],
                $_SESSION['total'],
                $_SESSION['deliveryMethod']['name'],
                $_SESSION['paymentMethod']['name']
            );

            // Remplir table pivot avec ID commande + IDs produits + quantité
            $basket = []; // Panier
            $products = []; // Pour l'affichage dans la vue
            $counter = 0;   // Compteur pour les produits de la base de donnée

            foreach ($_SESSION['products'] as $id => $quantity) {
                $products[] = $shopRepository->findOne($id);
                $basket[] = $products[$counter][0];

                $orderRepository->addProducts($idOrder, $id, $quantity);  // Ajoute les produits dans la table pivot
                // Mettre à jour la quantité
                $basket[$counter]['proQuantity'] -= $quantity;
                $basket[$counter]['proDescription'] = str_replace('\'', '', $basket[$counter]['proDescription']);
                $adminRepository->update(
                    $basket[$counter]['proName'],
                    $basket[$counter]['proDescription'],
                    $basket[$counter]['proPrice'],
                    $basket[$counter]['proQuantity'],
                    $basket[$counter]['proImage'],
                    $basket[$counter]['idCategory'],
                    $id
                );
                $counter++;
            }
        }

        // Affichage remerciements
        $view = file_get_contents('view/page/order/summary.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();
        // Suppresion de la session
        unset($_SESSION['products']);
        unset($_SESSION['orderNumber']);
        return $content;
    }
}
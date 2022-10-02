<?php

/**
 * ETML
 * Auteur: Alexis Rojas
 * Description: Class qui controle les actions rélatives à la commande
 */
class OrderController extends Controller
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
}
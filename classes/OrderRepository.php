<?php
/**
 * ETML
 * Auteur: Alexis Rojas
 * Date: 08/10/2022
 */

include_once 'database/DataBaseQuery.php';
include_once 'Entity.php';

/**
 * Class qui permet de gerer les tables rélatives aux commandes
 */
class OrderRepository implements Entity
{

    /**
     * Retourne toutes les commandes
     * @return array
     */
    public function findAll()
    {
        $table = 't_order';
        $columns = '*';

        $request = new DataBaseQuery();

        return $request->select($table, $columns);
    }

    /**
     * Crée une nouvelle commande
     * @param $ordTitle
     * @param $ordFirstName
     * @param $ordLastName
     * @param $ordLocality
     * @param $ordMail
     * @param $ordNumber
     * @param $ordPhoneNumber
     * @param $ordStreet
     * @param $ordStreetNumber
     * @param $ordTotal
     * @return false|string
     */
    public function insert($ordTitle, $ordFirstName, $ordLastName, $ordLocality, $ordMail, $ordNumber, $ordPhoneNumber, $ordStreet, $ordStreetNumber, $ordTotal, $ordDelivery, $ordPayment)
    {
        $request = new DataBaseQuery();

        $table = 't_order';
        $columns = '(idOrder, ordTitle, ordFirstName, ordLastName, ordLocality, ordMail, ordNumber, ordPaid, ordPhoneNumber, ordStatus, ordStreet, ordStreetNumber, ordTotal, ordDelivery, ordPayment)';
        // N = order pas payé
        $values = "(NULL, '$ordTitle', '$ordFirstName', '$ordLastName', '$ordLocality', '$ordMail', '$ordNumber', 'N', '$ordPhoneNumber', 'En attente', '$ordStreet', $ordStreetNumber, $ordTotal, '$ordDelivery', '$ordPayment')";

        $request->insert($table, $columns, $values);
        return $request->lastId();
    }

    /**
     * Remplit la table pivot des produits de la commande
     * @param $idOrder
     * @param $idProduct
     * @param $quantity
     * @return bool|string
     */
    public function addProducts($idOrder, $idProduct, $quantity)
    {
        $request = new DataBaseQuery();

        $table = 't_concern';
        $columns = '(fkOrder, fkProduct, conQuantity)';
        $values = "('$idOrder', '$idProduct', '$quantity')";

        return $request->insert($table, $columns, $values);
    }
}
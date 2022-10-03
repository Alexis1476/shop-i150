<?php

/**
 * Auteur : Alexis Rojas
 * Date: 03.10.2022
 * Modes de livraison
 */

 $deliveryMethods = [
    0 => [
        'id' => 1,
        'name' => 'Par la Poste',
        'text' => 'Par la poste (+ CHF 7.95)',
        'operator' => '+',
        'value' => 7.95
    ],
    1 => [
        'id' => 2,
        'name' => 'Retrait au magasin',
        'text' => 'Retrait au magasin',
        'operator' => '+',
        'value' => 0
    ]
 ];
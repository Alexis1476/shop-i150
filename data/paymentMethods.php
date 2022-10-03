<?php

/**
 * Auteur : Alexis Rojas
 * Date: 03.10.2022
 * Modes de paiement
 */

 $paymentMethods = [
    0 => [
        'id' => 1,
        'name' => 'Sur facture',
        'text' => 'Sur facture (+ 2.-)',
        'operator' => '+',
        'value' => 2
    ],
    1 => [
        'id' => 2,
        'name' => 'Paiement par avance',
        'text' => 'Paiement par avance',
        'operator' => '+',
        'value' => 0
    ],
    2 => [
        'id' => 3,
        'name' => 'Carte de crédit',
        'text' => 'Carte de crédit (+ 2%)',
        'operator' => '*',
        'value' => 1.02
    ]
 ];
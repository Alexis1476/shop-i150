<div class="container">
    <h3>Récapitulatif</h3>
    <div class="justify-content">
        <p>Envoyé à :</p>
        <p>Livraison : <?= $delivery['name'] ?></p>
        <p>Paiement : <?= $payment['name'] ?></p>
    </div>
    <p><?= $_SESSION['title'] ?></p>
    <p><?= $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] ?></p>
    <p><?= $_SESSION['street'] . ' ' . $_SESSION['streetNumber'] ?></p>
    <p><?= $_SESSION['pc'] . ' ' . $_SESSION['locality'] ?></p>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Description</th>
            <th>Prix</th>
            <th>Quantité</th>
            <th>Sous-total</th>
        </tr>
        </thead>
        <tbody>
        <!--Affichage des produits-->
        <?php $total = 0; ?>
        <?php foreach ($products as $product) : ?>
            <tr>
                <td><?= $product[0]['proName'] ?></td>
                <td>CHF <?= $product[0]['proPrice'] ?></td>
                <td>
                    <?= $_SESSION['products'][$product[0]['idProduct']] ?>
                </td>
                <td>
                    CHF
                    <?php
                    $sousTotal = $_SESSION['products'][$product[0]['idProduct']] * $product[0]['proPrice'];
                    $total += $sousTotal;
                    echo number_format($sousTotal, 2) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td><?= $delivery['text'] ?></td>
            <td></td>
            <td></td>
            <td>CHF <?= $delivery['calcul'] ?></td>
        </tr>
        <tr>
            <td>Total</td>
            <td></td>
            <td></td>
            <td>CHF <?= number_format($totaux['delivery'], 2) ?></td>
        </tr>
        <tr>
            <td><?= $payment['text'] ?></td>
            <td></td>
            <td></td>
            <td>CHF <?= number_format($payment['calcul'], 2) ?></td>
        </tr>
        <tr>
            <td>Total à payer</td>
            <td></td>
            <td></td>
            <td>CHF <?= number_format($_SESSION['total'], 2) ?></td>
        </tr>
        </tbody>
    </table>
    <button>Envoyer la commande</button>
</div>
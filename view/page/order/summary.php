<div class="container">
    <?php if (isset($_SESSION['products'])): ?>
        <h3>
            <?php
            if (isset($_SESSION['orderNumber'])) {
                echo "Confirmation de commande - Merci de votre achat : Num." . $_SESSION['orderNumber'];
            } else {
                echo 'Récapitulatif';
            }
            ?>
        </h3>
        <div class="justify-content">
            <p>Envoyé à :</p>
            <p>Livraison : <?= $_SESSION['deliveryMethod']['name'] ?></p>
            <p>Paiement : <?= $_SESSION['paymentMethod']['name'] ?><br>
                <!--Affichage état de la commande-->
                <?php if (isset($_SESSION['orderStatus'])): ?>
                    <p>Statut de paiement : <?=$_SESSION['orderStatus'] == 1 ? 'Payé' : 'Non payé'?></p>
                <?php endif; ?>
            </p>
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
                <td><?= $_SESSION['deliveryMethod']['text'] ?></td>
                <td></td>
                <td></td>
                <td>CHF <?= number_format($_SESSION['deliveryMethod']['calcul'], 2) ?></td>
            </tr>
            <tr>
                <td>Total</td>
                <td></td>
                <td></td>
                <td>CHF <?= number_format($_SESSION['totaux']['delivery'], 2) ?></td>
            </tr>
            <tr>
                <td><?= $_SESSION['paymentMethod']['text'] ?></td>
                <td></td>
                <td></td>
                <td>CHF <?= number_format($_SESSION['paymentMethod']['calcul'], 2) ?></td>
            </tr>
            <tr>
                <td>Total à payer</td>
                <td></td>
                <td></td>
                <td>CHF <?= number_format($_SESSION['total'], 2) ?></td>
            </tr>
            </tbody>
        </table>
        <?php if (!isset($_SESSION['orderNumber'])): ?>
            <form action="index.php?controller=order&action=creditCard" method="post">
                <button type="submit">Envoyer la commande</button>
            </form>
        <?php endif; ?>
    <?php endif; ?>
</div>
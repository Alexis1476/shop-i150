<div class="container">
    <h3>Récapitulatif</h3>
    <div class="justify-content">
        <p>Envoyé à :</p>
        <p>Livraison :</p>
        <p>Paiement :</p>
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
                    echo $sousTotal ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td><!--TODO : Nom moyen de paiement--></td>
            <td></td>
            <td></td>
            <td>CHF <!--TODO : Prix moyen de paiement--></td>
        </tr>
        <tr>
            <td>Total</td>
            <td></td>
            <td></td>
            <td>CHF <!--TODO : Total produits--></td>
        </tr>
        <tr>
            <td><!--TODO : Moyen de paiement--></td>
            <td></td>
            <td></td>
            <td>CHF <!--TODO : Calcul montant moyen de paiement--></td>
        </tr>
        <tr>
            <td>Total à payer</td>
            <td></td>
            <td></td>
            <td>CHF <!--TODO : Total--></td>
        </tr>
        </tbody>
    </table>
</div>
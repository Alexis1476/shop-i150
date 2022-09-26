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
        <!--TODO : Boucle pour afficher les produits-->
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
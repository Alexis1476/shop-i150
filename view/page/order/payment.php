<div class="container">
    <h3>Choisir un moyen de paiement</h3>
    <form action="index.php?controller=order&action=addresse" method="post">
        <input type="hidden" name="form" value="payment">
        <div class="input-group">
            <input type="radio" id="poste" name="paymentMethod" value="<?= $invoicePrice ?>">
            <label for="poste">Sur facture (+ CHF <?= $invoicePrice ?>)</label>
        </div>
        <div class="input-group">
            <input type="radio" id="poste" name="paymentMethod">
            <label for="poste">Paiement par avance</label>
        </div>
        <div class="input-group">
            <input type="radio" id="poste" name="paymentMethod" value="<?= $creditCard ?>">
            <label for="poste">Carte de crédit (+ <?= $creditCard ?>%)</label>
        </div>
        <?php if (isset($_GET['error'])): ?>
            <p class="text-danger">Selectionnez un moyen de paiement</p>
        <?php endif; ?>
        <button class="btn btn-default">Suivant</button>
    </form>
</div>
<div class="container">
    <h3>Choisir un moyen de paiement</h3>
    <form action="#">
        <div class="input-group">
            <input type="radio" id="poste" name="payment-method" value="<?= $invoicePrice ?>">
            <label for="poste">Sur facture (+ CHF <?= $invoicePrice ?>)</label>
        </div>
        <div class="input-group">
            <input type="radio" id="poste" name="payment-method">
            <label for="poste">Paiement par avance</label>
        </div>
        <div class="input-group">
            <input type="radio" id="poste" name="payment-method" value="<?= $creditCard ?>">
            <label for="poste">Carte de crédit (+ <?= $creditCard ?>%)</label>
        </div>
        <button class="btn btn-default">Suivant</button>
    </form>
</div>
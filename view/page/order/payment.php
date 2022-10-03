<div class="container">
    <h3>Choisir un moyen de paiement</h3>
    <form action="index.php?controller=order&action=payment" method="post">
        <input type="hidden" name="form" value="payment">
        <?php foreach($paymentMethods as $item): ?>
            <div class="input-group">
                <input type="radio" id="poste" name="paymentMethod" value="<?= $item['id'] ?>">
                <label for="poste"><?= $item['text'] ?></label>
            </div>
        <?php endforeach; ?>
        <?php if (isset($_GET['error'])): ?>
            <p class="text-danger">Selectionnez un moyen de paiement</p>
        <?php endif; ?>
        <button class="btn btn-default">Suivant</button>
    </form>
</div>
<div class="container">
    <h3>Choisir un moyen de livraison</h3>
    <form action="index.php?controller=order&action=payment" method="post">
        <input type="hidden" name="form" value="delivery">
        <?php foreach ($deliveryMethods as $name => $price): ?>
            <div class="input-group">
                <input type="radio" id="poste" name="deliveryMethod" value="<?= $name ?>">
                <label for="poste"><?= $price == 0 ? $name : " $name (+ CHF $price)" ?></label>
            </div>
        <?php endforeach; ?>
        <?php if (isset($_GET['error'])): ?>
            <p class="text-danger">Selectionnez un moyen de livraison</p>
        <?php endif; ?>
        <button class="btn btn-default">Suivant</button>
    </form>
</div>
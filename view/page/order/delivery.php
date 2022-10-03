<div class="container">
    <h3>Choisir un moyen de livraison</h3>
    <form action="index.php?controller=order&action=delivery" method="post">
        <input type="hidden" name="form" value="delivery">
        <?php foreach ($deliveryMethods as $item): ?>
            <div class="input-group">
                <input type="radio" id="poste" name="deliveryMethod" value="<?= $item['id'] ?>">
                <label for="poste"><?= $item['text'] ?></label>
            </div>
        <?php endforeach; ?>
        <?php if (isset($_GET['error'])): ?>
            <p class="text-danger">Selectionnez un moyen de livraison</p>
        <?php endif; ?>
        <button class="btn btn-default">Suivant</button>
    </form>
</div>
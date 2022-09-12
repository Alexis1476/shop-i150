<div class="container">
    <h3>Choisir un moyen de livraison</h3>
    <form action="index.php?controller=order&action=payment" method="post">
        <input type="hidden" name="form" value="delivery">
        <div class="input-group">
            <input type="radio" id="poste" name="deliveryMethod" value="<?= $postePrice ?>">
            <label for="poste">Par la poste (+ CHF <?= $postePrice ?>)</label>
        </div>
        <div class="input-group">
            <input type="radio" id="poste" name="deliveryMethod" value="0">
            <label for="poste">Retrait au magasin</label>
        </div>
        <?php if (isset($_GET['error'])): ?>
            <p class="text-danger">Selectionnez un moyen de livraison</p>
        <?php endif; ?>
        <button class="btn btn-default">Suivant</button>
    </form>
</div>
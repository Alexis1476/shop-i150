<div class="container">
    <h3>Choisir un moyen de livraison</h3>
    <form action="#">
        <div class="input-group">
            <input type="radio" id="poste" name="delivery-method">
            <label for="poste">Par la poste (+ CHF <?= $postePrice ?>)</label>
        </div>
        <div class="input-group">
            <input type="radio" id="poste" name="delivery-method">
            <label for="poste">Retrait au magasin</label>
        </div>
        <button class="btn btn-default">Suivant</button>
    </form>
</div>
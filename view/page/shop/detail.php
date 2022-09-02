<div class="container">

    <h2><?= $product[0]['proName']; ?></h2>
    <!-- Three columns of text below the carousel -->
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <p><?= $product[0]['proDescription'] ?></p>
            <p>Encore : <?= $product[0]['proQuantity'] ?> en stock</p>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <img src="resources/image/<?= $product[0]['proImage'] ?>">
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p> CHF : <?= $product[0]['proPrice'] ?></p>
            <?php if ($product[0]['proLike'] > 0) : ?>
                <p>Ce produit est aimée déjà <strong><?= $product[0]['proLike'] ?></strong> fois ! </p>
            <?php endif; ?>
        </div>
        <!--TODO: Button ajouter au panier si stock-->
        <?php if ($product[0]['proQuantity'] > 0): ?>
            <a href="index.php?controller=basket&action=add&id=<?= $product[0]['idProduct'] ?>">Ajouter au panier</a>
        <?php endif; ?>
    </div>
</div>
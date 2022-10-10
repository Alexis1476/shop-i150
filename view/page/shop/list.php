<div class="container">

    <h2>Liste des articles</h2>
    <!-- Three columns of text below the carousel -->
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="boxProduct">
                    <div class="nameProduct"><h4><?= $product['proName'] ?></h4></div>
                    <div class="imageProduct"><img src="resources/image/<?= $product['proImage'] ?>"/></div>
                    <div class="priceProduct">Prix : <?= $product['total'] ?>.-</div>
                    <?php if ($product['proDiscount']): ?>
                        <div class="priceProduct">au lieu de <?= $product['proPrice'] ?>.-</div>
                    <?php endif; ?>
                    <a class="btn btn-default"
                       href="index.php?controller=shop&action=detail&id=<?= $product['idProduct'] ?>">Détail</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
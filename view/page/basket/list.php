<div class="container">

    <h2>Votre panier</h2>
    <!-- Three columns of text below the carousel -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php if (isset($products) & $products != null): ?>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Sous-total</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $total = 0; ?>
                    <?php foreach ($products as $product) : ?>
                        <tr>
                            <td><?= $product[0]['proName'] ?></td>
                            <td>CHF <?= $product[0]['proPrice'] ?></td>
                            <td><!--TODO: Gerer quantité-->
                                <?= $_SESSION['products'][$product[0]['idProduct']] ?>
                            </td>
                            <td>
                                CHF
                                <?php
                                $sousTotal = $_SESSION['products'][$product[0]['idProduct']] * $product[0]['proPrice'];
                                $total += $sousTotal;
                                echo $sousTotal ?>
                            </td>
                            <td>
                                <a class="btn btn-default"
                                   href="index.php?controller=basket&action=modify&add=true&id=<?= $product[0]['idProduct'] ?>">
                                    +</a>
                                <a class="btn btn-default"
                                   href="index.php?controller=basket&action=modify&add=false&id=<?= $product[0]['idProduct'] ?>">
                                    -</a>
                                <a onclick="return confirm(\'Etes-vous sûr ? \')" class="btn btn-default"
                                   href="index.php?controller=basket&action=delete&id=<?= $product[0]['idProduct'] ?>">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td>Total</td>
                        <td></td>
                        <td></td>
                        <td>CHF <?= $total ?></td>
                    </tr>
                    </tfoot>
                </table>
                <div>
                    <a href="index.php?controller=basket&action=delivery" class="btn btn-default">Passer la commande</a>
                </div>
            <?php else: ?>
                <h3>Le panier est actuellement vide</h3>
            <?php endif; ?>
        </div>
    </div>
</div>
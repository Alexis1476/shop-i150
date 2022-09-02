<div class="container">

    <h2>Administration des articles</h2>
    <!-- Three columns of text below the carousel -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div>
                <a href="index.php?controller=admin&action=formAdd" class="btn btn-default"><span
                            class="glyphicon glyphicon-plus" aria-hidden="true"></span> Ajouter un article</a>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Stock</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><?= $product['idProduct'] ?></td>
                        <td><?= $product['proName'] ?></td>
                        <td><?= $product['proDescription'] ?></td>
                        <td>CHF <?= $product['proPrice'] ?></td>
                        <td><?= $product['proQuantity'] ?></td>
                        <td>
                            <a class="btn btn-default"
                               href="index.php?controller=admin&action=formUpdate&id=<?= $product['idProduct'] ?>">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                            <a onclick="return confirm(\'Etes-vous sûr ? \')" class="btn btn-default"
                               href="index.php?controller=admin&action=remove&id=<?= $product['idProduct'] ?>">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

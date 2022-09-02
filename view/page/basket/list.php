<div class="container">

    <h2>Votre panier</h2>
    <!-- Three columns of text below the carousel -->
    <div class="row">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Description</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Sous-total</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($products as $product) : ?>
                <tr>
                    <td><?= $product[0]['proName'] ?></td>
                    <td>CHF <?= $product[0]['proPrice'] ?></td>
                    <td><!--TODO: Gerer quantité--></td>
                    <td>
                        <!--TODO: Ajouter boutons-->
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
            <tr>
                <td>Total</td>
                <td></td>
                <td></td>
                <td><!--TODO: Prix total--></td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
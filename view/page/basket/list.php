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
            <?php $total = 0; ?>
            <?php if (isset($products) & $products != null): ?>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><?= $product[0]['proName'] ?></td>
                        <td>CHF <?= $product[0]['proPrice'] ?></td>
                        <td><!--TODO: Gerer quantité-->
                            <?= $_SESSION['products'][$product[0]['idProduct']] ?>
                        </td>
                        <td>CHF
                            <?php
                            $sousTotal = $_SESSION['products'][$product[0]['idProduct']] * $product[0]['proPrice'];
                            $total += $sousTotal;
                            echo $sousTotal ?>
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24">
                                    <path d="M7.127 22.562l-7.127 1.438 1.438-7.128 5.689 5.69zm1.414-1.414l11.228-11.225-5.69-5.692-11.227 11.227 5.689 5.69zm9.768-21.148l-2.816 2.817 5.691 5.691 2.816-2.819-5.691-5.689z"/>
                                </svg>
                            </a>
                            <a href="#">
                                <svg width="22" height="22" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                     clip-rule="evenodd">
                                    <path d="M12 11.293l10.293-10.293.707.707-10.293 10.293 10.293 10.293-.707.707-10.293-10.293-10.293 10.293-.707-.707 10.293-10.293-10.293-10.293.707-.707 10.293 10.293z"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
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
    </div>
</div>
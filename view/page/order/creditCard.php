<h2>Paiement par carte de crédit</h2>
<p>Facturer à : </p>
<p><?= $_SESSION['title'] ?></p>
<p><?= $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] ?></p>
<p><?= $_SESSION['street'] . ' ' . $_SESSION['streetNumber'] ?></p>
<p><?= $_SESSION['pc'] . ' ' . $_SESSION['locality'] ?> </p><br>
<p>Total à payer : CHF <?= $_SESSION['total'] ?></p> <br>

<a class="btn btn-default" href="index.php?controller=order&action=sendOrder">Payer maintenant</a>
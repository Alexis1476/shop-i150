<h2>Paiement par carte de crédit</h2>
<p>Facturer à : </p>
<p><?= $_SESSION['title'] ?></p>
<p><?= $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] ?></p>
<p><?= $_SESSION['street'] . ' ' . $_SESSION['streetNumber'] ?></p>
<p><?= $_SESSION['pc'] . ' ' . $_SESSION['locality'] ?> </p><br>
<p>Total à payer : CHF <?= $_SESSION['total'] ?></p> <br>

<form action="index.php?controller=order&action=sendOrder" method="post">
    <button type="submit" class="btn btn-default">Payer maintenant</button>
</form>
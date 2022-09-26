<div class="container">
    <h3>Choisir un moyen de livraison</h3>
    <form action="index.php?controller=order&action=summary" method="post">
        <div class="form-group">
            <label for="title">Titre</label>
            <input name="title" type="text" class="form-control" id="title"/>
            <?php if (isset($errors['title'])): ?>
                <p class="text-danger"><?= $errors['title'] ?></p>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="lastName">Nom</label>
            <input name="lastName" type="text" class="form-control" id="lastName"/>
            <?php if (isset($errors['lastName'])): ?>
                <p class="text-danger"><?= $errors['lastName'] ?></p>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="firstName">Prénom</label>
            <input name="firstName" type="text" class="form-control" id="firstName"/>
            <?php if (isset($errors['firstName'])): ?>
                <p class="text-danger"><?= $errors['firstName'] ?></p>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="street">Rue</label>
            <input name="street" type="text" class="form-control" id="street"/>
            <?php if (isset($errors['street'])): ?>
                <p class="text-danger"><?= $errors['street'] ?></p>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="streetNumber">N°</label>
            <input name="streetNumber" type="text" class="form-control" id="streetNumber"/>
            <?php if (isset($errors['streetNumber'])): ?>
                <p class="text-danger"><?= $errors['streetNumber'] ?></p>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="pc">NPA</label>
            <input name="pc" type="text" class="form-control" id="pc"/>
            <?php if (isset($errors['pc'])): ?>
                <p class="text-danger"><?= $errors['pc'] ?></p>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="locality">Localité</label>
            <input name="locality" type="text" class="form-control" id="locality"/>
            <?php if (isset($errors['locality'])): ?>
                <p class="text-danger"><?= $errors['locality'] ?></p>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="mail">Adresse mail</label>
            <input name="mail" type="text" class="form-control" id="mail"/>
            <?php if (isset($errors['mail'])): ?>
                <p class="text-danger"><?= $errors['mail'] ?></p>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="phone">Numéro de téléphone</label>
            <input name="phone" type="text" class="form-control" id="phone"/>
            <?php if (isset($errors['phone'])): ?>
                <p class="text-danger"><?= $errors['phone'] ?></p>
            <?php endif; ?>
        </div>
        <button class="btn btn-default">Suivant</button>
    </form>
</div>
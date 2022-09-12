<div class="container">
    <h3>Choisir un moyen de livraison</h3>
    <form action="index.php?controller=order&action=summary" method="post">
        <div class="form-group">
            <label for="title">Titre</label>
            <input name="title" type="text" class="form-control" id="title"/>
        </div>
        <div class="form-group">
            <label for="lastName">Nom</label>
            <input name="lastName" type="text" class="form-control" id="lastName"/>
        </div>
        <div class="form-group">
            <label for="firstName">Prénom</label>
            <input name="firstName" type="text" class="form-control" id="firstName"/>
        </div>
        <div class="form-group">
            <label for="street">Rue</label>
            <input name="street" type="text" class="form-control" id="street"/>
        </div>
        <div class="form-group">
            <label for="streetNumber">N°</label>
            <input name="streetNumber" type="text" class="form-control" id="streetNumber"/>
        </div>
        <div class="form-group">
            <label for="pc">NPA</label>
            <input name="pc" type="text" class="form-control" id="pc"/>
        </div>
        <div class="form-group">
            <label for="locality">Localité</label>
            <input name="locality" type="text" class="form-control" id="locality"/>
        </div>
        <div class="form-group">
            <label for="mail">Adresse mail</label>
            <input name="mail" type="text" class="form-control" id="mail"/>
        </div>
        <button class="btn btn-default">Suivant</button>
    </form>
</div>
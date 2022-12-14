<nav>
    <ul class="nav nav-justified">
        <li><a href="index.php?controller=shop&action=list">Shop</a></li>
        <?php if (isset($_SESSION['right'])): ?>
            <li><a href="index.php?controller=login&action=profil">Profil</a></li>
        <?php endif; ?>
        <?php if (isset($_SESSION['right']) && $_SESSION['right'] == 'admin') : ?>
            <li><a href="index.php?controller=admin&action=index">Gestion des articles</a></li>
            <li><a href="index.php?controller=admin&action=listUsers&field=useLogin">Gestion des utilisateurs</a></li>
        <?php endif ?>
        <li>
            <a href="index.php?controller=basket&action=show">
                Votre panier
                <?= isset($_SESSION['totalProducts']) ? '(' . $_SESSION['totalProducts'] . ')' : '' ?>
            </a>
        </li>
        <li><a href="index.php?controller=home&action=contact">Contact</a></li>
        <?php if (isset($_SESSION['right']) && ($_SESSION['right'] == 'admin' || $_SESSION['right'] == 'customer')): ?>
            <li><a href="index.php?controller=login&action=logout">Se déconnecter</a></li>
        <?php else: ?>
            <li><a href="index.php?controller=login&action=index">Se connecter</a></li>
        <?php endif ?>
    </ul>
</nav>
</div>
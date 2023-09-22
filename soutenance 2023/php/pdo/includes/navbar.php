<ul>
    <li>acceuil</li>
    <?php if(!isset($_SESSION["user"])): ?>
    <li><a href="signin.php">Inscription</a></li>
    <li><a href="login.php">Connexion</a></li>
    <?php else: ?>
    <li><a href="logout.php">Déconexion</a></li>
    <?php endif; ?>
</ul>
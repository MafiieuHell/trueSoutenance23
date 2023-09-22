<?php
session_start();


$title = "Profil";


//On inclue l'HTML
include "includes/header.php";
include "includes/navbar.php";
?>
<h1>Profil de <?= $_SESSION["user"]["pseudo"] ?></h1>
<p>Pseudo :<?= $_SESSION["user"]["pseudo"] ?></p>
<p>Email : <?= $_SESSION["user"]["email"] ?></p>
<?php
include "includes/footer.php";
?>


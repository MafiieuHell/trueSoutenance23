<?php
//ouverture de la session
session_start();
$title = "liste";
include "includes/connect.php";

//On ecrit la requete
$sql = "SELECT * FROM `articles` ORDER BY `created_at` DESC";

//On exécute la requete
$q = $db->query($sql);

//On recupere les données 
$articles = $q->fetchAll();

//On inclue l'HTML
include "includes/header.php";
include "includes/navbar.php";
?>
<p>liste</p>

<section>
<?php foreach ($articles as $article): ?>


    <article>
        <h1><a href="show_article.php?id=<?= $article['id'] ?>"><?= strip_tags($article["title"]) ?></a></h1>
        <p>Publié le <?=$article["created_at"] ?></p>
        <div><?= strip_tags($article["content"]) ?></div>
    </article>
<?php endforeach; ?>
</section>

<?php
include "includes/footer.php";
?>

